<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Cache;

class DashControl extends Controller
{
    //

    public function dashboard(){
        return view('dashboard.index', 
        ['post_count' => Post::where('created_by', auth()->user()->id)
                        ->where('created_at', now()->toDateString())
                        ->count()]);
    }

    public function posts(){
        if(!(auth()->check())){
            return redirect('/login');
        }
        $today = now()->toDateString();
        $posts = Cache::remember('user_posts', 60, function(){

            return Post::with(['likes'])->where('created_by', auth()->user()->id)->latest()->get();
        });
        $posts_today = Cache::remember('post_count', 60, function()use($today){

            return Post::where('created_by', auth()->user()->id)->whereDate('created_at', $today)->count();
        });
        
        return view('dashboard.posts', [
            'posts' => $posts,
            'posts_today' => $posts_today]);
    }

    public function showPlans(){
        return view('dashboard.plans');
    }

    public function show($id){
        return view('dashboard.show', ['post' => Post::with(['likes'])->where('id', $id)->first(), 'edit' => false, 
        'liked'=> Like::where(function($query)use($id){
            if(auth()->check()){
                $query->where('product_id', $id)->where('user_id', auth()->user()->id);
            }
        })->first()]);
    }
}
