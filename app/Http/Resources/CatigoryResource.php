<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatigoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "catigory_id"=>$this->catigory_id,
            "catigory_name"=>$this->catigory_name,
            "color"=>$this->color,
            "user_id"=>$this->user_id,
            // "created_at"=>$this->created_at,
            // "updated_at"=>$this->updated_at,
        ];
    }
}
