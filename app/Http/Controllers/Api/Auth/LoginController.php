<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseApiToken;
use JWTAuth;
use Socialite;

class LoginController extends Controller
{
    use ResponseApiToken;

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'User not found'
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){
                if (!$token = JWTAuth::fromUser($finduser)) {
                    return response()->json([
                        'error' => 'Unauthorized',
                        'message' => 'User not found'
                    ], 401);
                }
                return $this->respondWithToken($token);

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummyA@'),
                ]);
                $checkUser = User::where('google_id', $newUser->id)->first();
                if (!$token = JWTAuth::fromUser($checkUser)) {
                    return response()->json([
                        'error' => 'Unauthorized',
                        'message' => 'User not found'
                    ], 401);
                }
                return $this->respondWithToken($token);
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


}
