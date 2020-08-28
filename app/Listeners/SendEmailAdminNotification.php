<?php

namespace App\Listeners;

use App\Events\SendEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\MyMail;

class SendEmailAdminNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendEmail  $event
     * @return void
     */
    public function handle(SendEmail $event)
    {
        $data = $event->object;

        $details = [
            'title' => 'Movie is added!',
            'title-movie' => $data->title,
            'description' => $data->description,
            'image' => storage_path().'/app/public/images/'. ($data->image->name),
        ];
       
        \Mail::to(\Config::get('app_vars.adminEmail'))->send(new MyMail($details));
    }
}
