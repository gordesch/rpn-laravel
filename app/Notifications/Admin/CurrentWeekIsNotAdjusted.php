<?php

namespace App\Notifications\Admin;

use App\Admin;
use Gordesch\CineCarbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class CurrentWeekIsNotAdjusted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(Admin $notifiable): MailMessage
    {
        $url = $this->editWeekUrl();
        return (new MailMessage())
            ->subject("Programmation de la semaine non-réglée")
            ->line("La programmation de cette semaine n'a pas été réglée. Il faut encore ordonner les films, préciser les versions, etc.")
            ->action('Régler la programmation', $url);
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

    protected function editWeekUrl(): string
    {
        $this_week_start = CineCarbon::now()->startOfWeek();
        $week = Week::where('start', $this_week_start)->get();
        return url('admin.weeks.edit', [$week]);
    }
}
