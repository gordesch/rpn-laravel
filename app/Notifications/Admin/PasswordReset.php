<?php

namespace App\Notifications\Admin;

use App\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PasswordReset extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     */
    public string $token;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<string>
     */
    public function via(Admin $notifiable): array
    {
        // return $notifiable->prefers_sms ? ['nexmo'] : ['mail', 'database'];
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(Admin $notifiable): MailMessage
    {
        $url = url(config('app.url').route('admin.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage())
            ->subject(Lang::get('Demande de réinitialisation du mot de passe'))
            ->line(Lang::get('Vous recevez cet email parce que nous avons reçu une demande de réinitialisation du mot de passe pour votre compte.'))
            ->action(Lang::get('Réinitialiser le mot de passe'), $url)
            ->line(Lang::get('Ce lien expirera dans :count minutes.', ['count' => config('auth.passwords.admins.expire')]))
            ->line(Lang::get("Si vous n'avez pas demandé à changer de mot de passe, vous n'avez aucune action à effectuer. Votre mot de passe restera inchangé."));
    }
}
