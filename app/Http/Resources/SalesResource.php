<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
//            'product'=>$this->product,
            'quantity' => $this->quantity,
            'unit_cost' => (float) $this->unit_cost,
            'selling_price' => (float) $this->selling_price,
            'created_at' => $this->created_at?$this->created_at->format('Y-m-d H:i:s'):null,
            'product' => [
                'id' => $this->product->id ?? null,
                'name' => $this->product->name ?? 'N/A',
                'description' => $this->product->description ?? 'No description available',
                'profit_margin' => (float) $this->product->profit_margin ?? null,
            ]
        ];
    }
}
