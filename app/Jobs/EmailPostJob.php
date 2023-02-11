<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostsMail;
use App\Models\User;
use App\Enums\UserType;

class EmailPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $user;
    protected $title;
    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $title, $id)
    {   
        $this->user = $user;
        $this->title = $title;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $admins = User::where('user_type', UserType::ADMIN)->get('email');
        foreach($admins as $admin){
            Mail::to($admin->email)->send(new PostsMail($this->user, $this->title, $this->id));
        }
    }
}
