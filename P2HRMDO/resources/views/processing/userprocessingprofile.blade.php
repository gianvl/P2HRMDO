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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<style>
.body{
	font-family: 'Times New Roman';
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

.dashboardoptions{
	font-family: 'Times New Roman';
	font-size: 18px;
}

.navbar-profile .dropdown-menu{
	position: absolute;
	top: 100%;
	right: auto;
	left: 30px;
	font-family: 'Times New Roman';
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
	font-family: 'Times New Roman';
	font-size: 16px;
}

.container-fluid{
	margin: 0%;
	height:40px;
}
.user-action:hover{
	color: #ffffff;
	font-family: 'Times New Roman';
	font-size: 16px;
}

.navbar-text{
	color: white;
	font-size: 15px;
	font-family: 'Times New Roman';
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
	width: 100px !important;
	height: 100px !important;
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

.sidebar i {
	padding-right: 10px;
}

.content {
	width: (100% - 250px);
	margin-bottom: 50px;
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

.circle-container {
	width: 150px;
	height: 150px;
	border-radius: 50%;
	overflow: hidden;
	display: flex;
	justify-content: center;
	align-items: center;
	border: 1px solid #ccc;
	margin-bottom: 10px;
}
#profile-image {
	width: 100%;
	height: 100%;
	object-fit: cover;
}

#profile-image1 {
	width: 100%;
	height: 100%;
	object-fit: cover;
}

h1{
font-family: 'Times New Roman';
font-size: 23px;
line-height: 10px;
}

h3 {
	font-family: 'Times New Roman';
	font-size: 15px;
	text-align: center;
	line-height: 20px;
}

.btn-updateuser{
	color: #ffffff;
	background-color: #395583;
	border-color: #395583;
	width: 10%;
}

.btn-updateuser:hover{
	background-color:#ffffff;
	border-color: #395583;
	color: #395583;
}

.required {
color: red;
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
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action" id="navname">{{ $loggedInUser->name }}<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" class="avatar" alt="Avatar" style="margin-left:10px;"> <b class="caret"></b></a>
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
					<i class="fa fa-bell"></i> <!-- Notification icon -->
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

<div class="sidebar">
	<div class="profile_info">
		<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" alt="Profile Image" class="profile_image" id="profile-image">
		<h1>{{ $loggedInUser->name }}<br></h1>
		<h3>{{ $loggedInUser->position }} of {{ $loggedInUser->department }}</h3>
	</div>
	<a href="{{ route('processingdashboard.index') }}"><i class="fas fa-desktop"></i><span class="dashboardoptions">Dashboard</span></a>
	<a href="{{ route('forecastingdata.index') }}"><i class="fas fa-database"></i><span class="dashboardoptions">Manpower Forecastt</span></a>
	<a href="{{ route('forecastingsystem.index') }}"><i class="fas fa-chart-bar"></i><span class="dashboardoptions">Forecasting Data</span></a>
	<a href="{{ route('faculty.index') }}"><i class="fas fa-users"></i><span class="dashboardoptions">List of Faculty</span></a>
	<a href="{{ route('users.index') }}"><i class="fas fa-cogs"></i><span class="dashboardoptions">User Management</span></a>
</div>
<!--sidebar end-->
<div class="content">
<div class="col-12 mt-5">
	<div>
		@if ($message = Session::get('success'))
			<div class="alert alert-success  alert-block text-center">
				<button type="button" class="close" data-dismiss="alert">×</button>	
					<strong>{{ $message }}</strong>
			</div>
		@endif
	</div>
	<div class="card">
		<div class="card-body">
			<h4 class="header-title" style="display: flex; flex-direction: column; align-items: center;">Edit User Profile</h4>
			<form action="{{ route('updateProcessingProfile', ['id' => $loggedInUser->id]) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div style="display: flex; flex-direction: column; align-items: center; margin-top: 10px;">
					<label for="image" class="upload-btn"> 
						<input type="file" id="image" name="image" style="display: none;">
						<div class="circle-container">
							@if($loggedInUser->image)
								<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" alt="Profile Image Saved" id="profile-image1">
								@else
									<img src="{{ asset('images/profilepic.png') }}" alt="Profile Image Default" id="profile-image1">
								@endif
						</div>
						Click to Change Picture
					</label>
				</div>

				<script>
					document.getElementById('image').addEventListener('change', function(event) {
						const selectedImage = event.target.files[0];
						const profileImage = document.getElementById('profile-image1');
					
						if (selectedImage) {
							profileImage.src = URL.createObjectURL(selectedImage);
							profileImage.style.display = 'block'; // Show the image
						} else {
							profileImage.style.display = 'none'; // Hide the image if no image is selected
						}
					});
				</script>
				<br>
				<div class="form-row">
					<div class="form-group col-md-4 col-sm-12">
						<label for="name">Name<span class="required">*</span></label>
						<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" readonly minlength="3" value="{{$loggedInUser->name}}">
						@error('name')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
						<small class="form-text text-muted">Please enter your full name.</small>
					</div>
					<div class="form-group col-md-4 col-sm-12">
						<label for="email">Email<span class="required">*</span></label>
						<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email" readonly value="{{$loggedInUser->email}}">
						@error('email')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
						<small class="form-text text-muted">Please enter a valid email address.</small>
					</div>
					<div class="form-group col-md-4 col-sm-12">
						<label for="username">Username<span class="required">*</span></label>
						<input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter Username" readonly minlength="3" value="{{$loggedInUser->username}}">
						@error('username')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
						<small class="form-text text-muted">Username must be at least 3 characters.</small>
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-4 col-sm-12">
						<label for="college">College<span class="required">*</span></label>
						<input type="text" class="form-control" id="college" name="college" readonly value="{{ $loggedInUser->college }}">
						<small class="form-text text-muted">Please select the user's college.</small>
					</div>
					<div class="form-group col-md-4 col-sm-12">
						<label for="department">Department<span class="required">*</span></label>
						<input type="text" class="form-control" id="department" name="department" readonly value="{{ $loggedInUser->department }}">
						<small class="form-text text-muted">Please select the user's department.</small>
					</div>
					<div class="form-group col-md-4 col-sm-12">
						<label for="position">Position<span class="required">*</span></label>
						<input type="text" class="form-control" id="position" name="position" readonly value="{{ $loggedInUser->position }}">
						<small class="form-text text-muted">Please select the user's position.</small>
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-6 col-sm-12">
						<label for="password">Password<span class="required">*</span></label>
						<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password" minlength="6">
						@error('password')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
						<small class="form-text text-muted">Password must be at least 6 characters.</small>
					</div>
					<div class="form-group col-md-6 col-sm-12">
						<label for="password_confirmation">Confirm Password<span class="required">*</span></label>
						<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
						@error('password_confirmation')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
						<small class="form-text text-muted">Please confirm your password.</small>
					</div>
				</div>

				<script>
					const togglePassword = document.querySelectorAll('.toggle-password');
					
					togglePassword.forEach(icon => {
						icon.addEventListener('click', function() {
						const input = this.closest('.input-group').querySelector('input');
						if (input.type === 'password') {
							input.type = 'text';
							this.classList.remove('fa-eye-slash');
							this.classList.add('fa-eye');
						} else {
							input.type = 'password';
							this.classList.remove('fa-eye');
							this.classList.add('fa-eye-slash');
						}
						});
					});
				</script> 

				<!-- <div class="form-row">
					<div class="form-group col-md-12 col-sm-12">
						<label for="roles">Roles<span class="required">*</span></label>
						<div class="row">
							
						</div>
					</div>
				</div> -->
				<div style="display: flex; flex-direction:column; height: 20px;  align-items: center; margin-top: 20px; margin-bottom: 20px;">
					<button type="submit" class="btn btn-updateuser" id="saveUserBtn" disabled>Save User</button>
				</div> 
			</form>

			<script>
				// Function to validate the form before submission
				function validateForm() {
					const passwordField = document.getElementById('password');
					const confirmPasswordField = document.getElementById('password_confirmation');
			
					// Check if the password and password confirmation match
					if (passwordField.value.trim() !== confirmPasswordField.value.trim()) {
						// Display a prompt or alert
						alert("Password and Confirm Password do not match. Changes will not be saved.");
						
						// Prevent the form submission
						return false;
					}
			
					// Continue with the form submission
					return true;
				}
			
				// Function to enable/disable the "Save User" button based on form inputs
				function toggleSaveButton() {
					const passwordField = document.getElementById('password');
					const confirmPasswordField = document.getElementById('password_confirmation');
					const imageField = document.getElementById('image');
					const saveUserBtn = document.getElementById('saveUserBtn');
			
					// Enable the button if all conditions are met
					saveUserBtn.disabled = !(
						(passwordField.value.trim() === confirmPasswordField.value.trim()) &&
						((passwordField.value.trim() && confirmPasswordField.value.trim()) || (imageField.files.length > 0))
					);
				}
			
				// Attach the function to the input events of password and image fields
				document.getElementById('password').addEventListener('input', toggleSaveButton);
				document.getElementById('password_confirmation').addEventListener('input', toggleSaveButton);
				document.getElementById('image').addEventListener('change', toggleSaveButton);
			</script>
		</div>
	</div>
</div>
</div>

<script>
function updateDepartments() {
	var collegeDropdown = document.getElementById("college");
	var departmentDropdown = document.getElementById("department");
	var selectedCollege = collegeDropdown.value;

	// Clear existing options
	departmentDropdown.innerHTML = '<option disabled selected value="">Select Department</option>';

	$.ajax({
		type: 'GET',
		url: `/api/college/${selectedCollege}/department`,
		success: function(response) {
			console.log(response);
			const departments = response;
			departments.map(department => {
				departmentDropdown.innerHTML += `<option value="${department.department}">${department.department}</option>`;
			});
		},
		error: function(err) {
			console.log(err);
		}
	});
}
</script>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

</body>
</html>