<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Enums\UserType;
use App\Enums\PostStatus;
use App\Jobs\PostPublishJob;
use App\Jobs\EmailPostJob;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Cache::remember('posts', 60, function(){
            return Post::with(['likes'])->latest()->where('status', PostStatus::PUBLISHED)->get();
        });
        return view('welcome', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $today = now()->toDateString();
        $form = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => 'image',
            'schedule'  => 'nullable'
        ]);
        $form['status'] = !empty($form['schedule']) ? PostStatus::UNPUBLISHED : PostStatus::PUBLISHED;
        $form['schedule']  = !empty($form['schedule']) ? date('Y-m-d H:i', strtotime($form['schedule'])) : date('Y-m-d H:i');
        // dd(now()->toDateTimeString(), date('Y-m-d H:i'), date('Y-m-d H:i', strtotime($form['schedule'])));
        $form['created_by'] = auth()->user()->id;

        if($request->image){
            $content = $request->file('image');
            $extension  = $content->getClientOriginalExtension();
            $fileName = time()."_".rand(10000, 99999).'.'.$extension;
            $temp = $request->file('image')->move(
                base_path() . '/public/image', $fileName
            );
            $form['image'] = 'image/'.$temp->getFilename();
        }

        if(auth()->user()->user_type == UserType::FREE){
            $posts_created_today = Post::where('created_by', auth()->user()->id)->whereDate('created_at', $today)->count();
            if($posts_created_today >= 2){
                return view('dashboard.create')->with('message', "Your Today's post count is ". $posts_created_today . ". Maximum 2 can be posted in a day with free membership");
            }
        }

        $post = Post::create($form);

        if($post->status == PostStatus::PUBLISHED){
            self::mailHandler(auth()->user()->name, $post->title, $post->id);
        }

        $job = (new PostPublishJob($post->id, auth()->user()->name))
            ->onConnection('database')
            // ->onQueue('posts')
            ->delay(now()->diffInSeconds($form['schedule']));

        dispatch($job);

        return back()->with('message',"Post Created Successfully");
    }

    private function mailHandler($user, $title, $id){
        
        EmailPostJob::dispatch($user, $title, $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('posts.show', ['post' => Post::with(['likes'])->where('id', $id)->first(), 'edit' => false, 
        'liked'=> Like::where(function($query)use($id){
            if(auth()->check()){
                $query->where('product_id', $id)->where('user_id', auth()->user()->id);
            }
        })->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('dashboard.edit', ['post' => Post::where('id', $id)->first(), 'edit' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        $today = now()->toDateString();
        $form = $request->validate([
            'title' => 'nullable | string',
            'description' =>'nullable | string',
            'image' => 'image',
            'schedule' => 'nullable'
        ]);

        if($request->image){
            $content = $request->file('image');
            $extension  = $content->getClientOriginalExtension();
            $fileName = time()."_".rand(10000, 99999).'.'.$extension;
            $temp = $request->file('image')->move(
                base_path() . '/public/image', $fileName
            );
            $form['image'] = 'image/'.$temp->getFilename();
        }

        if(auth()->user()->user_type == UserType::FREE){
            $posts_created_today = Post::where('created_by', auth()->user()->id)->whereDate('created_at', $today)->count();
            if($posts_created_today >= 2){
                return view('dashboard.create', ['posts_today' => $posts_created_today]);
            }
        }

        $post = Post::where('id', $id)->first();
        $post->update($form);

        if($post->status == PostStatus::UNPUBLISHED){

            $job = (new PostPublishJob($post->id, auth()->user()->name))
                ->onConnection('database')
                // ->onQueue('posts')
                ->delay(now()->diffInSeconds($form['schedule']));
            
            dispatch($job);
        }

        // Session::flash('message', 'Payment successful!');

        return redirect('/dashboard/posts')->with('message', 'Post Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $delete = Post::where('id', $id)->delete();
        
        return redirect()->back()->with('message', 'Deleted successfully');
    }
}
