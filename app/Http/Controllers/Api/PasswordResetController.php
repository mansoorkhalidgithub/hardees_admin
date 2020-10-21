<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\User;
use App\PasswordReset;


class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();

        //dd($user);
        if (!$user){

        	$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => 'We cant find a user with that e-mail address.',
			];

			return response()->json($response);
        }
            /*return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ], 404);*/

        		/*$passwordReset = PasswordReset::updateOrCreate(
		            ['email' => $user->email],
		            [
		                'email' => $user->email,
		                'token' => str_random(60)
		            ]
	        	);*/

	        	$passwordReset = PasswordReset::firstOrCreate(
		            ['email' => $user->email],
		            [
		                'email' => $user->email,
		                'token' => str_random(60)
		            ]
	        	);

        if ($user && $passwordReset)
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );

        	//dd($user);
        /*return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);*/

        $response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'We have e-mailed your password reset link!',
			//'data' => $passwordReset
		];

		return response()->json($response);
    }

    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token, Request $request)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();

        if (!$passwordReset){

            /*return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);*/

        	$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => 'This password reset token not found.',
			];
			return response()->json($response);
        }
        if (Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
            $passwordReset->delete();
            /*return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);*/

            $response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => 'This password reset token is invalid.',
			];
			return response()->json($response);
        }

        $response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Password reset token is valid.',
			'data' => $passwordReset
		];
		return response()->json($response);

        //return response()->json($passwordReset);
    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();

        if (!$passwordReset){

        	/*$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => 'This password reset token is invalid.',
			];
			return response()->json($response);*/

            return redirect()->back()->withInput()->withErrors(['This password reset token is invalid.']);

            /*return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);*/
        }

    	$user = User::where('email', $passwordReset->email)->first();
        if (!$user){

            /*return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ], 404);*/

            /*$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => 'We cant find a user with that e-mail address.',
			];
			return response()->json($response);*/

            return redirect()->back()->withInput()->withErrors(['We cant find a user with that e-mail address.']);
        }

        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->where('email', $request->email)->delete();
        //$user->notify(new PasswordResetSuccess($passwordReset));

        /*$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Now you can login',
		];
		return response()->json($response);*/
        
        return redirect()->back()->withInput()->withErrors(['Now you can login']);
    }

    public function resetForm(Request $request)
    {
        
        //dd($request->email);
    	return view('auth.passwords.api_reset')->with(
            ['token' => $request->token]
        );
    }
}
