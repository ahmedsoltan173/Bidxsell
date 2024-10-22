<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventReminder extends Notification implements ShouldQueue
{
    use Queueable;

    private $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Event Reminder')
            ->line('You have an upcoming event: ' . $this->event->event_name)
            ->line('Event starts at: ' . $this->event->event_date_time)
            ->action('View Event', url('/events/' . $this->event->id))
            ->line('Thank you for using our application!');
    }
}
