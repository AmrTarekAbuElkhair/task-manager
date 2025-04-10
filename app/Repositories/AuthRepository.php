<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function authenticate($request)
    {
        // If the email is provided, authenticate using email, otherwise use phone number
        $user = null;
        $user = $this->user->where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return $user;
        }
        return null;
    }

    public function logout($request)
    {
        $request->user()->currentAccessToken()->delete();
    }

}
