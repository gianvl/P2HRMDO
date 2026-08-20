<!doctype html>
<html lang="en">
  <head>
	<link rel="stylesheet" href="{{ asset('css/tokens.css') }}">
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{url('/images/ADULOGO.png')}}">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}"/>


  </head>
  <body>
    <section class="loginpage">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-60" style="padding-top: 4rem">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
                  <div class="login-adulogo">
                      <img class="adulogoimg" src="{{url('/images/adulogoblue.png')}}" alt="" style="margin-bottom: 25px">
                  </div>

                  <div class="card-body">
                      @if(Session::has('success'))
                      <div class="alert alert-success" role="alert">
                          {{Session::get('success')}}
                      </div>
                      @endif

                      @if(Session::has('error'))
                      <div class="alert alert-danger" role="alert">
                          {{Session::get('error')}}
                      </div>
                      @endif
                      <form action="" method="POST">
                          @csrf
                      <div class="mb-3">
                          <input type="email" name="email" class="form-control" id="email" placeholder="name@adamson.edu.ph" required>
                      </div>
                      <div class="mb-3">
                          <div class="d-grid">
                              <button class="btn btn-primary shadow-none">Send email</button>
                          </div>
                      </div>
                  </div>
                  <div>
                      <a href="{{route('login')}}">Go back to Login Page</a>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 
  </body>
</html>