<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgramDetailsResource extends JsonResource
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
            'logo' => url("images/programs/{$this->image}"),
            'presenter' => $this->presenter,
            'program_type' => $this->domain->name,
            'times' => ProgramTimeResource::collection($this->times),
            'description' => $this->description,
            'hosting_price' => $this->hosting_price,

        ];
    }
}
