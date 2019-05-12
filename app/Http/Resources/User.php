<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    const MAX_ACCOUNTS = 3;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['accounts']['data'] = Account::collection($this->accounts()->paginate(static::MAX_ACCOUNTS));
        $data['accounts']['links']['all'] = 'http://';

        return $data;
    }
}
