<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserLeaveRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $LeaveRequestDetailsArray;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $LeaveRequestDetailsArray)
    {
        //instance attribute
        $this->LeaveRequestDetailsArray = $LeaveRequestDetailsArray;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $LeaveRequestDetailsArray = $this->LeaveRequestDetailsArray;
        $admin_email = $LeaveRequestDetailsArray['admin_email'];
        $username = $LeaveRequestDetailsArray['username'];
        $department = $LeaveRequestDetailsArray['department'];
        $request_reason = $LeaveRequestDetailsArray['request_reason'];
        $start_date = $LeaveRequestDetailsArray['start_date'];
        $end_date = $LeaveRequestDetailsArray['end_date'];

        return $this->view('notifications.userLeaveRequestEmail')->with([
            'admin_email' => $admin_email,
            'username' => $username,
            'department' => $department,
            'request_reason' => $request_reason,
            'start_date' => $start_date,
            'end_date' => $end_date
        ])->subject('USER LEAVE REQUEST MAIL NOTIFICATION');
    }
}
