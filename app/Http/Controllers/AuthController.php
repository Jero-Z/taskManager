<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $exception) {
            return response()->json(['error' => true, 'message' => '登陆失败'],500);
        }
        $user = \Auth::user();

        \Auth::login($user, true);

        return response()->json([
            'cookie' => [
                config('session.cookie') => \Session::getId(),
            ],
        ]);
    }

    public function logout(Request $request)
    {
        \Auth::logout();

        return response()->json([
            'message' => '操作成功'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tokenRefresh(Request $request)
    {
        $response = response();
        try {

            $newToken = JWTAuth::setRequest($request)->parseToken()->refresh();

        } catch (TokenExpiredException $e) {

            return $response->json([
                'error' => true,
                'message' => 'token_expired',
            ], $e->getStatusCode());
        } catch (JWTException $e) {
            return $response->json([
                'error' => true,
                'message' => 'token_invalid',
            ], $e->getStatusCode());
        }
        return response()->json([
            'token' => $newToken
        ]);

    }
}
