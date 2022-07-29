<?php

namespace App\Http\Repositories\Eloquent\Tag;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Tag\TagRepoInterface;
use App\Models\Tag;


class TagRepo extends AbstractRepo implements TagRepoInterface
{
    public function __construct()
    {
        parent::__construct(Tag::class);
    }
}
