<x-dashlayout>
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => { show = false }, 5000)" x-show="show"
            class="fixed top-0 left-1/2 text-white px-5 py-3">
            <p>{{ session('message') }}</p>
        </div>
        {{ dd(session('message')) }}
    @endif
    @auth
    <div class="card">
        <div class="card-body">
            @if($post)
            <form action="/posts/{{$post->id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value={{$post->title}}>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" >{{$post->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <div class="col-md-6">

                        <img src="{{ $post->image ? asset($post->image) : 'https://via.placeholder.com/960x540' }}" class="card-img-top" alt="Post Image" width="150" height="200">
                    </div>
                </div>
                @if(auth()->user()->user_type == \App\Enums\UserType::PREMIUM) 
                <div class="form-group">
                    <label for="schedule">Schedule</label>
                    <input type="datetime-local" class="form-control" id="date" name="schedule" min="{{date('Y-m-d H:i')}}" value="{{!empty($post->schedule) ? date('Y-m-d H:i', strtotime($post->schedule)) : null}}">
                </div>
                @endif
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{url()->previous() }}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
    @else
        <div class="bg-danger">Nothing to show</div>
    @endif
    @else
        <script>window.location = "/login";</script>
    @endauth
</x-dashlayout>