<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'register',
                'forgetPassword',
                'forgetPassView'
            ]
        ]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        //event fire
        event(new UserRegistered($user));


        // $this->sentVerifyMail($request->email);
        return response()->json([
            'success' => true,
            'message' => 'User registered successfully! Check your mail to verify mail!',
            'user' => $user
        ], 201);
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json([
                'success' => false,
                'msg' => 'Invalid email or password!'
            ]);
        }

        return $this->responseWithToken($token);
    }

    public function responseWithToken($token)
    {
        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
            'redirect' => route('user.dashboard')
        ]);
    }





    //logout
    public function logout()
    {
        try {
            auth()->logout();
            return response()->json([
                'success' => true,
                'msg' => 'User successfully logged out!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    public function profileData()
    {
        return view('profile');
    }

    //profile
    public function profile()
    {

        try {

            return response()->json([
                'success' => true,
                'data' => auth()->user(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }
}
