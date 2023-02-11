<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\EmailPostJob;
use App\Mail\PostsMail;
use App\Models\Post;
use App\Models\User;
use App\Enums\UserType;
use App\Enums\PostStatus;

class PostPublishJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $id;
    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $user)
    {
        //
        $this->id = $id;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $post = Post::where('id', $this->id)->first();
        $post->update(['status'=> PostStatus::PUBLISHED ]);


        EmailPostJob::dispatch($this->user, $post->title, $this->id);
    }
}
