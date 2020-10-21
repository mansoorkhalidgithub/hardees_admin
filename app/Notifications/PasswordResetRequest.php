<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Helpers\EmailHelper;
use PHPMailer\PHPMailer\PHPMailer;
use App\Channels\VoiceChannel;

class PasswordResetRequest extends Notification
{
    use Queueable;

    protected $token;

    /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        //return ['mail'];
        return [VoiceChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
     public function toMail($notifiable)
     {
        //return  EmailHelper::resetEmailApi($this->token,$notifiable->getEmailForPasswordReset());
        
        //return true;
        /*return (new MailMessage)
            ->line('You are receiving this email because we        received a password reset request for your account.')
            ->action('Reset Password', url($url))
            ->line('If you did not request a password reset, no further action is required.');*/
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * Get the voice representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return VoiceMessage
     */
    public function toVoice($notifiable)
    {
        return EmailHelper::resetEmailApi($this->token,$notifiable->getEmailForPasswordReset());
        //return EmailHelper::resetEmail($this->token,$notifiable->getEmailForPasswordReset());
    }
}
