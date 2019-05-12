<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\Account as AccountResource;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    const ACCOUNTS_PER_PAGE = 10;

    public function getAccountsByUser(User $user)
    {
        return AccountResource::collection(
        	$user
        		->accounts()
        		->paginate(static::ACCOUNTS_PER_PAGE)
        );
    }
}
