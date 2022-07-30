<?php

namespace App\Http\Controllers\Api\Advertiser;

use App\Http\Controllers\Controller;

use App\Http\Repositories\Eloquent\Advertiser\AdvertiserRepo;
use App\Http\Requests\BulkDeleteRequest;
use App\Http\Requests\Api\AdvertiserRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\Advertiser\AdvertiserResource;
use App\Http\Resources\SearchResource;
use App\Models\Advertiser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class AdvertiserController extends Controller
{
    protected $repo;
    public function __construct(AdvertiserRepo $repo)
    {
        $this->repo = $repo;
    }

    public function index(PaginateRequest $request)
    {
        $input = $this->repo->inputs($request->all());
        $model = new Advertiser();
        $columns = Schema::getColumnListing($model->getTable());

        if (count($input["columns"]) < 1 || (count($input["columns"]) != count($input["column_values"])) || (count($input["columns"]) != count($input["operand"]))) {
            $wheres = [];
        } else {
            $wheres = $this->repo->whereOptions($input, $columns);

        }
        $data = $this->repo->Paginate($input, $wheres);

        return responseSuccess([
            'data' => $input["resource"] == "all" ? AdvertiserResource::collection($data) : SearchResource::collection($data),
            'meta' => [
                'total' => $data->count(),
                'currentPage' => $input["offset"],
                'lastPage' => $input["paginate"] != "false" ? $data->lastPage() : 1,
            ],
        ], 'data returned successfully');
    }

    public function get($advertiser)
    {
        $data = $this->repo->findOrFail($advertiser);

        return responseSuccess([
            'data' => new AdvertiserResource($data),
        ], 'data returned successfully');
    }



    public function store(AdvertiserRequest $request)
    {
        $input = [
            'name' => $request->name,
            'email' => $request->email
            ];

         $data = $this->repo->create($input);


        if ($data) {
            return responseSuccess(new AdvertiserResource($data), 'data saved successfully');
        } else {
            return responseFail('something went wrong');
        }

    }

    public function update($advertiser, AdvertiserRequest $request)
    {
        $Advertiser = $this->repo->findOrFail($advertiser);
        $input = [
            'name' => $request->name ??  $Advertiser->name,
            'email' => $request->email ??  $Advertiser->email,

        ];

            $data = $this->repo->update($input, $Advertiser);

          if ($data) {

            return responseSuccess(new AdvertiserResource($Advertiser->refresh()), 'data Updated successfully');
          } else {
            return responseFail('something went wrong');
          }



    }



    public function bulkDelete(BulkDeleteRequest $request)
    {
        DB::beginTransaction();
        try {

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
