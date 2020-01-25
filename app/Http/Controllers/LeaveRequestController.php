<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\leaverequest;
use App\Mail\UserLeaveRequestMail;
use Illuminate\Support\Facades\Mail;
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

        //Authorizining for admin only
        //Viewing all the leave requests

        if (Auth::user()->is_admin) {
            $existingLeaveRequests = leaverequest::all();

            //Loading the Leave requests with the user Relatioships.
            $all_users = $existingLeaveRequests->load('user');
            return response()->json([
                "data" => $all_users,
                "message" => "Data for a all users fetched successfully.(user is admin)",
                "status" => 200
            ]);
        } else {

            $user_id = Auth::user()->id;
            $single_leave_request = leaverequest::where('id', $user_id)->with('user')->first();
            return response()->json([
                "data" => $single_leave_request,
                "message" => "Data for a single user fetched successfully.(user is not admin)",
                "status" => 200
            ]);
        }
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

        //Sending Notification Email to the admin
        //Admin email from Env
        $admin_email = env('ADMIN_EMAIL');

        $user_object = Auth::user();
        $username = $user_object->username;
        $department = $user_object->department;
        $request_reason = $request->request_reason;
        $start_date = $request->starting_date;
        $end_date = $request->ending_date;

        //associative array to be sent via email
        $LeaveRequestDetailsArray = ["admin_email" => $admin_email, "username" => $username, "department" => $department, "request_reason" => $request_reason, "start_date" => $start_date, "end_date" => $end_date];

        if ($userRequest->save()) {
            Mail::to($admin_email)->send(new UserLeaveRequestMail($LeaveRequestDetailsArray));
            return response()->json([
                "message" => "Congratulations!You have Successfully made a Request for your leave and your details have been sent to the admin for approval",
                "data" => $userRequest,
                "status" => 200
            ]);

            //Send Notification Mail to the Admin
        } else {
            //Error during the Request

            return response()->json([
                'message' => 'Please try again later!There was an error during submission of your request',
                'status ' => 500
            ], 500);
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
