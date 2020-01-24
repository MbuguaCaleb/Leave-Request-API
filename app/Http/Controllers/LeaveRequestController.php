<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\leaverequest;
use Illuminate\Support\Facades\Validator;



class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validating for the incoming Request

        $response = array(
            'response' => ''
        );

        //Validator
        $validator = Validator::make($request->all(), [
            'starting_date' => 'required',
            'ending_date' => 'required',
            'request_reason' => 'required',

        ]);

        if ($validator->fails()) {

            $response['response'] = $validator->messages();

            return response()->json([
                'errors' => $response,

            ], 422);
        }

        //Creating the Request if the Validation does pass
        //Creating a New Instance of the User After the Validation Has Passed
        $userRequest = new leaverequest();

        $userRequest->starting_date = $request->starting_date;
        $userRequest->ending_date = $request->ending_date;
        $userRequest->request_reason = $request->request_reason;
        $userRequest->approval_status = false;
        $userRequest->user_id = Auth::user()->id;


        if ($userRequest->save()) {

            return '1';
            //Send Notification Mail to the Admin
        } else {

            return '2';

            //Error during the Request
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
