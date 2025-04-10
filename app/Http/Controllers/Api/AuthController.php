<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Repositories\AuthRepositoryInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequest $request)
    {

        $user = $this->authRepository->authenticate($request);
        if ($user) {
            return response()->json(['message' => 'logged in','data'=>new UserResource($user)]);
        }
        return response()->json(['message' => 'invalid credentials'], 404);
    }

    public function logout(Request $request)
    {
        $this->authRepository->logout($request);
        return response()->json(['message' => 'logged out']);
    }
}


