<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserRegisterResource;
use App\Http\Resources\UserResource;
use Hash;
use Auth;
use Carbon\Carbon;
use DB;
use Validator;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'verification_token' => rand(1000, 9999),
            'is_admin' => 0
        ]);

        return new UserRegisterResource($user);
    }

    public function verify(Request $request)
    {
        $user = User::where('phone',$request->phone)->first();
        $code = $request->code;
        if($user->verification_token === $code){
            $user->verification_token = null;
            $user->email_verified_at = Carbon::now();
            $user->update();

            $token = $user->createToken('Api Token')->accessToken;
            
            return response()->json([
                'status' => 'success',
                'message' => trans('messages.verified'),
                'token' => $token,
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => trans('messages.invalid_code'),
            ]);
        }
    }

    public function resend_code(Request $request)
    {
        $user = User::where('phone',$request->phone)->first();
        $user->verification_token = rand(1000, 9999);
        $user->update();

        // $user->notify(new EmailVerificationNotification($user));

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.code_sent'),
        ],200);
         
    }

    public function login(Request $request)
    {
        $credentials = [
            'phone' => $request->phone,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if($user->verification_token != null){
                return response()->json(['message' => trans('messages.verify_your_email')], 401);

            }

            $token = $user->createToken('Api Token')->accessToken;

            return response()->json([
                'user' => new UserResource($user),
                'token' => $token,
            ]);
        }

        return response()->json(['status' => 'error','message' => trans('messages.failed_login')], 401);
    }

    public function forgot(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (! $user) {
            return response()->json(['status' => 'error' ,'message' => trans('messages.email_account_not_found')]);
        }

        $token = rand(1000, 9999);
        // $url = url('/api/auth/reset/'.$token);

        $passwordReset = DB::table('password_resets')
                            ->updateOrInsert(
                                ['email' => $user->email],
                                [
                                    'email' => $user->email,
                                    'token' => $token,
                                    'created_at' => Carbon::now()
                                ]
                            );

        if ($user && $passwordReset) {
            // $user->notify( new SendPasswordResetEmail($token, $user) );
        }

        return response()->json(['status' => 'success','message' => trans('messages.password_reset_link_sent')], 201);
    }

    public function find($token)
    {
        $passwordReset = DB::table('password_resets')->where('token', $token)->first();
        if (! $passwordReset){
            return response()->json(['status' => 'error' ,'message' => trans('messages.password_reset_token_404')]);
        }

        if (Carbon::parse($passwordReset->created_at)->addMinutes(720)->isPast()) {
            DB::table('password_resets')->where('token', $token)->delete();

            return response()->json(['status' => 'error' ,'message' => trans('messages.password_reset_token_404')], 404);
        }

        return response()->json(['status' => 'success' , 'data' => $passwordReset]);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required|string'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'error',
                'error'  => $validator->messages()->first(),
            ]); 
        }

        $passwordReset = DB::table('password_resets')->where('token', $request->token)->first();
        if (! $passwordReset){
            return response()->json(['status' => 'error' ,'message' => trans('messages.password_reset_token_404')], 404);
        }

        $customer = User::where('email', $passwordReset->email)->first();
        if (! $customer){
            return response()->json(['status' => 'error' ,'message' => trans('messages.email_account_not_found')], 404);
        }

        $customer->password = Hash::make($request->password);
        $customer->save();

        DB::table('password_resets')->where('token', $request->token)->delete();

        return response()->json(['status' => 'success' ,'message' => trans('messages.password_reset_successful')], 200);
    }

    public function logout(Request $request)
    {
        $user = Auth::user()->token();
        $user->revoke();
        
        return response()->json([
            'status' => 'success',
            'message' => trans('messages.auth_out')
        ], 200);
    }
}
