<?php

namespace App\Notifications\Admin;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification
{
    use Queueable;

    /**
     * Get the notification's channels.
     *
     * @return array<string>
     */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     */
    public function toMail(Admin $notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage())
            ->subject("Verifiez votre adresse email")
            ->line("Merci de cliquer sur le bouton ci-dessous pour vérifier votre adresse email.")
            ->action("Vérifier mon adresse email", $verificationUrl)
            ->line("Si vous n'avez pas créé de compte, ignorez ce message.");
    }

    /**
     * Get the verification URL for the given notifiable.
     */
    protected function verificationUrl(Admin $notifiable): string
    {
        return URL::temporarySignedRoute(
            'admin.verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
