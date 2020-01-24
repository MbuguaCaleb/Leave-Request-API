<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Validator;




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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        if ($validator->fails()) {

            $response['response'] = $validator->messages();

            return response()->json([
                'errors' => $response,

            ], 422);
        }

        //Creating a New Instance of the User After the Validation Has Passed
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($user->save()) {
            return response()->json([
                'message' => 'Successfully created user!',
                'user' => $user,
                'status' => 201
            ], 201);
        } else {

            return response()->json([
                'message' => 'Error in Creating User!',
                'status ' => 500
            ], 500);
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
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);


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
