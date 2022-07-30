<?php

namespace App\Http\Controllers\Api\Ads;

use App\Http\Controllers\Controller;

use App\Http\Repositories\Eloquent\Ads\AdsRepo;
use App\Http\Requests\BulkDeleteRequest;
use App\Http\Requests\Api\AdsRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\Ads\AdsResource;
use App\Http\Resources\SearchResource;
use App\Models\Ads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class AdsController extends Controller
{
    protected $repo;
    public function __construct(AdsRepo $repo)
    {
        $this->repo = $repo;
    }

    public function index(PaginateRequest $request)
    {
        $input = $this->repo->inputs($request->all());
        $model = new Ads();
        $columns = Schema::getColumnListing($model->getTable());

        if (count($input["columns"]) < 1 || (count($input["columns"]) != count($input["column_values"])) || (count($input["columns"]) != count($input["operand"]))) {
            $wheres = [];
        } else {
            $wheres = $this->repo->whereOptions($input, $columns);

        }
        $data = $this->repo->Paginate($input, $wheres);

        return responseSuccess([
            'data' => $input["resource"] == "all" ? AdsResource::collection($data) : SearchResource::collection($data),
            'meta' => [
                'total' => $data->count(),
                'currentPage' => $input["offset"],
                'lastPage' => $input["paginate"] != "false" ? $data->lastPage() : 1,
            ],
        ], 'data returned successfully');
    }

    public function get($ads)
    {
        $data = $this->repo->findOrFail($ads);

        return responseSuccess([
            'data' => new AdsResource($data),
        ], 'data returned successfully');
    }



    public function store(AdsRequest $request)
    {
        $input = [
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'tags' => json_encode($request->tags),
            'start_date' => $request->start_date,
            'category_id' => $request->category_id,
            'advertiser_id' => $request->advertiser_id,
            ];

         $data = $this->repo->create($input);


        if ($data) {
            return responseSuccess(new AdsResource($data), 'data saved successfully');
        } else {
            return responseFail('something went wrong');
        }

    }

    public function update($ads, AdsRequest $request)
    {
        $Ads = $this->repo->findOrFail($ads);
        $input = [
            'title' => $request->title ??  $Ads->title,
            'description' => $request->description ??  $Ads->description,
            'type' => $request->type ??  $Ads->type,
            'tags' => json_encode($request->tags) ??  $Ads->tags,
            'start_date' => $request->start_date ??  $Ads->start_date,
            'category_id' => $request->category_id ??  $Ads->category_id,
            'advertiser_id' => $request->advertiser_id ??  $Ads->advertiser_id,

        ];

            $data = $this->repo->update($input, $Ads);

          if ($data) {

            return responseSuccess(new AdsResource($Ads->refresh()), 'data Updated successfully');
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
