<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{

    //forget password api method
    public function forgetPassword(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
            $user = User::where('email', $request->email)->get();
            if (count($user) > 0) {


                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain . '/reset-password?token=' . $token;

                $data = [
                    'url' => $url,
                    'email' => $request->email,
                    'title' => 'Password Reset Request',
                    'body' => 'Please click on the link below to reset your password.'
                ];

                Mail::send('auth.forgetPassMail', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])->subject($data['title']);
                });

                $datetime = Carbon::now()->format('Y-m-d H:i:s');
                PasswordReset::UpdateOrCreate(
                    ['email' => $request->email],
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $datetime
                    ]
                );
                return response()->json([
                    'success' => true,
                    'msg' => 'Please check your mail to reset your password!'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }


    //reset password view load
    function resetPassLoad(Request $request)
    {
        if (isset($request->token)) {
            $resetData = PasswordReset::where('token', $request->token)->first();
            if ($resetData) {
                $user = User::where('email',$resetData->email )->first();
                // dd($user);
                return view('auth.reset-password', compact('user'));
            } else {
                return view('auth.404');
            }
        } else {
            return view('auth.404');
        }
    }


    //password reset function
    function resetPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors());
        }


        $user = User::find($request->id);
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            $del = PasswordReset::where('email', $user->email)->delete();
            return response()->json(['success' => true, 'msg' => 'Password reset successfully']);
        } else {
            return response()->json(['success' => false, 'msg' => 'User not found!']);
        }
    }
}
