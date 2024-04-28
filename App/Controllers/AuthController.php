<?php

namespace App\Controllers;

use App\Traits\ResponseTrait;
use App\Auth\JWTAuth as JWTAuth;

class AuthController
{
    use ResponseTrait;
    use JWTAuth;

    public function login($request)
    {
        // Example validation: check if username is 'admin' and password is 'admin123'
        if ($request->username === 'admin' && $request->password === 'admin123') {
            // Generate JWT token
            $token = $this->generateToken($request->username, $request->password);

            // Return token as JSON response
            return $this->sendResponse(['token' => $token]);
        } else {
            // If credentials are not valid, return error response
            return $this->sendResponse(['error' => 'Unauthorized'], 401);
        }
    }

    public function verify($request){
        $verification = $this->verifyToken($request->token);
        return $this->sendResponse($verification);
    }
}