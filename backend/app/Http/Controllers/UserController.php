<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Http\Requests\User\StoreUser;
use App\Transformers\User\UserResource;
use App\Transformers\User\UserResourceCollection;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUser $request)
    {
        try {
            $user = $this
            ->user
            ->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);
        } catch(\Throwable|\Exception $e) {
            return ResponseService::exception('users.store', null, $e);
        }
        return new UserResource($user,array('type' => 'store','route' => 'users.store'));
    }
}
