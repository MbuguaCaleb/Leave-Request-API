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
        print_r($adminFeedBackDetailsArray);
        die();
        return $this->view('view.name');
    }
}
