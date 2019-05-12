<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        return new UserResource($user);
    }
}
