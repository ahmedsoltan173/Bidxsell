<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Notifications\EventReminder;
use Illuminate\Console\Command;

class sendMailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-mails-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::with('tickets')
        // where('event_date_time', '>=', now()->addHours(6))
        // ->where('event_date_time', '<=', now()->addHours(6))
        ->get();
        $this->info($events);
    foreach ($events as $event) {
        $event->notifiable->notify(new EventReminder($event));
    }
    }
}
