<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MostVisitedResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'item' => $this->item,
            'views' => $this->views,
        ];
    }
}
