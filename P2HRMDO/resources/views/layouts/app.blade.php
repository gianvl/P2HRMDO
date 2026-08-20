<!doctype html>
<html lang="en">
  <head>
	<link rel="stylesheet" href="{{ asset('css/tokens.css') }}">
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{url('/images/ADULOGO.png')}}">   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HRMDO Manpower Requisition and Forecasting System</title>
{{-- 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> --}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.2/xlsx.full.min.js"></script>


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('css/navbar.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/req_mainpage.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/req_mrform.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/req_mforecastform.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/req_inputevalpage.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/req_saveevalpage.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/req_searchevaldatareport.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/req_printevaldatareport.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/req_depevaldatareport.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/app_mainpage.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/userprofile.css') }}"/>
    
  </head>
  <body>
    @include('layouts.navbar')
 

    @yield('body')


    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    {{-- --}}

  </body>
</html>