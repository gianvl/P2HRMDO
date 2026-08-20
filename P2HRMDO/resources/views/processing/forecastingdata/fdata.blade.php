<!doctype html>
<html lang="en">

<head>
	<link rel="stylesheet" href="{{ asset('css/tokens.css') }}">
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
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 50px;
	z-index: 999;
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
	margin-left: 34%;
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

.sidebar {
	z-index: 999;
	top: 0;
	background: #DDE6F5;
	margin-top: 50px;
	padding-top: 30px;
	position: fixed;
	left: 0;
	width: 250px;
	height: calc(100% - 5%);
	transition: 0.5s;
	transition-property: left;
	overflow-y: auto;
}

.profile_info {
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
}

.sidebar .profile_info .profile_image {
	width: 100px;
	height: 100px;
	border-radius: 100px;
	margin-bottom: 10px;
}

.sidebar .profile_info h4 {
	color: black;
	margin-top: -10px;
	margin-bottom: 20px;
}

.sidebar a {
	color: black;
	display: block;
	width: 100%;
	line-height: 60px;
	text-decoration: none;
	padding-left: 40px;
	box-sizing: border-box;
	transition: 0.5s;
	transition-property: background;
}

.sidebar a:hover {
	background: #395583;
}

.sidebar-active{
	background: #395583;
	color: #F8F8F8
}

.sidebar i {
	padding-right: 10px;
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
	gap: 10px;
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
	width: 465px!important;
	height: fit-content
}
.dropdown-department{
	width: 465px!important;
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
	font-family: var(--app-font);
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
	padding-top: 20px;
	margin-top: 20px;
	border-radius: 10px;
	background-color: #F8F8F8;
	height: fit-content;
	width: 100%;
}

.grid-con-forecastdata-two{
	padding: 50px;
	padding-top: 35px;
	margin-bottom: 30px;
	margin-top: 20px;
	border-radius: 0 0 10px 10px;
	text-align: center;
	justify-content: center;
	background-color: #F8F8F8;
	height: fit-content;
	width: 100%;
	box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.2);
}

.content {
	width: (100% - 250px);
	margin-top: 30px;
	padding: 20px;
	margin-left: 250px;
	background: url(background.png) no-repeat;
	background-position: center;
	background-size: cover;
	height: 100vh;
	transition: 0.5s;
	position: relative;
	padding-top: 50px; /* same height as the navbar */
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

.required {
	color: red;
}

.grid-container-print-backtodashboard { 
    display: grid; 
    grid-template-columns: 1fr;
    width: 99.5%; 
    margin-bottom: 10px;
    border-radius: 10px;
	font-family: var(--app-font);
}

.mrform-print {
    display: flex;
    align-items: center; /* Align items horizontally */
    float: right;
}

.mrform-print:hover{
    text-decoration: none;
}

.mrform-print i {
    margin-right: 5px; /* Adjust the spacing between the icon and text */
}


</style>

<body>
<nav class="navbar navbar-header ">
	<div class="container-fluid" font-style="#395583">
		<div class="adulogo">
			<a href="{{ route('processingdashboard.index') }}">
				<img src="{{url('/images/adulogowhite.png')}}" class="img-fluid">
			</a>
		</div>
		<ul class="navbar-nav navbar-profile">
			<div class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action" id="navname">{{ $loggedInUser->name }}<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" onerror="this.onerror=null; this.src='{{ asset('images/profilepic.png') }}';" class="avatar" alt="Avatar" style="margin-left:10px;"> <b class="caret"></b></a>
				<div class="dropdown-menu">
					<a href="{{ route('showProcessingProfile') }}" class="dropdown-item"><i class="fa fa-user-o"></i>Profile</a>
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
					{{ \App\Models\ManpowerProcessing::where('approval_status', "Pending")->count() }}
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

<div class="sidebar" id="sidebar">
	<div class="profile_info">
		<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" onerror="this.onerror=null; this.src='{{ asset('images/profilepic.png') }}';" alt="Profile Image" class="profile_image" id="profile-image">
		<h1>{{ $loggedInUser->name }}<br></h1>
		<h3>{{ $loggedInUser->position }} of {{ $loggedInUser->department }}</h3>
	</div>
	<a href="{{ route('processingdashboard.index') }}"><i class="fas fa-desktop"></i><span class="dashboardoptions">Dashboard</span></a>
	<a class="sidebar-active" href="{{ route('forecastingdata.index') }}"><i class="fas fa-database sidebar-active"></i><span class="sidebar-active dashboardoptions">Manpower Forecast</span></a>
	<a href="{{ route('forecastingsystem.index') }}"><i class="fas fa-chart-bar"></i><span class="dashboardoptions">Forecasting Data</span></a>
	<a href="{{ route('faculty.index') }}"><i class="fas fa-users"></i><span class="dashboardoptions">List of Faculty</span></a>
	<a href="{{ route('users.index') }}"><i class="fas fa-cogs"></i><span class="dashboardoptions">User Management</span></a>
</div>
<!--sidebar end-->

<style>
    @media print {
        .navbar{
            display:block !important;
        }
		#printButton,
		#navname,
		#sidebar{
			display:none;
		}
        @page {
            size: auto; /* Set the default print orientation to 'auto' */
        }
    }
	</style>
		<div class="content">
			<div class="grid-container-print-backtodashboard">
				<div class="grd-container" style="margin-bottom: 10px;">
					<a href="#" id="printButton" class="mrform-print">
						<i class="material-icons">print</i> Print Document
					</a>
				</div>
				<script>
				document.getElementById('printButton').addEventListener('click', function(event) {
				event.preventDefault(); // prevent the default link behavior
				window.print(); // trigger the browser's print function
     });
    </script>

	<div class="forecastdata-grid-container shadow">
		<div class="forecastdata-grid-con-title">
			<div class="forecastdata-text-title">
				Manpower Forecasting   
			</div>
		</div>
	</div>

	@include('partials.arima-forecast')

</body>
</html>