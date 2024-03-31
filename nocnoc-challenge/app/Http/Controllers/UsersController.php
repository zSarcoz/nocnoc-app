<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Response;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const NUMBER_OF_USERS_PER_PAGE = 10;
    public function index()

    {
       $users = User::paginate(self::NUMBER_OF_USERS_PER_PAGE);
       return inertia("Users/Index",['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Users/Create');
    }

  /**
     * Store a newly created resource in storage.
     * 
     * @param App\Http\Requests\TaskRequest
     * @return \Illuminate\Http\Response
     */

     public function store(UserRequest $request)
     {
         User::create($request->validated());
         return redirect()->route('users.index');
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
