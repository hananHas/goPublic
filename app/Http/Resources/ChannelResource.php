<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
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
            'logo' => $this->logo,
            'frequency' => $this->frequency,
            'horizontal' => $this->horizontal == 0 ? 'عمودي' : 'أفقي',
        ];
    }
}
