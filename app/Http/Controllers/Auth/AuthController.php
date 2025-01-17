<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('KlinikApp')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success);
        } else {
            return $this->sendError('Wrong email or password!');
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->sendResponse(null);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $params = $request->validated();
            $params['password'] = bcrypt($params['password']);
            $user = new User($params);
            $user->save();

            $user->userDetail()->create($params);
            $user->userMerchant()->create($params);

            return $this->sendResponse($user);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
