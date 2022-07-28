<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ads extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function advertiser()
    {
        return $this->belongsTo('App\Models\Advertiser', 'advertiser_id', 'id');
    }
}
