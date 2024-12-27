<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'order_number' => $this->order_number,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'customer_phone_no' => $this->customer_phone_no,
            'customer_address' => $this->customer_address,
            'location' => $this->location,
            'discount_code' => $this->discount_code,
            'discount' => $this->discount,
            'delivery_date' => $this->delivery_date,
            'total_quantity' => $this->total_quantity,
            'subtotal' => $this->subtotal,
            'shipping_fee' => $this->shipping_fee,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at,
            'items' => OrderItemResource::collection($this->whenLoaded('items')),
            'user' => new UserResource($this->whenLoaded('user')),
            'status_history' => OrderStatusHistoryResource::collection($this->whenLoaded('statusHistory')),
        ];
    }
}