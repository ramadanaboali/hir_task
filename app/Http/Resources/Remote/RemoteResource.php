<?php

namespace App\Http\Resources\Remote;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RemoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'plusbtn' => $this->plusbtn,
            'minusbtn' => $this->minusbtn,
            'upbtn' => $this->upbtn,
            'downbtn' => $this->downbtn,
            'okbtn' => $this->okbtn,
            'powerbtn' => $this->powerbtn,
            'segmant' => $this->segmant,
            'flag' => $this->flag,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->user),
            'active' => $this->active,
            'create_dates' => [
                'created_at_human' => $this->created_at->diffForHumans(),
                'created_at' => $this->created_at
            ],
            'update_dates' => [
                'updated_at_human' => $this->updated_at->diffForHumans(),
                'updated_at' => $this->updated_at
            ],
        ];
    }
}
