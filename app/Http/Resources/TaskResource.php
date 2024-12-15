<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            "task_id"=>$this->task_id,
            "title"=>$this->title,
            "description"=>$this->description,
            "status"=>$this->status,
            "due_date"=>$this->due_date,
            "catigory_id"=>$this->catigory_id,
            "user_id"=>$this->user_id,
            // "created_at"=>$this->created_at,
            // "updated_at"=>$this->updated_at,
        ];
    }
}
