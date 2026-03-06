<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{url('/images/ADULOGO.png')}}">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HRMDO Manpower Requisition and Forecasting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

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
                      <form action="{{route('login')}}" method="POST">
                          @csrf
                      <div class="mb-3">
                          <input type="username" name="username" class="form-control" id="username" placeholder="Username" required>
                      </div>
                      <div class="password-container">
                          <input type="password" name="password" class="form-control" id="passwordeyes" placeholder="Password" required>
                          <button type="button" id="togglePassword" class="far fa-eye"></button>
                      </div>
                      <div class="mb-3">
                          <div class="d-grid">
                              <button class="btn btn-primary shadow-none">Login</button>
                          </div>
                      </div>
                  </div>
                  <div>
                      <a href="{{ route('PostForgotPassword') }}">Forgot Password?</a>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script>
      // const passwordField = document.getElementById('password');
      // const togglePassword = document.getElementById('togglePassword');

      // togglePassword.addEventListener('click', () => {
      //   if (passwordField.type === 'password') {
      //     passwordField.type = 'text';
      //     togglePassword.classList.remove('bi-eye-slash');
      //     togglePassword.classList.add('bi-eye');
      //   } else {
      //     passwordField.type = 'password';
      //     togglePassword.classList.remove('bi-eye');
      //     togglePassword.classList.add('bi-eye-slash');
      //   }
      // });

      const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#passwordeyes');

      togglePassword.addEventListener('click', function () {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // toggle the eye icon
        this.classList.toggle('fa-eye-slash', type === 'password');
      });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>