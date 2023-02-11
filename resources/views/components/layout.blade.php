<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Code Shaper Problem</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.11.1/dist/cdn.min.js"></script>
  </head>

<body>
    <div class="container"> 
      <x-flash />
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
          <a class="navbar-brand" href="/">Medium Clone</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            Home
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="/"><i class="fa fa-home" aria-hidden="true"></i>Home <span class="sr-only">(current)</span></a>
              </li>
              @auth
              <li class="nav-item">
                  <a href="/dashboard" class="nav-link active"> <i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a>
              </li>
              <li class="nav-item">
                <form method="POST" class="nav-link text-danger" action="/logout">
                    @csrf
                    <button type="submit text-danger">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>Logout
                    </button>
                </form>
             </li>
            @else
                <li class="nav-item">
                    <a href="/register" class="nav-link active"><i class="fa fa-address-book" aria-hidden="true"></i>Register</a>
                </li>
                <li class="nav-item">
                    <a href="/login" class="nav-link active"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                </li>
            @endauth
            </ul>
          </div>
        </nav>
            <main>
                {{ $slot }}
            </main>
           
    </div>
</body>

</html>
