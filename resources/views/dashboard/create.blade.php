<x-dashlayout>
    @auth

    <!-- <x-flash /> -->
    <div class="card">
        <div class="card-body">

            <form action="/posts" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image" required>
                </div>
                @if(auth()->user()->user_type == \App\Enums\UserType::PREMIUM) 
                <div class="form-group">
                    <label for="schedule">Schedule</label>
                    <input type="datetime-local" class="form-control" id="date" name="schedule" min="{{date('Y-m-d H:i')}}" value="{{date('Y-m-d H:i')}}">
                </div>
                @endif
                <button type="submit" class="btn btn-primary">Create Post</button>
                <a href="/dashboard/posts" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
    @else
        <script>window.location = "/login";</script>
    @endauth
</x-dashlayout>