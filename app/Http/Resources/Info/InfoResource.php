<?php

namespace App\Http\Resources\Info;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource
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
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'main_color' => $this->main_color,
            'secondary_color' => $this->secondary_color,
            'appStore_link' => $this->appStore_link,
            'googlePlay_link' => $this->googlePlay_link,
            'phone' => $this->phone,
            'bio_en' => $this->bio_en,
            'bio_ar' => $this->bio_ar,
            'privacy_en' => $this->privacy_en,
            'privacy_ar' => $this->privacy_ar,
            'agreement_en' => $this->agreement_en,
            'agreement_ar' => $this->agreement_ar,
            'icon' => $this->icon,
            'fb_link' => $this->fb_link,
            'tw_link' => $this->tw_link,
            'in_link' => $this->in_link,
            'insta_link' => $this->insta_link,
            'website_link' => $this->website_link,
            'address' => $this->address,
            'email' => $this->email,
            'phone_message' => $this->phone_message,
            'email_message' => $this->email_message,
            'main_font_color' => $this->main_font_color,
            'secondary_font_color' => $this->secondary_font_color,
            'app_version' => $this->app_version,
            'logo' => $this->logo,
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
