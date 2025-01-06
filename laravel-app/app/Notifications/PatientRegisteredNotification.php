<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PatientRegisteredNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $patient;

    public function __construct($patient)
    {
        $this->patient = $patient;
    }


    public function via($notifiable)
    {
        return ['mail']; // Add 'sms' here in the future
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Patient Registration Successful')
            ->greeting('Hello ' . $this->patient->name)
            ->line('Your registration has been successful.')
            ->line('Thank you for registering!');
    }

    public function toSms($notifiable)
    {   // Future feature, TODO
        // Define SMS content here (use Twilio,etc.)
        return 'Hello ' . $this->patient->name . ', your registration has been successful!';
    }
}
