<?php

namespace App\Http\Controllers\Api\UserRoom;

use App\Http\Controllers\Controller;

use App\Http\Repositories\Eloquent\UserRoom\UserRoomRepo;
use App\Http\Requests\BulkDeleteRequest;
use App\Http\Requests\Api\UserRoomRequest;
use App\Http\Repositories\Eloquent\FirebaseRepo;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\UserRoom\UserRoomResource;
use App\Http\Resources\SearchResource;
use App\Models\UserRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use File ;
use Illuminate\Support\Facades\File as FacadesFile;

class UserRoomController extends Controller
{
    protected $repo;
    protected $firebaseRepo;
    public function __construct(UserRoomRepo $repo,FirebaseRepo $firebaseRepo)
    {
        $this->repo = $repo;
        $this->firebaseRepo = $firebaseRepo;
    }

    public function index(PaginateRequest $request)
    {
        $input = $this->repo->inputs($request->all());
        $model = new UserRoom();
        $columns = Schema::getColumnListing($model->getTable());

        if (count($input["columns"]) < 1 || (count($input["columns"]) != count($input["column_values"])) || (count($input["columns"]) != count($input["operand"]))) {
            $wheres = [];
        } else {
            $wheres = $this->repo->whereOptions($input, $columns);

        }
        $data = $this->repo->Paginate($input, $wheres);

        return responseSuccess([
            'data' => $input["resource"] == "all" ? UserRoomResource::collection($data) : SearchResource::collection($data),
            'meta' => [
                'total' => $data->count(),
                'currentPage' => $input["offset"],
                'lastPage' => $input["paginate"] != "false" ? $data->lastPage() : 1,
            ],
        ], 'data returned successfully');
    }

    public function get($UserRoom)
    {
        $data = $this->repo->findOrFail($UserRoom);

        return responseSuccess([
            'data' => new UserRoomResource($data),
        ], 'data returned successfully');
    }



    public function store(UserRoomRequest $request)
    {
        $uri=config('service.firebase.database_url');
        $database = $this->firebaseRepo->createDatabase($uri);
        $input = [
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'active' => 1,
            ];



         $data = $this->repo->create($input);

        if ($data) {
            $insert=$database->getReference("userRooms")->push($data);
            return responseSuccess(new UserRoomResource($data), 'data saved successfully');
        } else {
            return responseFail('something went wrong');
        }

    }

    public function update($UserRoom, UserRoomRequest $request)
    {
        $uri=config('service.firebase.database_url');
        $database = $this->firebaseRepo->createDatabase($uri);
        $UserRoom = $this->repo->findOrFail($UserRoom);
        $input = [
            'user_id' => $request->user_id ??  $UserRoom->user_id,
            'room_id' => $request->room_id ??  $UserRoom->room_id,
            'active' => $request->active ??  $UserRoomDevice->active,
        ];




            $data = $this->repo->update($input, $UserRoom);

          if ($data) {
            $room = $this->repo->findOrFail($UserRoom->id);
            $values=$database->getReference('userRooms')->getValue();
            if(is_array($values)){
            foreach($values as $key=>$value){
                // dd($value);
                if($value["id"]==$UserRoom->id){
                    $insert=$database->getReference("userRooms/".$key)->set($room);
                }
            }
        }
            return responseSuccess(new UserRoomResource($UserRoom->refresh()), 'data Updated successfully');
          } else {
            return responseFail('something went wrong');
          }



    }



    public function bulkDelete(BulkDeleteRequest $request)
    {
        $uri=config('service.firebase.database_url');
        $database = $this->firebaseRepo->createDatabase($uri);
        DB::beginTransaction();
        try {
            foreach($request->ids as $ke=>$id){
                $room = $this->repo->find($id);
                if ($room) {
                $values=$database->getReference('userRooms')->getValue();
                if(is_array($values)){
                foreach($values as $key=>$value){
                    if($value["id"]==$id){
                        $insert=$database->getReference("userRooms/".$key)->remove();
                    }
                }
            }
        }
        }
            $data = $this->repo->bulkDelete($request->ids);
            if ($data) {

                DB::commit();
                return responseSuccess([], 'data deleted successfully');
            } else {
                return responseFail('something went wrong');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return responseFail('something went wrong');
        }
    }

    public function bulkRestore(BulkDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $this->repo->bulkRestore($request->ids);
            if ($data) {

                DB::commit();
                return responseSuccess([], 'data restored successfully');
            } else {
                return responseFail('something went wrong');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return responseFail('something went wrong');
        }
    }


}
