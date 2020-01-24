<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Notifications\SignupActivate;
use App\Notifications\UserWelcomeNotification;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */

    //User SignUp
    public function signup(Request $request)
    {


        //Catching Validation Errors

        $response = array(
            'response' => ''
        );

        //Validator
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'department' => 'required',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {

            $response['response'] = $validator->messages();

            return response()->json([
                'errors' => $response,

            ], 422);
        }



        //Creating a New Instance of the User After the Validation Has Passed
        $user = new User();

        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->department = $request->department;
        $user->is_admin = false;
        $user->activation_token = Str::random(60);


        if ($user->save()) {
            //Sending the account confirmation Email to the User
            $user->notify(new SignupActivate($user));
            return response()->json([
                'message' => 'Successfully created user!',
                'user' => $user,
                'activation_url' => "http://localhost:8000/api/auth/signup/activate/" . $user->activation_token,
                'status' => 201
            ], 201);
        } else {
            return response()->json([
                'message' => 'Error in Creating User!',
                'status ' => 500
            ], 500);
        }
    }

    //Sign Up Activate
    public function signupActivate($token)
    {

        //Authencticating  the token

        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.',
                "status" => 403
            ], 403);
        }

        $user->active = true;
        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $user->activation_token = 'token_verified';

        if ($user->save()) {
            return response()->json([
                'message' => 'Link Verified Successfully.Kindly Proceed to put in your Password',
                "data" => $user,
                "status" => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'An error was encountered while activating your token.',
            ], 404);
        }
    }


    //Submitting the Password After Verified Account Confirmation
    public function submitPassword(Request $request)
    {

        //Validation
        $response = array(
            'response' => ''
        );

        //Validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {

            $response['response'] = $validator->messages();

            return response()->json([
                'errors' => $response,

            ], 422);
        }


        //Searching to verify if the token is valid

        $user = User::where([
            ['active', true],
            ['email', $request->email],
        ])->first();

        if (!$user) {

            return response()->json([
                'message' => 'This is not a registred User !',
                'status' => '200'

            ], 404);
        } else {

            $user->password = bcrypt($request->password);
            $user->save();

            if ($user->save()) {

                //Sending a Welcome Notification to the User
                $user->notify(new UserWelcomeNotification($user));
                //Creating a Passport Access token
                $tokenStr = $user->createToken('Personal Access Token');
                return response()->json([
                    'message' => 'Password Successfully set.',
                    'user' => $user,
                    'access_token' => $tokenStr->accessToken,
                    'status' => '200',
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenStr->token->expires_at
                    )->toDateTimeString(),
                ], 200);
            }
        }
    }
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {

        //Validation
        $response = array(
            'response' => ''
        );

        //Validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {

            $response['response'] = $validator->messages();

            return response()->json([
                'errors' => $response,

            ], 422);
        }

        //User LogIn Credentials
        $credentials = request(['email', 'password']);

        //If Authirization fails
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);


        //else
        $user = $request->user();

        //Creating a token
        $tokenResult = $user->createToken('Personal Access Token');

        //fetch token from the object
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            "message" => "User successfully logged in!",
            "data" => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'status' => 200,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }


    //Revoking the token
    //Destroying the token from the Session
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {

        //entails the rovoking of the generated Token
        $request->user()->token()->revoke();
        return response()->json([
            "data" => "token revoked!",
            'message' => 'Successfully logged out',
            "status" => 200
        ]);
    }

    //Test fot the Authencticated User
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {

        //getting the user after you are logged in
        //From the token
        $user = $request->user();
        return response()->json(["data" => "user successfully fetched from the token", 'user' => $user, "status" => 200]);
    }
}
