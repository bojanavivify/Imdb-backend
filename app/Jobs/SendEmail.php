<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Str;
use App\Mail\MyMail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    protected $movie;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $details = [
            'title' => 'Movie is added!',
            'title-movie' => $this->movie->title,
            'description' => $this->movie->description,
            'image' => $this->checkUrl($this->movie->image->name),
        ];

        \Mail::to(\Config::get('app_vars.adminEmail'))->send(new MyMail($details));
    }

    public function checkUrl($name)
    {
        if(Str::contains($name, 'https://'))
        {
            return $name;
        }else{
            return storage_path().'/app/public/images/'.$name;
        }
    }
}
