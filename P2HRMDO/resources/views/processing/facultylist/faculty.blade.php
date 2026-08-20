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

</head>

<style>
.body{
	font-family: var(--app-font);
}

.navbar-header{
	background-color: #395583;
	position: fixed;
	top:0;
	width: 100%;
	height: 50px;
	z-index: 999;
}

.container-fluid{
	margin: 0%;
	height:40px;
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
.dashboardoptions{
	font-family: var(--app-font);
	font-size: 18px;
}

.nav-link img {
	border-radius: 50%;
	width: 36px;
	height: 36px;
	margin: -8px 0;
	float: right;
	margin-right: -5px;
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

.content {
	width: (100% - 250px);
	margin-top: 50px;
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

h1{
	font-family: var(--app-font);
	font-size: 23px;
	line-height: 10px;
}

h3 {
	font-family: var(--app-font);
	font-size: 15px;
	text-align: center;
	line-height: 20px;
}
.dropdowns {
	display: flex;
	justify-content: center;
	align-items: center;
	margin-top: 20px;
}

.dropdown {
	margin: 0 10px;
}

.grid-con-input-eval-sec{
	margin-left: 12.5px; 
	margin-right: 10px;
	margin-top: 25px;
	margin-bottom: 30px;
	border-radius: 10px;
	background-color: #F8F8F8;
	height: fit-content;
	width: 98%;
	padding: 20px;
}

.employee-container {
	display: flex;
	flex-wrap: wrap;
	gap: 20px;
	justify-content: space-between;
	max-width: 1200px;
	margin: 0 auto;
	padding: 20px;
}
.employee-card {
	border: 1px solid #ccc;
	padding: 10px;
	display: flex;
	flex-direction: column;
	align-items: center;
	width: calc(25% - 20px);
}
.employee-info {
	display: flex;
	flex-direction: column;
	align-items: center;
	margin-top: 10px;
}
.employee-image {
	width: 60px;
	height: 60px;
	border-radius: 50%;
	object-fit: cover;
}
.employee-name {
	margin-top: 10px;
	text-align: center;
}
.delete-icon {
	cursor: pointer;
	margin-top: 10px;
}
#add-form {
	margin-top: 20px;
	display: flex;
	flex-direction: column;
	align-items: center;
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

.circle-container {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid #ccc;
    margin-bottom: 10px;
	margin: 0 auto;
	margin-bottom: 20px;
}

.profile-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.employee-list {
    display: flex;
    flex-wrap: wrap;
    margin: -10px; /* Negative margin to counteract card margins */
}

.card-row {
    display: flex;
    flex-wrap: wrap;
    margin: 10px; /* Add margin to the row to separate from other content */
}

.employee-card {
    position: relative; /* Add relative positioning to the card */
    width: calc(25% - 20px);
    margin: 10px;
    box-sizing: border-box;
    text-align: center;
}

.card-header {
    position: absolute;
    top: 10px;
    right: 10px;
	background-color: transparent;
	border: none;
	padding: 0;
    display: inline-block;
}

.actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.edit-icon, .delete-icon {
    color: #395583;
    font-size: 18px;
    text-decoration: none;
    background-color: transparent;
    border: none;
    padding: 0;
    display: inline-block;
}

.delete-container {
    background-color: transparent;
    border: none;
    padding: 0;
    display: inline-block;
    margin-top: -10px; /* Adjust this value to vertically align the trash icon */
	margin-left: 10px;
}

.delete-icon:hover {
    color: #ff0000; /* Change color on hover */
    background-color: transparent;
    border: none;
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
				<span class="badge badge-danger" style="font-size: 15px; padding: 8px 10px; margin-right: 30px;">
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
	<a href="{{ route('processingdashboard.index') }}"><i class="fas fa-desktop"></i><span class="dashboardoptions">Dashboard</span></a>
	<a href="{{ route('forecastingdata.index') }}"><i class="fas fa-database"></i><span class="dashboardoptions">Manpower Forecast</span></a>
	<a href="{{ route('forecastingsystem.index') }}"><i class="fas fa-chart-bar"></i><span class="dashboardoptions">Forecasting Data</span></a>
	<a class="sidebar-active" href="{{ route('faculty.index') }}"><i class="fas fa-users sidebar-active"></i><span class="sidebar-active dashboardoptions">List of Faculty</span></a>
	<a href="{{ route('users.index') }}"><i class="fas fa-cogs"></i><span class="dashboardoptions">User Management</span></a>
</div>
<!--sidebar end-->

<style>
	.search-container, .lofsearch {
		font-family: var(--app-font);
		font-size: 18px;
		padding: 3px;
		width: 320px; /* Adjust the margin as needed */
		border-radius: 5px;
		border-width: 1px;
		align-items: center;
	}

	.lofsearch::placeholder{
		font-family: var(--app-font);
		font-size: 18px;
		padding-left: 3px;
		align-items: center;
	}

	.search-container .search-icon {
		position: absolute;
		margin-left: 20px;
		align-content: center;
		padding: 3px;

	}
	.loftitle{
		margin-top: -40px;
		margin-left: 20px;
		font-size: 35px; 
		font-weight: 700; 
		font-family: var(--app-font);
	}

	.dropdown-college-lof, .dropdown-dept-lof{
		width: 400px;
		font-family: var(--app-font);
		font-size: 20px;
		padding: 5px;
		border-radius: 5px;
		background-color: #ffffff;
		color: #070707;

	
	}

	.divdropdown {
		display: flex; /* Use flexbox */
		justify-content: space-between; /* Distribute elements evenly */
		align-items: center; /* Center elements vertically */
		width: 100%;
		margin-left: -5px;
		margin-bottom: 10px;
		margin-top: 10px;
	}

	/* Adjust the width of the second select element to fit within the available space */
	.divdropdown .dropdown:nth-child(1) {
		flex: 1;
		max-width: calc(70% - 3px); /* 50% width with a 5px gap on each side */
	}
	.divdropdown .dropdown:nth-child(2) {
		flex: 1;
		max-width: calc(70% - 3px); /* 50% width with a 5px gap on each side */
	}

	/* Adjust the width of the search container to occupy the rightmost space */
	.divdropdown .search-container {
		flex: 1;
		display: flex;
		justify-content: flex-end; /* Push it to the right */
		align-items: center;
		max-width: calc(30% - 3px);
		margin-right: 8px;
		margin-left: 3px; /* Add some margin to separate it from the other elements */
	}

	.lofaddfacbtn{
		margin-top: -50px;
		margin-right: -75px;
		font-family: var(--app-font);
		font-size: 17px;
		font-weight: 600;
		width: 320px;
		padding-left: 15px;
		padding-right: 15px;
		border-radius:5px;
		height: fit-content;
	}

	.lofcontainer{
		display: flex;
		justify-content: flex-end;

	}

	.lofheadertxt{
		font-family: var(--app-font);
		font-weight: 700;
		font-size: 18px;
	}

	.lofcontenttxt{
		font-family: var(--app-font);
		font-weight: 500;
		font-size: 18px;
	}
</style>
<div class="content">
	<div class="divdropdown">
		<div class="loftitle">
			List of Faculty
		</div>
		
	</div>
	<div class="container lofcontainer" >
		<a type="button" class="btn btn-adduser shadow-none lofaddfacbtn" href="{{ route('faculty.create') }}"><i class="fa fa-plus"></i> Add Faculty Member</a>
	</div>
	
	
	<div class="dropdowns divdropdown">
		<div class="dropdown">
			<select class="dropdown dropdown-college-lof" id="college" name="college" onchange="updateDepartments()" required>
				<option disabled selected value="" class="optiondisabled">Select College</option>
				@foreach ($collegeList as $college)
					<option value="{{ $college->college }}">{{ $college->college }}</option>
				@endforeach
			</select>

			<select class="dropdown dropdown-dept-lof"  id="department" name="department" onchange="updateEmployeeList()"> 
				<option disabled selected value="" class="optiondisabled">Select Department</option>  
			</select>
		</div>
		<div class="search-container">
			<input class="lofsearch" type="text" id="searchInput" placeholder="Search Filter" oninput="filterEmployeeList()">
			<i class="material-icons search-icon">search</i>
		</div>
	</div>
	<script>
		// Function to filter the employee list
		function filterEmployeeList() {
			const searchInput = document.getElementById('searchInput');
			const dataTable = document.getElementById('employee-table');
			const tableRows = dataTable.getElementsByTagName('tr');
		
			const searchText = searchInput.value.toLowerCase();
		
			for (let i = 0; i < tableRows.length; i++) {
				const row = tableRows[i];
				const rowData = row.getElementsByTagName('td');
				let isMatch = false;
		
				for (let j = 0; j < rowData.length; j++) {
					const cell = rowData[j];
					const cellText = cell.textContent.toLowerCase();
		
					if (cellText.includes(searchText)) {
						isMatch = true;
						break;
					}
				}
		
				row.style.display = isMatch ? '' : 'none';
			}
		}
	</script>
	<script>
		function updateDepartments() {
			var collegeDropdown = document.getElementById("college");
			var departmentDropdown = document.getElementById("department");
			var selectedCollege = collegeDropdown.value;

			// Clear existing options
			departmentDropdown.innerHTML = '<option disabled selected value="">Select</option>';

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

		function updateEmployeeList() {
			var collegeDropdown = document.getElementById("college");
			var departmentDropdown = document.getElementById("department");
			var selectedCollege = collegeDropdown.value;
			var selectedDepartment = departmentDropdown.value;

			// Clear list
			$("#employee-table").html("");

			$.ajax({
				type: 'GET',
				url: `/api/college/${selectedCollege}/department/${selectedDepartment}`,
				success: function(response) {
					console.log(response);
					const employees = response;
					let employeeRows = "";

					employees.map(employee => {
						const imageUrl = employee.image ? `/storage/images/${employee.image}` : '/images/profilepic.png';
						employeeRows += `
							<tr>
								<td class="text-center">
									<div class="circle-container">
										<img src="${imageUrl}" alt="Profile Image" class="profile-image">
									</div>
								</td>
								<td class="text-center lofcontenttxt">${employee.first_name} ${employee.last_name}</td>
								<td class="text-center lofcontenttxt">${employee.emp_no}</td>
								<td class="text-center lofcontenttxt">${employee.emp_type}</td>
								<td class="text-center lofcontenttxt">${employee.employment_status}</td>
								<td class="text-center lofcontenttxt">${employee.hired_at}</td>
								<td class="text-center lofcontenttxt">
									<a href="/processing/faculty/${employee.id}/edit" class="edit-icon"><i class="fas fa-edit"></i></a>
									<a href="/processing/faculty/${employee.id}/delete" onclick="return confirm('Are you sure you want to remove this faculty?');" class="delete-icon"><i class="fas fa-trash"></i></a>
								</td>
							</tr>	
						`;
					});

					// Populate list
					$("#employee-table").html(employeeRows);
				},
				error: function(err) {
					console.log(err);
				}
			});
		}
	</script> <!--END OF PAG CLICK COLLEGE DEPENDS YUNG LAMAN NG DEPARTMENT-->

	{{-- <!-- Delete Modal for Each Employee -->
	<div class="modal fade" id="confirm-delete{{ $emp->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modal-label"><b>Delete Faculty Member?</b></h4>
				</div>
				<div class="modal-body">
					<p style="font-size: 20px; margin-top: 10px;">Are you sure you want to delete this faculty member?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" id="formcancel-btn{{ $emp->id }}">Cancel</button>
					<button type="submit" class="btn btn-danger">Delete</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('.delete-icon').click(function(e) {
				e.preventDefault();
				var formId = $(this).closest('form').attr('id');
				$('#confirm-delete' + formId.substring(10)).modal({backdrop: 'static'});
			});
	
			$('[id^="formcancel-btn"]').click(function() {
				var modalId = $(this).attr('id');
				$('#confirm-delete' + modalId.substring(14)).modal('hide');
			});
		});
	</script> --}}
	<div class="grid-con-input-eval-sec shadow">
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="text-center lofheadertxt">Image</th>
					<th class="text-center lofheadertxt">Name</th>
					<th class="text-center lofheadertxt">Employee Number</th>
					<th class="text-center lofheadertxt">Position</th>
					<th class="text-center lofheadertxt">Employee Status</th>
					<th class="text-center lofheadertxt">Hiring Date</th>
					<th class="text-center lofheadertxt">Actions</th>
				</tr>
			</thead>
			<tbody id="employee-table">

			</tbody>
		</table>
	</div> <br>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>