<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class VerificationController extends Controller
{
    public function sentVerifyMail($email)
    {

        if (auth()->user()) {

            $user = User::where('email', $email)->get();
            if (count($user) > 0) {

                $verifyToken = Str::random(40);
                $domain = URL::to('/');
                $url = $domain . '/verify-email/' . $verifyToken;
                $data['url'] = $url;
                $data['email'] = $email;
                $data['title'] = "Email Verification";
                $data['body'] = "Click the following link to verify your email:";



                Mail::send('verifyMail', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])->subject($data['title']);
                });

                $user = User::find($user[0]['id']);

                $user->verification_token = $verifyToken;
                $user->verification_expires_at = Carbon::now()->addMinutes(60)->format('Y-m-d H:i:s');
                $user->save();

                return response()->json([
                    'success' => true,
                    'msg' => 'Verification email has been sent successfully! Please check your inbox.',
                ]);
            }

            return response()->json([
                'success' => false,
                'msg' => 'No user found with this email.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'User is not Authenticated.',
            ]);
        }
    }

    public function verifyEmail($token)
    {

        $user = User::where('verification_token', $token)->get();
        // dd($user[0]['verification_expires_at'] > Carbon::now());
        if (count($user) > 0 && $user[0]['verification_expires_at'] > Carbon::now()) {
            $user = User::find($user[0]['id']);
            $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->verification_token = null;
            $user->verification_expires_at = null;
            $user->save();


            return redirect()->route('user.dashboard')->with('success', 'Email verified successfully.');
        } else {
            return view('404');
        }

        return response()->json([
            'success' => false,
            'msg' => 'Invalid or expired token.',
        ]);
    }
}
