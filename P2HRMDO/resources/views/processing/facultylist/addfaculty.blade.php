<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="{{url('/images/ADULOGO.png')}}">  
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HRMDO Manpower Requisition and Forecasting System</title>

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

.navbar-profile .dropdown-menu{
	position: absolute;
	top: 100%;
	right: auto;
	left: 0px;
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

.container-fluid{
	margin: 0%;
	height:40px;
}

.user-action{
	color: #ffffff;
	font-family: 'Times New Roman';
	font-size: 16px;
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
	margin-top: 50px;
	padding: 20px;
font-family: 'Times New Roman';

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
	margin-top: -30px;
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

.btn-saveuser{
	color: #ffffff;
	background-color: #395583;
	border-color: #395583;
	width: 15%;
	margin-top: 20px;
}

.btn-saveuser:hover{
	background-color:#ffffff;
	border-color: #395583;
	color: #395583;
}

.required {
	color: red;
}

h1{
	font-family: 'Times New Roman';
	font-size: 23px;
	line-height: 10px;
}

h3 {
	font-family: 'Times New Roman';
	font-size: 15px;
	line-height: 20px;
	text-align: center;

}

.dashboardoptions{
	font-family: 'Times New Roman';
	font-size: 18px;	
}	

.form-row{
	font-family: 'Times New Roman';
	font-weight: 500;
	font-size: 18px;

}

.form-control .inputtxtcolor{
	color: #395583
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
					<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">{{ $loggedInUser->name }}<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" onerror="this.onerror=null; this.src='{{ asset('images/profilepic.png') }}';" class="avatar" alt="Avatar" style="margin-left:10px;"> <b class="caret"></b></a>
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
			<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" onerror="this.onerror=null; this.src='{{ asset('images/profilepic.png') }}';" alt="Profile Image" class="profile_image" id="profile-image">
			<h1>{{ $loggedInUser->name }}<br></h1>
			<h3>{{ $loggedInUser->position }} of {{ $loggedInUser->department }}</h3>
		</div>
		<a href="{{ route('processingdashboard.index') }}"><i class="fas fa-desktop"></i><span class="dashboardoptions" >Dashboard</span></a>
		<a href="{{ route('forecastingdata.index') }}"><i class="fas fa-database"></i><span class="dashboardoptions" >Manpower Forecast</span></a>
		<a href="{{ route('forecastingsystem.index') }}"><i class="fas fa-chart-bar"></i><span class="dashboardoptions" >Forecasting Data</span></a>
		<a href="{{ route('faculty.index') }}"><i class="fas fa-users"></i><span class="dashboardoptions" >List of Faculty</span></a>
		<a href="{{ route('users.index') }}"><i class="fas fa-cogs"></i><span class="dashboardoptions" >User Management</span></a>
	</div>
	<!--sidebar end-->

	<div class="content">
		<!-- Page content wrapper-->
		<div id="page-content-wrapper" style="margin-top: -70px;">
			<!-- Page content-->
			<div class="main-content-inner">
				<div class="row">
					<!-- data table start -->
					<div class="col-12 mt-5">
						<div class="card">
							<div class="card-body">
								<h4 class="header-title" style="margin-bottom: 3%; display: flex; flex-direction: column; align-items: center; font-weight:700;">Add Faculty Member</h4>
								<form id="facultyForm" action="{{ route('faculty.store') }}" method="POST" enctype="multipart/form-data">
									@csrf
									@method('POST')
									<div style="display: flex; flex-direction: column; align-items: center; margin-top: 20px;">
										<label for="image" class="upload-btn">
											<input type="file" id="image" name="image" style="display: none;" class="form-control @error('image') is-invalid @enderror" required>
											<div class="circle-container" >
												<img src="{{url('/images/profilepic.png')}}" alt="Profile Image" id="profile-image1">
											</div>
											@error('image')
											<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted" style="text-align: center;">Upload Image</small>
										</label>
									</div>

									{{-- <!-- Warning message for image field -->
									<div id="imageWarning" class="alert alert-danger" style="display: none; text-align: center;">
										Please upload an image before submitting the form.
									</div> --}}

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
										<div class="form-group col-md-6 col-sm-12">
											<label for="first_name">First Name<span class="required">*</span></label>
											<input type="text" class="form-control inputtxtcolor validate-alphabetic @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" required minlength="3">
											@error('first_name')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">Please enter employee first name.</small>
										</div>
										<div class="form-group col-md-6 col-sm-12">
											<label for="last_name">Last Name<span class="required">*</span></label>
											<input type="last_name" class="form-control validate-alphabetic @error('last_name') is-invalid @enderror" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" required>
											@error('last_name')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">Please enter employee last name.</small>
										</div>
									</div>
									<div class="form-row">	
										<div class="form-group col-md-6 col-sm-12">
											<label for="prefix">Prefix<span class="required">*</span></label>
											<select class="form-control @error('prefix') is-invalid @enderror" id="prefix" name="prefix" required>
												<option value="">Select Prefix</option>
												<option value="Ms."{{ old('prefix') === 'Ms.' ? ' selected' : '' }}>Ms.</option>
												<option value="Mrs."{{ old('prefix') === 'Mrs.' ? ' selected' : '' }}>Mrs.</option>
												<option value="Mr."{{ old('prefix') === 'Mr.' ? ' selected' : '' }}>Mr.</option>
												<option value="Dr."{{ old('prefix') === 'Dr.' ? ' selected' : '' }}>Dr.</option>
											</select>
											@error('prefix')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">Please select employee prefix.</small>
										</div>
										<div class="form-group col-md-6 col-sm-12">
											<label for="email">Email<span class="required">*</span></label>
											<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter e-mail" value="{{ old('email') }}" required>
											@error('email')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">Please enter employee email.</small>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6 col-sm-12">
											<label for="emp_no">Employee Number<span class="required">*</span></label>
											<input type="number" class="form-control @error('emp_no') is-invalid @enderror" id="emp_no" name="emp_no" placeholder="Enter Employee Number" value="{{ old('emp_no') }}" required minlength="3">
											@error('emp_no')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">Please enter employee number.</small>
										</div>
										<div class="form-group col-md-6 col-sm-12">
											<label for="specialization">Specialization<span class="required">*</span></label>
											<input type="text" class="form-control @error('specialization') is-invalid @enderror" id="specialization" name="specialization" placeholder="Enter Specialization" value="{{ old('specialization') }}" required minlength="3">
											@error('specialization')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">Please enter employee specialization.</small>
										</div>

									</div>
									<div class="form-row">
										<div class="form-group col-md-6 col-sm-12">
											<label for="college">College<span class="required">*</span></label>
												<select class="form-control" id="college" name="college" onchange="updateDepartments()" required>
													<option disabled selected value="" class="optiondisabled">Select College</option>
													@foreach ($collegeList as $college)
														<option value="{{ $college->college }}">{{ $college->college }}</option>
													@endforeach
												</select>
											@error('college')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">Please select college.</small>
										</div>
										<div class="form-group col-md-6 col-sm-12">
											<label for="department">Department<span class="required">*</span></label>
											<select class="form-control" id="department" name="department"> 
												<option disabled selected value="" class="optiondisabled">Select Department</option>  
											</select>
											@error('department')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">Please select department.</small>
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
										</script> <!--END OF PAG CLICK COLLEGE DEPENDS YUNG LAMAN NG DEPARTMENT-->

									</div>
									<div class="form-row">
										<div class="form-group col-md-6 col-sm-12">
											<label for="emp_type">Employee Type<span class="required">*</span></label>
											<select class="form-control @error('emp_type') is-invalid @enderror" id="emp_type" name="emp_type" required>
												<option value="">Select Employment Status</option>
												<option value="Coordinator"{{ old('emp_type') === 'Coordinator' ? ' selected' : '' }}>Coordinator</option>
												<option value="VPA"{{ old('emp_type') === 'VPA' ? ' selected' : '' }}>VPA</option>
												<option value="HRMDO Director"{{ old('emp_type') === 'HRMDO Director' ? ' selected' : '' }}>HRMDO Director</option>
												<option value="Dean"{{ old('emp_type') === 'Dean' ? ' selected' : '' }}>Dean</option>
												<option value="Chairperson"{{ old('emp_type') === 'Chairperson' ? ' selected' : '' }}>Chairperson</option>
												<option value="Professor"{{ old('emp_type') === 'Professor' ? ' selected' : '' }}>Professor</option>
											</select>
											@error('emp_type')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">Please select employee type.</small>
										</div>
										<div class="form-group col-md-6 col-sm-12">
											<label for="employment_status">Employment Status<span class="required">*</span></label>
											<select class="form-control @error('employment_status') is-invalid @enderror" id="employment_status" name="employment_status" required>
												<option value="">Select Employment Status</option>
												<option value="Permanent Full-time"{{ old('employment_status') === 'Permanent Full-time' ? ' selected' : '' }}>Permanent Full-time</option>
												<option value="Permanent Part-time"{{ old('employment_status') === 'Permanent Part-time' ? ' selected' : '' }}>Permanent Part-time</option>
												<option value="Contractual Full-time"{{ old('employment_status') === 'Contractual Full-time' ? ' selected' : '' }}>Contractual Full-time</option>
												<option value="Contractual Part-time"{{ old('employment_status') === 'Contractual Part-time' ? ' selected' : '' }}>Contractual Part-time</option>
												<option value="Special Lecturer"{{ old('employment_status') === 'Special Lecturer' ? ' selected' : '' }}>Special Lecturer</option>
												<option value="Guest Lecturer"{{ old('employment_status') === 'Guest Lecturer' ? ' selected' : '' }}>Guest Lecturer</option>
											</select>
											@error('employment_status')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">Please select employment status.</small>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6 col-sm-12">
											<label for="hired_at">Hiring Date<span class="required">*</span></label>
											<input type="date" class="form-control @error('hired_at') is-invalid @enderror" id="hired_at" name="hired_at" placeholder="Enter Date Hired" value="{{ old('hired_at') }}" required>
											@error('hired_at')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">Please enter the date employee was hired.</small>
										</div>
										<div class="form-group col-md-6 col-sm-12">
											<label for="resigned_at">Resignation Date</label>
											<input type="date" class="form-control @error('resigned_at') is-invalid @enderror" id="resigned_at" name="resigned_at" placeholder="Enter Resignation Date" value="{{ old('resigned_at') }}">
											@error('resigned_at')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">Please enter employee resignation date.</small>
										</div>
									</div>

									<div style="display: flex; flex-direction: column; align-items: center;">
										<button type="submit" class="btn btn-saveuser" id="submitButton">Add Faculty Member</button>
									</div>
									
									{{-- SCRIPT FOR SHOWING A WARNING IF NO IMAGE IS UPLOADED --}}
									<script>
										
										document.getElementById('image').addEventListener('change', function(event) {
											const selectedImage = event.target.files[0];
											const profileImage = document.getElementById('profile-image1');

											if (selectedImage) {
												profileImage.src = URL.createObjectURL(selectedImage);
												profileImage.style.display = 'block'; // Show the image
												// document.getElementById('imageWarning').style.display = 'none'; // Hide the warning
											} else {
												profileImage.style.display = 'none'; // Hide the image if no image is selected
											}
										});

										document.getElementById('submitButton').addEventListener('click', function() {
											const selectedImage = document.getElementById('image').files[0];
											if (!selectedImage) {
												// document.getElementById('imageWarning').style.display = 'block'; // Show the warning
												// return;
											}
											// If an image is selected, submit the form
											document.getElementById('facultyForm').submit();
										});
										
									</script>																									
								</form>	
							</div>
						</div>
					</div>
				</div>
			</div>    
		</div>
		<br><br>		
	</div>

	<script>
		// Add a common class "validate-alphabetic" to all input fields that should have alphabetic validation
		const alphabeticInputs = document.querySelectorAll('.validate-alphabetic');

		function validateAlphabeticInput(event) {
			const inputValue = event.target.value;
			const regex = /^[a-zA-Z\s.]*$/; // Only allows alphabetic characters and spaces

			if (!regex.test(inputValue)) {
				event.target.value = ''; // Clear the field
				alert('Please enter only alphabetic characters and spaces.');
			}
		}

		// Add event listeners to all input fields with the "validate-alphabetic" class
		alphabeticInputs.forEach(input => {
			input.addEventListener('input', validateAlphabeticInput);
		});
	</script>


<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>