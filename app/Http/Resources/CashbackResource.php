<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashbackResource extends JsonResource
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
            'ristretto' => $this->resource['Ristretto'],
            'espresso' => $this->resource['Espresso'],
            'lungo' => $this->resource['Lungo'],
            'sum' => $this->resource->sum(),
        ];
    }
}
