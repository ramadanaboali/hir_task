<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\AuthRepoInterface;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\CarPhoto;
use App\Models\CharityStateRegion;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthRepo extends AbstractRepo implements AuthRepoInterface
{
    use AuthenticatesUsers;

    protected function credentials(AuthLoginRequest $request)
    {
        return [
            'uid' => $request->get('username'),
            'password' => $request->get('password'),
        ];
    }

    public function username()
    {
        return 'userName';
    }

    public function __construct()
    {

        parent::__construct(User::class);

    }

    public function login(array $data)
    {
        try {
            $userPhone=User::where("phone",$data['username'])->first();
            $userEmail=User::where("email",$data['username'])->first();
            $userName=User::where("name",$data['username'])->first();
            $user=$userPhone != null ? $userPhone :($userEmail != null ? $userEmail : $userName  );
             if($user ){
                 if(Hash::check($data['password'],$user->password)){


                 if(!$user->active || $user->status != "active"){
                     return response()->json([
                         'success' => false,
                         'message' => 'user Not activated yet Please contact admin',
                     ], 400);
                 }
                $user->fcm_token=$data['fcm_token'];
                $user->save();
                 }else{
                     return responseFail([__('app.invalid_password')], 401);
                 }
            }else{

                return responseFail([__('app.could_not_find_user')], 401);
            }
            if (! $token = JWTAuth::fromUser($user)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Phone or Password',
                ], 400);
            }else{
                return response()->json([
                    'success' => true,
                    'message' => 'Retrieved successfully',
                    'access_token' => $token,
                    'data' => $user,
                    'token_type' => 'bearer',
                    'expires_in' => auth('api')->factory()->getTTL()
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'could_not_create_token',
            ], 500);
        }


    }

    public function social_login(array $data)
    {
        try {
            $user=User::where("social_id",$data['socialId'])->first();

            if($user){
                // $user->fcm_token=$data['fcm_token'];
                // $user->save();
                if (! $token = JWTAuth::fromUser($user)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid Phone or Password',
                    ], 400);
                }else{
                    return response()->json([
                        'success' => true,
                        'message' => 'Retrieved successfully',
                        'access_token' => $token,
                        'data' => $user,
                        'token_type' => 'bearer',
                        'expires_in' => auth('api')->factory()->getTTL()
                    ]);
                }
            }else{
                $insertUser=User::create([
                    'name' => $data['name'],
                    'social_id' => $data['socialId'],
                    // 'fcm_token' => $data['fcm_token'],
                    'type' => 'user',
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    // 'photo' =>  $data['photo']
                ]);

                if($insertUser){
                    if (! $token = JWTAuth::fromUser($insertUser)) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Invalid Phone or Password',
                        ], 400);
                    }else{
                        return response()->json([
                            'success' => true,
                            'message' => 'Retrieved successfully',
                            'access_token' => $token,
                            'data' => $insertUser,
                            'token_type' => 'bearer',
                            'expires_in' => auth('api')->factory()->getTTL()
                        ]);
                    }
                }else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot insert user',
                    ], 400);
                }
            }

        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'could_not_create_token',
            ], 500);
        }


    }
    public function logout($request)
    {

        return $request->user()->token()->revoke();
    }

    public function currentUser()
    {
        return Auth::user();
    }


    public function assign_state_region(array $data)
    {
        $user=User::find($data['user_id']);
        if($user){
            $income_ids=[];
            if($user->type=='donor'){
                return $user->update(['state_id'=>$data['state_id'],'region_id'=>$data['region_id'][0]]);
            }else{
                $i=0;
                foreach($data['region_id'] as $region_id){
                    $income_ids[]=$data['region_id'][$i];
                     CharityStateRegion::updateOrCreate(['user_id'=>$data['user_id'],'state_id'=>$data['state_id'],'region_id'=>$data['region_id'][$i]]);
                    $i++;
                }
            }
            $allids=CharityStateRegion::where('user_id',$data['user_id'])->where('state_id',$data['state_id'])->pluck('region_id')->toArray();
            $diffrent=array_diff($allids,$income_ids);
            foreach($diffrent as $key=>$val){
                CharityStateRegion::where('user_id',$data['user_id'])->where('state_id',$data['state_id'])->where('region_id',$val)->delete();
            }
        }
        return true;
    }
    public function delete_state_region(array $data)
    {
        $user=User::find($data['user_id']);
        if($user){
            CharityStateRegion::where('user_id',$data['user_id'])->where('state_id',$data['state_id'])->delete();
        return true;
        }
        return false;
    }

    public function register(array $data)
    {
        try{

                $user=new User();
                $user->name=$data["name"];
//                $user->latitude=$data["latitude"];
//                $user->longitude=$data["longitude"];
//                $user->country_id=$data["country"];
                $user->phone=$data["phone"];
                $user->email=$data["email"];
                $user->type="user";
                $user->password=Hash::make($data['password']);
                    if(array_key_exists("photo",$data) && $data["photo"]!= null)
                    {

                        $fileName = time() . rand(0, 999999999) . '.' . $data["photo"]->getClientOriginalExtension();
                        $path = $data["photo"]->storeAs('public/user/images', $fileName);
                        $path = url('/storage') . '/' . str_replace('public/', '', $path);
                        $user->photo=   $fileName;


                    }


                $user->save();
                if($user){

                        return response()->json([
                            'success' => true,
                            'data' => new UserResource($user),
                            'message' => ' data inserted successfully',
                        ]);

                }else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot insert user',
                    ], 400);
                }


        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'could_not_create_token',
            ], 500);
        }
    }
    public function add_user(array $data)
    {
        try{

                $user=new User();
                $user->name=$data["name"];
                $user->phone=$data["phone"];
                $user->email=$data["email"];
                $user->parent_id=$data["parent_id"];
                $user->type="subUser";
                $user->password=Hash::make($data['password']);
                    if(array_key_exists("photo",$data) && $data["photo"]!= null)
                    {

                        $fileName = time() . rand(0, 999999999) . '.' . $data["photo"]->getClientOriginalExtension();
                        $path = $data["photo"]->storeAs('public/user/images', $fileName);
                        $path = url('/storage') . '/' . str_replace('public/', '', $path);
                        $user->photo=   $fileName;


                    }


                $user->save();
                if($user){

                        return response()->json([
                            'success' => true,
                            'data' => new UserResource($user),
                            'message' => ' data inserted successfully',
                        ]);

                }else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot insert user',
                    ], 400);
                }


        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'could_not_create_token',
            ], 500);
        }
    }

}
