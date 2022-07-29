<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;

use App\Http\Repositories\Eloquent\Category\CategoryRepo;
use App\Http\Requests\BulkDeleteRequest;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\SearchResource;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class CategoryController extends Controller
{
    protected $repo;
    public function __construct(CategoryRepo $repo)
    {
        $this->repo = $repo;
    }

    public function index(PaginateRequest $request)
    {
        $input = $this->repo->inputs($request->all());
        $model = new Category();
        $columns = Schema::getColumnListing($model->getTable());

        if (count($input["columns"]) < 1 || (count($input["columns"]) != count($input["column_values"])) || (count($input["columns"]) != count($input["operand"]))) {
            $wheres = [];
        } else {
            $wheres = $this->repo->whereOptions($input, $columns);

        }
        $data = $this->repo->Paginate($input, $wheres);

        return responseSuccess([
            'data' => $input["resource"] == "all" ? CategoryResource::collection($data) : SearchResource::collection($data),
            'meta' => [
                'total' => $data->count(),
                'currentPage' => $input["offset"],
                'lastPage' => $input["paginate"] != "false" ? $data->lastPage() : 1,
            ],
        ], 'data returned successfully');
    }

    public function get($Category)
    {
        $data = $this->repo->findOrFail($Category);

        return responseSuccess([
            'data' => new CategoryResource($data),
        ], 'data returned successfully');
    }



    public function store(CategoryRequest $request)
    {
        $input = [
            'name' => $request->name
            ];

         $data = $this->repo->create($input);


        if ($data) {
            return responseSuccess(new CategoryResource($data), 'data saved successfully');
        } else {
            return responseFail('something went wrong');
        }

    }

    public function update($Category, CategoryRequest $request)
    {
        $Category = $this->repo->findOrFail($Category);
        $input = [
            'name' => $request->name ??  $Category->name,

        ];

            $data = $this->repo->update($input, $Category);

          if ($data) {

            return responseSuccess(new CategoryResource($Category->refresh()), 'data Updated successfully');
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
