<x-dashlayout>

    <div>
        @auth()
        <div class="card-header">
                  Welcome to the Dashboard
        </div>
        <div class="card-body">
               {{ auth()->user()->name }} Welcome Back!
        </div>
        @if(!empty($posts_today))
        <div>
            You have created {{$posts_today}} posts today
        </div>
        @endif
        @else
            <script>window.location = "/login";</script>
        @endauth
    </div>
</x-dashlayout>