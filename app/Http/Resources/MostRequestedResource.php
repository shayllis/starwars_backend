<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MostRequestedResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'term' => $this->term,
            'views' => $this->views,
        ];
    }
}
