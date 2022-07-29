<?php

namespace App\Http\Controllers\Api\Tag;

use App\Http\Controllers\Controller;

use App\Http\Repositories\Eloquent\Tag\TagRepo;
use App\Http\Requests\BulkDeleteRequest;
use App\Http\Requests\Api\TagRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\SearchResource;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class TagController extends Controller
{
    protected $repo;
    public function __construct(TagRepo $repo)
    {
        $this->repo = $repo;
    }

    public function index(PaginateRequest $request)
    {
        $input = $this->repo->inputs($request->all());
        $model = new Tag();
        $columns = Schema::getColumnListing($model->getTable());

        if (count($input["columns"]) < 1 || (count($input["columns"]) != count($input["column_values"])) || (count($input["columns"]) != count($input["operand"]))) {
            $wheres = [];
        } else {
            $wheres = $this->repo->whereOptions($input, $columns);

        }
        $data = $this->repo->Paginate($input, $wheres);

        return responseSuccess([
            'data' => $input["resource"] == "all" ? TagResource::collection($data) : SearchResource::collection($data),
            'meta' => [
                'total' => $data->count(),
                'currentPage' => $input["offset"],
                'lastPage' => $input["paginate"] != "false" ? $data->lastPage() : 1,
            ],
        ], 'data returned successfully');
    }

    public function get($tag)
    {
        $data = $this->repo->findOrFail($tag);

        return responseSuccess([
            'data' => new TagResource($data),
        ], 'data returned successfully');
    }



    public function store(TagRequest $request)
    {
        $input = [
            'name' => $request->name
            ];

         $data = $this->repo->create($input);


        if ($data) {
            return responseSuccess(new TagResource($data), 'data saved successfully');
        } else {
            return responseFail('something went wrong');
        }

    }

    public function update($tag, TagRequest $request)
    {
        $tag = $this->repo->findOrFail($tag);
        $input = [
            'name' => $request->name ??  $tag->name,

        ];

            $data = $this->repo->update($input, $tag);

          if ($data) {

            return responseSuccess(new TagResource($tag->refresh()), 'data Updated successfully');
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
