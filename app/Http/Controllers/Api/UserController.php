<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login() {
        return [
            'id' => 1,
            'username' => 'cesarkohl@gmail.com',
            'firstName' => 'Cesar',
            'lastName' => 'Kohl',
            'token' => 'fake-jwt-token'
        ];
    }
}
