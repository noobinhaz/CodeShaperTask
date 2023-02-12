<x-dashlayout>
    <div class="d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if(!empty($post))
                    <div class="card"> 
                        <div class="card-header">{{$post->title}}</div>
                        <div class="card-body">
                        <div class="col-lg-12 mb-3">
                            
                            <img src="{{ $post->image ? asset($post->image) : 'https://via.placeholder.com/960x540' }}" class="card-img-top" alt="Post Image">
                            <div class="card-body">
                                <h5 class="card-title">{{$post->title}}</h5>
                                <p class="card-text">{{$post->description}}</p>
                                
                                @if($post->likes->count() > 0)
                                <span>
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                    {{$post->likes->count()}}
                                </span>
                                @else  
                                <span>
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                    Be the first to like this post
                                </span>
                                @endif
                                @auth
                                <div class="d-flex justify-content-center row">
                                    @if($liked)
                                    <p class="btn btn-primary text-center"><i class="fa fa-heart" aria-hidden="true"></i>Liked</p>
                                    @else
                                    <a href="/like/{{$post->id}}" class="btn btn-primary text-center"><i class="fa fa-heart" aria-hidden="true"></i>Like</a>

                                    @endif
                                </div>
                                @endauth
                                <div class="d-flex justify-content-center row">
                                    <a href="/dashboard/posts" class="btn btn-info text-center">Return</a>
                                </div>
                            </div>
                        
                        </div>
                        </div>
                    </div>
                    @else
                    <div class="card"> 
                        <div class="card-header">No Content</div>
                        <div class="card-body"><h2 class="text-warning">Maybe something went wrong!</h2></div>
                        <div class="card-body"><a href="/dashboard/posts" class="btn btn-info">Go Back</a></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-dashlayout>