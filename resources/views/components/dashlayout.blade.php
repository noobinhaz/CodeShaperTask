<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.11.1/dist/cdn.min.js"></script>
  </head>
  <body>
    <div class="container-fluid">
      <x-flash />
      <h1 class="text-center mb-3">Admin Dashboard</h1>
      <div class="row">
        <div class="col-md-2">
          <div class="list-group">
            <a href="/dashboard" class="list-group-item list-group-item-action"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a>
            <a href="/dashboard/posts" class="list-group-item list-group-item-action"><i class="fa fa-text-width" aria-hidden="true"></i>Posts</a>
            <a href="/dashboard/plans" class="list-group-item list-group-item-action"><i class="fa fa-step-forward" aria-hidden="true"></i>Plans</a>
            <a href="/" class="list-group-item list-group-item-action"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
            <a href="/logout" method="POST" class="list-group-item list-group-item-action">
                <form method="POST" class="nav-link text-danger" action="/logout">
                    @csrf
                    <button type="submit" class="btn btn-light btn-outline-light text-dark">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>Logout
                    </button>
                </form>
            </a>
          </div>
        </div>
        <div class="col-md-10">
        @auth
                <div class="card">
                    {{$slot}}
                </div>
        @else
            <script>window.location = "/login";</script>
        @endauth
	
	        </div>
	    </div>
	</body>
</html>

