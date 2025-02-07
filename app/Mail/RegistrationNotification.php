<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $opportunity;
    public $status;
    public $volunteer;

    public function __construct($opportunity, $status, $volunteer = null)
    {
        $this->opportunity = $opportunity;
        $this->status = $status;
        $this->volunteer = $volunteer;
    }

    public function build()
    {
        if ($this->status === 'approved') {
            return $this->view('emails.volunteer_approved')->with([
                'opportunity' => $this->opportunity,
            ])->subject("Your Registration for {$this->opportunity->oppTitle} is Approved");
        } elseif ($this->status === 'pending') {
            return $this->view('emails.organization_approval')->with([
                'opportunity' => $this->opportunity,
                'volunteer' => $this->volunteer,
            ])->subject("Approval Needed for {$this->volunteer->vName}'s Registration");
        }
    }
}
