<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveRequestApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $adminFeedBackDetailsArray;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $adminFeedBackDetailsArray)
    {
        //
        $this->adminFeedBackDetailsArray = $adminFeedBackDetailsArray;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $adminFeedBackDetailsArray =  $this->adminFeedBackDetailsArray;
        $request_reason = $adminFeedBackDetailsArray['request_reason'];
        $admin_feedback = $adminFeedBackDetailsArray['admin_feedback'];
        $starting_date = $adminFeedBackDetailsArray['starting_date'];
        $ending_date = $adminFeedBackDetailsArray['ending_date'];
        $username = $adminFeedBackDetailsArray['username'];

        return $this->view('notifications.adminLeaveRequestFeedBack')->with([
            'admin_feedback' => $admin_feedback,
            'starting_date' => $starting_date,
            'ending_date' => $ending_date,
            'request_reason' => $request_reason,
            'username' => $username
        ])->subject('ADMIN LEAVE REQUEST FEEDBACK NOTIFICATION');
    }
}
