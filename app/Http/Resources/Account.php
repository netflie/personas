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
        $data += $this->getTransactionsData();

        return $data;
    }

    private function getTransactionsData()
    {
        $transactions = $this->transactions()->paginate(static::MAX_TRANSACTIONS);
        $data['transactions']['data'] = Transaction::collection($transactions);
        $data['transactions']['links']['all'] = route('account.transactions', ['account' => $this->id]);
        $data['transactions']['meta']['total'] = $transactions->total();
        $data['transactions']['meta']['per_page'] = $transactions->perPage();

        return $data;
    }
}
