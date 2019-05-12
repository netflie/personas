<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Http\Resources\Transaction as TransactionResource;

class TransactionController extends Controller
{
	const MAX_TRANSACTIONS_PER_PAGE = 10;

    public function getTransactionsByAccount(Request $request, Account $account)
    {
    	return TransactionResource::collection(
    		$account
    			->transactions()
    			->paginate(static::MAX_TRANSACTIONS_PER_PAGE)
    	);
    }
}
