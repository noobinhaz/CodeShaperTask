@if (Session::has('message'))
    <div class="alert alert-success text-center alert-dismissible fade show" role="alert" id="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        document.getElementById("alert").onclick = function() {
        document.getElementById("alert").style.display = "none";}

    </script>
@endif



