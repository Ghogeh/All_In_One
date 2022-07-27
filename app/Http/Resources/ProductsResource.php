<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $user = User::find($this->user_id);
        $image = public_path().'/storage/products/'.$this->image;

        return [
            'name' => $this->name,
            'quantity' => $this->quantity,
            'owner' => $user->name,
            'price' => $this->price,
            'image' =>$image,
        ];
    }
}
