<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TvChannelResource extends JsonResource
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
            'cover_image' => url("images/tv_channels/{$this->cover_image}"),
            'frequency' => $this->frequency,
            'horizontal' => $this->horizontal,
            'satellite' => $this->satellite,
            'codec_rate' => $this->codec_rate,
            'error_correction_rate' => $this->error_correction_rate,
        ];
    }
}
