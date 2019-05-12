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
        $data += $this->getAccountsData();


        return $data;
    }

    private function getAccountsData()
    {
        $accounts = $this->accounts()->paginate(static::MAX_ACCOUNTS);

        $data['accounts']['data'] = Account::collection($accounts);
        $data['accounts']['links']['all'] = route('user.accounts', ['user' => $this->id]);
        $data['accounts']['meta']['total'] = $accounts->total();
        $data['accounts']['meta']['per_page'] = $accounts->perPage();

        return $data;
    }
}
