<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\User;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    //    return parent::toArray($request);
        $fields = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'completed_at' => $this->completed_at ? date_format($this->completed_at,"Y-m-d H:i:s") : null,
        ];

        if ($this->whenLoaded('user') instanceof User) {
            $fields['user'] = new UserResource($this->whenLoaded('user'));
        } else {
            $fields['user_id'] = $this->user_id;
        }

        return $fields;
    }
}
