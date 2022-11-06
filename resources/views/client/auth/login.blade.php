<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('client/auth/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('client/auth/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('client/auth/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('client/auth/css/style.css') }}">

    <title>{{$title}}</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{ asset('client/auth/images/bg_1.jpg') }}');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>Sign In</h3>
              @if (count($errors) > 0)
              @foreach ($errors->all() as $message)
                  <div class="alert alert-danger display-hide">
                      <button class="close" data-close="alert"></button>
                      <span>{{ $message }}</span>
                  </div>
              @endforeach
          @endif
            </div>
            <form action="{{ route('client.login') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group first">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email">
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password">
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">

              <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span>
              
              <div class="social-login">
                <a href="#" class="facebook btn d-flex justify-content-center align-items-center">
                  <span class="icon-facebook mr-3"></span> Login with Facebook
                </a>
                <a href="#" class="twitter btn d-flex justify-content-center align-items-center">
                  <span class="icon-twitter mr-3"></span> Login with  Twitter
                </a>
                <a href="#" class="google btn d-flex justify-content-center align-items-center">
                  <span class="icon-google mr-3"></span> Login with  Google
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="{{ asset('client/auth/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('client/auth/js/popper.min.js') }}"></script>
    <script src="{{ asset('client/auth/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('client/auth/js/main.js') }}"></script>
  </body>
</html>