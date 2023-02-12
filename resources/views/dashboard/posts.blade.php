
<x-dashlayout>
    <!-- <x-flash /> -->
    @auth
        <div class="container my-5">
            <div class="inline">

                <div class="d-flex justify-content-start">
                    <a href="/posts/create" class="btn btn-info">Posts today: <strong class="text-warning">{{$posts_today}}</strong></a>
                </div>
    
                <div class="d-flex justify-content-end">
                    <a href="/posts/create" class="btn btn-success">Create new Post</a>
                </div>
            </div>
            <hr>
        <div class="row">
        @unless(count($posts) == 0)
                    @foreach ($posts as $post)
                        
                    <div class="col-lg-6 mb-3">
                        <div class="card">
                        <img src="{{ $post->image ? asset($post->image) : 'https://via.placeholder.com/960x540' }}" class="card-img-top" alt="Post Image">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">{{$post->description}}</p>
                            <span class="card-bottom"><i class="fa fa-heart" aria-hidden="true"></i>{{$post->likes->count()}}</span>
                                @if($post->status == \App\Enums\PostStatus::PUBLISHED)
                                <span class="bg-white d-flex justify-content-center"> <i class="fa fa-align-left text-success" aria-hidden="true"></i>Published</span>
                                @else
                                <span class="bg-white d-flex justify-content-center"> <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>Unpublished</span>
                                @endif
                            <hr>
                            <div class="row d-flex justify-content-around">

                                <a href="/dashboard/posts/{{$post->id}}" class="btn btn-primary">View</a>
                                <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a> 
                                <form action="/posts/{{$post->id}}" method="POST">
                                <button class="btn btn-danger" type="submit">
                                        @method('DELETE') 
                                        @csrf
                                        Delete
                                    </button>
                                </form>
                            </div>
                            <hr>
                        </div>
                    </div>
                    </div>
                    @endforeach
                @else
                    <h3>No Posts to show</h3>
                @endunless
               
                @else
                    <script>window.location = "/login";</script>
                @endauth

</x-dashlayout>
