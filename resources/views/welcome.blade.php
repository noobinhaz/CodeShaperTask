<x-layout>
<div class="container my-5">
  <div class="row">

  @unless(count($posts) == 0)
            @foreach ($posts as $post)
                
            <div class="col-lg-6 mb-3">
                <div class="card">
                  <img src="{{ $post->image ? asset($post->image) : 'https://via.placeholder.com/960x540' }}" class="card-img-top" alt="Post Image">
                  <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->description}}</p>
                    <p class="card-bottom"><i class="fa fa-heart" aria-hidden="true"></i>{{$post->likes->count()}}</p>
                    <a href="/posts/{{$post->id}}" class="btn btn-primary">Read More</a>
                  </div>
                </div>
              </div>
            @endforeach
        @else
            <h3>No Posts to show</h3>
        @endunless

        
      <div>
</div>
</x-layout>
