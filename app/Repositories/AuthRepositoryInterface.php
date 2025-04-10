<?php

namespace App\Repositories;

interface AuthRepositoryInterface
{
    public function authenticate($request);

    public function logout($request);

}
