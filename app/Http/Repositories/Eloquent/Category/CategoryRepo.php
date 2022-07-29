<?php

namespace App\Http\Repositories\Eloquent\Category;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Category\CategoryRepoInterface;
use App\Models\Category;


class CategoryRepo extends AbstractRepo implements CategoryRepoInterface
{
    public function __construct()
    {
        parent::__construct(Category::class);
    }
}
