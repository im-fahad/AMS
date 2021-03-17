<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:200',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return bad_req_res();
        }

        $user = $request->all();
        $user['password'] = bcrypt($request->password);

        User::create($user);

        return success_res('User Created Successfully!');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:200',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return bad_req_res();
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return unauthorized_res();
        }

        $user = User::where('email', $request->email)->first();

        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status' => 200,
            'token' => $tokenResult
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return success_res('Token Deleted Successfully!');
    }
}
