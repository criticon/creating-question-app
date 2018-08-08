<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JWTAuth extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $id = $this->id ?? null;

        return [
            'id' => $this->when($id, $id)
        ];
    }
}
