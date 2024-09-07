<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UnitResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('unit.passwords.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
                    ->subject('Reset Password Notification')
                    ->line('You are receiving this email because we received a password reset request for your account.')
                    ->action('Reset Password', $url)
                    ->line('This password reset link will expire in 60 minutes.')
                    ->line('If you did not request a password reset, no further action is required.');
    }
}
