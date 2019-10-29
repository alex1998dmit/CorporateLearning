<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\ParticipantController;

use Auth;
use Validator;

use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $validation =  Validator::make($request->all(), [
            'username' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'messages' => $validation->errors()
            ], 400);
        }

        $https = new \GuzzleHttp\Client;
        try {
            $response = $https->post(env('APP_HOST') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => 2,
                    'client_secret' => env('APP_SECRET'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }
            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }

    public function register(Request $request)
    {
        $validation =  Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'register_type' => 'required|string|in:participant,company',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'messages' => $validation->errors()
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->register_type
        ]);

        return $request->register_type === 'participant' ? ParticipantController::register($request, $user) : CompaniesController::register($request, $user);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json('Logged out successfully', 200);
    }

    public function about()
    {
        $user = Auth::user();
        return $user;
    }
}
