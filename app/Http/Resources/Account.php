<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Account extends JsonResource
{
    const MAX_TRANSACTIONS = 5;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['transactions']['data'] = Transaction::collection($this->transactions()->paginate(static::MAX_TRANSACTIONS));
        $data['transactions']['links']['all'] = "http://";

        return $data;
    }
}
