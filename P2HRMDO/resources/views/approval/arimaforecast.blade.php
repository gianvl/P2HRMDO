<!doctype html>
<html lang="en">

<head>
	<link rel="stylesheet" href="{{ asset('css/tokens.css') }}">
	<link rel="stylesheet" href="{{ asset('css/ui.css') }}">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="{{url('/images/ADULOGO.png')}}">  
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HRMDO Manpower Requisition and Forecasting System</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<style>
.body{
	font-family: var(--app-font);
}

.navbar-header{
	background-color: #395583;
	position: relative;
	top: 0;
	left: 0;
	width: 100%;
	height: 50px;
	/* z-index: 999; */
}

.adulogo{
	width: 150px;
	height: 150px;
	margin-top: -3px;
	margin-left: -15px;
}

.navbar-profile{
	margin-top: -110px;
}

.navbar-profile .dropdown-menu{
	position: absolute;
	top: 100%;
	right: auto;
	left: 30px;
	font-family: var(--app-font);
	z-index: 100;
}

.badge-container {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	margin-left: 32%;
	font-family: var(--app-font);
}

.user-action{
	color: #ffffff;
	font-family: var(--app-font);
	font-size: 16px;
}

.user-action:hover{
	color: #ffffff;
	font-family: var(--app-font);
	font-size: 16px;
}

.navbar-text{
	color: white;
	font-size: 15px;
	font-family: var(--app-font);
	position: absolute;
	top: 50%;
	position:fixed;
	transform: translate(-50%, -50%);
	top: 50%;
	left: 50%;
}

.nav-link img {
	border-radius: 50%;
	width: 36px;
	height: 36px;
	margin: -8px 0;
	float: right;
	margin-right: -5px;
}

.grid-con-input-eval-sec{
	display: grid; 
	grid-template-columns: 1fr; 
	margin-right: 10px;
	margin-top: 20px;
	margin-bottom: 30px;
	border-radius: 10px;
	background-color: #F8F8F8;
	height: fit-content;
	width: 100%;
	padding: 20px;
	font-family: var(--app-font);
}

.forecast-dropdown-container {
	display: grid; 
	grid-template-columns: 1fr 1fr 0.5fr; 
	font-weight: 500;
	white-space: nowrap;
}
.forecast-dropdown-container-left {
	display: flex;
	margin-top: 10px;
	gap: 30px;
	font-weight: 500;
}

.text-align-title, .forecast-dropdown-container{
	margin-top: 10px;
}

.dropdown-ay {
	width: 120px!important;
	height: fit-content
}

.dropdown-sem {
	height: fit-content
}

.dropdown-college{
	width: 531px!important;
	height: fit-content
}
.dropdown-department{
	width: 531px!important;
	height: fit-content
}

.forecastdata-grid-con-title {
	display: grid; 
	grid-template-columns: 1fr 1fr;
	width: 100%; 
	background-color: #395583;
	height: 50px;
	border-radius: 10px;
}

.forecastdata-text-title {
	color: #fff;
	font-weight: bold;
	font-size: x-large;
	margin-top: 7.5px;
	margin-left: 15px;
}

.lofaddfacbtn{
	margin-top: -5px;
	font-family: var(--app-font);
	font-size: 17px;
	font-weight: 600;
	width: 320px;
	padding-left: 15px;
	padding-right: 15px;
	border-radius:5px;
	height: fit-content;
}

.btn-adduser:hover{
	color: #395583;
	background-color: #ffffff;
	border-color: #395583;
		
}

.btn-adduser{
	background-color:#395583;
	border-color: #395583;
	color: #ffffff;
	width: 100%;
}
.grid-con-forecastdata-one{
	display: grid;
	grid-template-columns: 1fr 1fr;
	gap: 50px;
	padding: 50px;
	margin-top: 20px;
	margin-bottom: 30px;
	border-radius: 10px;
	background-color: #F8F8F8;
	height: fit-content;
	width: 100%;
}

.grid-con-forecastdata-two{

	padding: 50px;
	margin-bottom: 30px;
	border-radius: 10px;
	text-align: center;
	justify-content: center;
	background-color: #F8F8F8;
	height: fit-content;
	width: 100%;
}

.content {
	width: (100% - 250px);
	padding: 20px;
	margin-left: 20px;
	margin-right: 20px;
	background: url(background.png) no-repeat;
	background-position: center;
	background-size: cover;
	height: 100vh;
	transition: 0.5s;
	position: relative;
}

#check:checked~.content {
	margin-left: 60px;
}

#check:checked~.sidebar .profile_info {
	display: none;
}

#check {
	display: none;
}

.content .card p {
	background: #fff;
	padding: 15px;
	margin-bottom: 10px;
	font-size: 14px;
	opacity: 0.8;
}

.modal-backdrop {
	z-index: 1000;
}

.modalDelete{
	z-index: 9999;
}


h1{
	font-family: var(--app-font);
	font-size: 23px;
	line-height: 10px;
}

h5{
	font-family: var(--app-font);
	font-size: 25px;
	line-height: 40px;
}

h3 {
	font-family: var(--app-font);
	font-size: 15px;
	text-align: center;
	line-height: 20px;
}

h2{
	font-family: var(--app-font);
	font-size: 20px;
	line-height: 20px;
	text-align: justify;
}

.disabled-link {
	pointer-events: none; /* Disable clicking on the link */
	opacity: 0.5; /* Make the link appear disabled */
}

.container-fluid{
	margin: 0%;
	height:40px;
}

.dashboardoptions{
	font-family: var(--app-font);
	font-size: 18px;
}

.forecastdata-header{
	text-align: center;
	margin-top: 40px;
	margin-bottom: 30px;
}

.forecastdata-selectedaysem1{
	font-weight: bold;
	margin-bottom: 20px;
}

.forecastdata-selectedaysem2{
	font-weight: bold;
	line-height: 20px;
	color: rgb(197, 73, 98);
	/* color: rgb(248, 131, 14); */

	/* color:rgba(151, 205, 242, 1);
	color:rgba(252, 174, 190, 1);
	color:rgba(252, 204, 156, 1);

	color:#fed766;
	color:#6a994e;
	color:#e26d5c; */
}

.forecastdata-arimamodel{
	font-family: 'Segoe UI';
	font-size: 15px;
	text-align: justify;

}

/*GO BACK TO DASHBOARD*/
.grid-container-print-backtodashboard { 
    display: grid; 
    grid-template-columns: 1fr 1fr;
    width: 96%; 
    margin-left: 30px;
    margin-right: 30px;
    margin-top: 10px;
    border-radius: 10px;
}

.text-showmrform-backtodashboard {
    display: inline-block; /* Change display to inline-block */
    color: #395583;
    font-size: 15px;
    padding: 0 5px; /* Add padding to create a clickable area around the text */
    text-decoration: none; /* Remove underline by default */
	font-family: var(--app-font);
}

.text-showmrform-backtodashboard:hover {
    color: black;
    text-decoration: none;
}

.required {
	color: red;
}

</style>

<body>
<nav class="navbar navbar-header ">
	<div class="container-fluid" font-style="#395583">
		<div class="adulogo">
			<a href="{{ route('approvaldashboard.index') }}">
			<img src="{{url('/images/adulogowhite.png')}}" class="img-fluid">
			</a>
		</div>
		<ul class="navbar-nav navbar-profile">
			<div class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"> {{ $loggedInUser->name }}
                    <img src="{{ asset('storage/images/' . $loggedInUser->image) }}" onerror="this.onerror=null; this.src='{{ asset('images/profilepic.png') }}';" class="avatar" alt="Avatar" style="margin-left:10px; color:azure">
                </a>
				<div class="dropdown-menu">
                    @if ($loggedInUser->position == 'Chairperson' || $loggedInUser->position == 'Dean')
                        <a href="{{ route('requestingdashboard.index') }}" class="dropdown-item"><i class="fa fa-user-o"></i>Dashboard</a>
                    @elseif ($loggedInUser->position == 'VPA' || $loggedInUser->position == 'HRMDO director')
                        <a href="{{ route('approvaldashboard.index') }}" class="dropdown-item"><i class="fa fa-user-o"></i>Dashboard</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    @if ($loggedInUser->position == 'Chairperson' || $loggedInUser->position == 'Dean')
                        <a href="{{ route('profile.index') }}" class="dropdown-item"><i class="fa fa-user-o"></i>Profile</a>
                    @elseif ($loggedInUser->position == 'VPA' || $loggedInUser->position == 'HRMDO director')
                        <a href="{{ route('showApprovalProfile') }}" class="dropdown-item"><i class="fa fa-user-o"></i>Profile</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-logout dropdown-item"><i class="fa fa-user-o"></i>Logout</button>
                    </form>
                </div>
			</div>
			{{-- <div class="badge-container">
				<span class="badge badge-danger" style="font-size: 15px; padding: 8px 10px; margin-right: 5px;">
					<i class="fa fa-bell"></i>
					{{ \App\Models\Manpower::where('approval_status', "Waiting for Approval")->count() }}
				</span>
			</div> --}}
		</ul>
	</div>
</nav>

<div class="modal fade" id="confirm-logout" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modal-label"><b>Logout</b></h4>
			</div>
			<div class="modal-body">
				<p style="font-size: 20px; margin-top: 10px;">Are you sure you want to logout?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cancel-btn">Cancel</button>
				<button type="button" class="btn btn-danger" id="confirm-logout-btn">Logout</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.btn-logout').click(function(e) {
			e.preventDefault();
			$('#confirm-logout').modal('show');
		});

		$('#confirm-logout-btn').click(function() {
			$('#logout-form').submit();
		});

		$('#cancel-btn').click(function() {
			$('#confirm-logout').modal('hide');
		});
	});
</script>

<div class="grid-container-print-backtodashboard">
    <div class="grid-container" style="margin-top: 10px; margin-left: 5px;">
        <a class="text-showmrform-backtodashboard" id="back" href="{{route('approvaldashboard.index')}}">Go back to Dashboard</a>
    </div>
</div>


<div class="content">
	<div class="forecastdata-grid-container shadow">
		<div class="forecastdata-grid-con-title">
			<div class="forecastdata-text-title">
				Manpower Forecasting using ARIMA Model    
			</div>
		</div>
	</div>

	@include('partials.arima-forecast')

</body>
</html>