<?php

namespace App\Http\Resources;
use App\Http\Resources\LookUps\StateResource;
use App\Http\Resources\LookUps\RegionResource;
use App\Http\Resources\LookUps\CountryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed email
 * @property mixed phone
 * @property mixed avatar
 * @property mixed type
 * @property mixed position
 * @property mixed active
 * @property mixed roles
 */
class UserResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'parent_id' => $this->parent_id,
            'type' => $this->type,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'rate' => $this->rate,
            'status' => $this->status,
            'active' => $this->active,
            'enable_notification' => $this->enable_notification,
            'logo' => $this->logo,
            'country' => new CountryResource($this->country()->first()),
            'state' => new StateResource($this->state()->first()),
            'region' =>  new RegionResource($this->region()->first()),
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
