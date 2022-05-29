<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\HourResource;

class TVTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [    
            'id' => $this->id,
            'name' => $this->name,
            'from_hour' => $this->tvhours != null ? $this->tvhours->from_hour : null,
            'to_hour' => $this->tvhours != null ? $this->tvhours->to_hour : null
        ];
    }
}
