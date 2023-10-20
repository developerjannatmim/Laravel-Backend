<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function user_list()
    {
        return response()->json([
            'data' => [
                'users' => User::get(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function user_store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function user_show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function user_update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function user_destroy(string $id)
    {
        //
    }
}
