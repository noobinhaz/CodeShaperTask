<x-dashlayout>
    @auth
<style>
  .golden-card {
    background-color: goldenrod;
    margin: 0 auto;
    opacity: 0.95;
    color:white;
    display: block;
  }

  .blue-card {
    background-color: blue;
    color: white;
    opacity: 0.7;
    margin: 0 auto;
    display: block;
  }
  .container {
    height: 50vh;
  }
  .checkLight {
    box-shadow: 10px 10px;
  }

</style>
<div class="container pt-5 mt-5 justify-content-between">
  <div class="row">
      <div class="col-md-6">
        

            <div class="card rounded-lg golden-card" style="width: 50%;">
              <div class="card-body text-center">
                  <h5 class="card-title">Premium</h5>
                  <p class="card-text">Plan your posts ahead of time!</p>
                  <p class="card-text text-white"><strong>$5.00/year</strong></p>
                  @if(auth()->user()->user_type == \App\Enums\UserType::PREMIUM) 
                   <i class="fa fa-check fa-2x text-success" aria-hidden="true"></i>
                   @else
                   <a href="/dashboard/changePlan" class="btn btn-success">Choose Plan</a>
                   @endif
          </div>
        </div>
        
    </div>
    <div class="col-md-6">
            <div class="card rounded-lg blue-card" style="width: 50%;">
              <div class="card-body text-center">
                <h5 class="card-title">Free</h5>
                <p class="card-text">Always on the go!</p>
                <p class="card-text text-white"><strong>$0.00/year</strong></p>
                @if(auth()->user()->user_type == \App\Enums\UserType::FREE)
                <i class="fa fa-check fa-2x text-success" aria-hidden="true"></i>
                @else
                <a href="/dashboard/changePlan" class="btn btn-success">Choose Plan</a>
                @endif
              </div>
            </div>
    </div>
  </div>
</div>
@else
<script>window.location = "/login";</script>
@endauth
</x-dashlayout>