<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Oauth_access_token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class AuthController extends Controller
{

    public function token(Request $request): Response|Application|ResponseFactory
    {
        $requestData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where([['email', $requestData['email']]])->first();

        if (!$user || !Hash::check($requestData['password'], $user->password)) {
            return response(
                [
                    'message' => 'These credentials do not match with our records.'
                ],
                401
            );
        }

        return $this->getPersonalAccessTokenResponse($user);
    }


    private function getPersonalAccessTokenResponse(User $user): Response|Application|ResponseFactory
    {
        $profile = $user->role;

        Oauth_access_token::where('user_id', $user->id)->update(['revoked' => true]);
        $accessToken = $user->createToken('authToken', ["$profile"]);

        return response(
            [
                'name' => trim($user->name),
                'access_token' => $accessToken->accessToken,
                'profile' => $profile
            ]
        );
    }

}
