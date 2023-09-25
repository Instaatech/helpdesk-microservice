<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
       $credentials = $request->validate([
            'email' => ['required','email:filter'],
            'password' => ['required','string']
        ]);

        if(Auth::attempt($credentials,true))
        {
            $token = auth()->user()->createToken('app')->accessToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Logged in successfully',
                'token' => $token,
                'data' => auth()->user()
            ],Response::HTTP_OK);
        }else{
            return $this->errorResponse('Invalid email or password',Response::HTTP_BAD_REQUEST);
        }
    }
}
