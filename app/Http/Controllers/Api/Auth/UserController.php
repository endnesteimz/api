<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ResponseFormatter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TokenRequest;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class UserController extends Controller
{
    /**
     * Get the authenticated User.
     *
     * @param TokenRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(TokenRequest $request)
    {
        $user = JWTAuth::authenticate($request->token);

        return response()->json([
            'status' => 'success',
            'user' => $user
        ], 200);
    }

    public function fetch(Request $request)
    {
        return ResponseFormatter::success(
            $request->user(), 'Fetched user data'
        );
    }

    public function updateProfile(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();
        $user->update($data);

        return ResponseFormatter::success($user, 'Profile Updated');
    }

    public function updatePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|max:2048'
        ]);

        if($validator->fails())
        {
            return ResponseFormatter::error(
                ['error' => $validator->errors()],
                'Update photo fails',
                401
            );
        }

        if($request->file('file'))
        {
            $file = $request->file->store('assets/user','public');

            $user = Auth::user();
            $user->profile_photo_path = $file;
            $user->update();

            return ResponseFormatter::success([$file], 'File successfully uploaded');
        }
    }
}
