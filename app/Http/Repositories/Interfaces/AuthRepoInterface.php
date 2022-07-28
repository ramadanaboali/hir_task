<?php

namespace App\Http\Repositories\Interfaces;

use App\Http\Requests\AuthLoginRequest;

interface AuthRepoInterface
{
    public function login(array $data);
    public function social_login(array $data);
    public function register(array $data);
    public function add_user(array $data);
    public function currentUser();

    public function logout($request);
}
