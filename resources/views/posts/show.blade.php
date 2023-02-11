<x-layout>
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
                                <div class="d-flex justify-content-center row">
                                    
                                    <a href="#" class="btn btn-primary text-center">Like(Not functional)</a>
                                    
                                </div>
                                <div class="d-flex justify-content-center row">
                                    <a href="{{url()->previous() }}" class="btn btn-white text-center">Return</a>
                                </div>
                            </div>
                        
                        </div>
                        </div>
                    </div>
                    @else
                    <div class="card"> 
                        <div class="card-header">No Content</div>
                        <div class="card-body"><h2 class="text-warning">Maybe something went wrong!</h2></div>
                        <div class="card-body"><a href="{{url()->previous()}}" class="btn btn-info">Go Back</a></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-layout>