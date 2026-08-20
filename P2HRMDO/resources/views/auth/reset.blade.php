<!doctype html>
<html lang="en">
  <head>
	<link rel="stylesheet" href="{{ asset('css/tokens.css') }}">
	<link rel="stylesheet" href="{{ asset('css/ui.css') }}">
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{url('/images/ADULOGO.png')}}">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>

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
                      <img class="adulogoimg" src="{{url('/images/adulogoblue.png')}}" alt="" style="margin-bottom: -10px">
                  </div> <br>
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
                          <input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="Enter new Password" required>
                      </div>
                      <div class="mb-3">
                          <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Confirm new Password" required>
                      </div>
                      <div class="mb-3">
                          <div class="d-grid">
                              <button class="btn btn-primary shadow-none">Reset Password</button>
                          </div>
                      </div>
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