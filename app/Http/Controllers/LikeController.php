<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    //

    public function store(Request $request, $id){
        
        $checkIfLiked = Like::where('product_id', $id)->where('user_id', auth()->user()->id)->first();

        if($checkIfLiked){
            return redirect()->back()->with('message', 'You have already liked this post');
        }

        Like::create([
            'product_id' => $id,
            'user_id'   => auth()->user()->id
        ]);

        return redirect()->back();
    }
}
