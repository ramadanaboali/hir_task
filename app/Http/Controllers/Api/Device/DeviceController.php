<?php

namespace App\Http\Controllers\Api\Device;

use App\Http\Controllers\Controller;

use App\Http\Repositories\Eloquent\Device\DeviceRepo;
use App\Http\Requests\BulkDeleteRequest;
use App\Http\Requests\Api\DeviceRequest;

use App\Http\Requests\PaginateRequest;
use App\Http\Resources\Device\DeviceResource;
use App\Http\Resources\SearchResource;
use App\Models\Device;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use File ;
use Illuminate\Support\Facades\File as FacadesFile;
use App\Http\Repositories\Eloquent\FirebaseRepo;
class DeviceController extends Controller
{
    protected $repo;
    protected $firebaseRepo;
    public function __construct(DeviceRepo $repo,FirebaseRepo $firebaseRepo)
    {
        $this->repo = $repo;
        $this->firebaseRepo = $firebaseRepo;

    }

    public function index(PaginateRequest $request)
    {
        $input = $this->repo->inputs($request->all());
        $model = new Device();
        $columns = Schema::getColumnListing($model->getTable());

        if (count($input["columns"]) < 1 || (count($input["columns"]) != count($input["column_values"])) || (count($input["columns"]) != count($input["operand"]))) {
            $wheres = [];
        } else {
            $wheres = $this->repo->whereOptions($input, $columns);

        }
        $data = $this->repo->Paginate($input, $wheres);

        return responseSuccess([
            'data' => $input["resource"] == "all" ? DeviceResource::collection($data) : SearchResource::collection($data),
            'meta' => [
                'total' => $data->count(),
                'currentPage' => $input["offset"],
                'lastPage' => $input["paginate"] != "false" ? $data->lastPage() : 1,
            ],
        ], 'data returned successfully');
    }

    public function mydevices()
    {
        $user_id= auth()->user()->id;
        $data = $this->repo->mydevices($user_id);

        return responseSuccess([
            'data' =>  DeviceResource::collection($data),
        ], 'data returned successfully');
    }

    public function get($Device)
    {
        $data = $this->repo->findOrFail($Device);

        return responseSuccess([
            'data' => new DeviceResource($data),
        ], 'data returned successfully');
    }



    public function store(DeviceRequest $request)
    {
        $uri=config('service.firebase.database_url');
        $database = $this->firebaseRepo->createDatabase($uri);
        $input = [
            'user_id' => auth()->user()->id,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'photo' => $request->photo,
            ];

        if ($request->hasFile('photo')) {

            $destination_path = 'public/Device/images';
            $image = $request->file('photo');
            $input['photo'] = $this->repo->storeFile($image,$destination_path);

        }

         $data = $this->repo->create($input);


        if ($data) {
            $insert=$database->getReference("devices")->push($data);
            return responseSuccess(new DeviceResource($data), 'data saved successfully');
        } else {
            return responseFail('something went wrong');
        }

    }

    public function update($Device, DeviceRequest $request)
    {
        $uri=config('service.firebase.database_url');
        $database = $this->firebaseRepo->createDatabase($uri);
        $Device = $this->repo->findOrFail($Device);
        $input = [
            'name_ar' => $request->name_ar ??  $Device->name_ar,
            'name_en' => $request->name_en ??  $Device->name_en,

        ];


            //here insert images

            $file=request()->file('photo');
            if( $file)
            {
              FacadesFile::delete('public/Device/images/'.$Device->photo);

                $destination_path = 'public/Device/images';
                $image = $request->file('photo');
                $input['photo'] = $this->repo->storeFile($image,$destination_path);

            }

            $data = $this->repo->update($input, $Device);

          if ($data) {
            $room = $this->repo->findOrFail($Device->id);
            $values=$database->getReference('devices')->getValue();
            if(is_array($values)){
            foreach($values as $key=>$value){
                // dd($value);
                if($value["id"]==$Device->id){
                    $insert=$database->getReference("devices/".$key)->set($room);
                }
            }
        }
            // $insert=$database->getReference("rooms")->set($data);
            return responseSuccess(new DeviceResource($Device->refresh()), 'data Updated successfully');
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
                $values=$database->getReference('devices')->getValue();
                if(is_array($values)){
                foreach($values as $key=>$value){
                    if($value["id"]==$id){
                        $insert=$database->getReference("devices/".$key)->remove();
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
