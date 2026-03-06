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
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
	left: 30px;
	font-family:'Times New Roman';
	z-index: 100;
}

.navbar-text{
	color: white;
	font-size: 15px;
	font-family:'Times New Roman';
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

.user-action:hover{
	color: #ffffff;
	font-family: 'Times New Roman';
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

.card-footer {
	width: 100%;
	border-top: 1px solid rgba(0, 0, 0, 0.1) !important;
	display: flex;
	justify-content: center;
	align-items: center;
}

.display-5 {
	border-radius: 10px;
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

.grid-con-btn-searchfilter {
	display: flex;
	justify-content: space-between;
	align-items: center;
}

.search-container {
	display: flex;
	align-items: center;
	margin-bottom: 1%
}

.dashboardoptions{
	font-family: 'Times New Roman';
	font-size: 18px;
}

.search-container .search-icon {
	margin-left: 12%;
    cursor: pointer;
    position: absolute;
}

.table-processing , .table-processing td, .table-processing th {
	border: 1px solid #595959;
	border-collapse: collapse;
}

input[type="radio"].btn-check:checked + label.custom-btn {
	background-color: #395583;
	border-color: #395583;
	color: #ffffff;
}

label.custom-btn.btn.btn-outline-primary {
	background-color: white;
	color: #395583;
	border: 1px solid #395583;
	padding: 8px 16px;
	font-size: 14px;
}

label.custom-btn.btn.btn-outline-primary:hover {
	border-color: #395583;
	color: #395583;
}

label.custom-btn.btn.btn-outline-primary:active, label.custom-btn.btn.btn-outline-primary:checked {
	background-color: #395583;
	border-color: #395583;
	color: #ffffff;
}

.table-processing{
	border: 1px solid #595959;
	border-collapse: collapse;
	text-align: center;
	width: 100%;
	margin-top: 10px;
	margin-bottom: 20px;
}

.table-processing td, .table-processing th {
	padding: 5px;
	width: 30px;
	height: 25px;
}

td.table-processing-header-title{
	background-color: #E4EBF7;
	font-weight: 550;
	font-family: 'Times New Roman';
	font-size: 18PX;
}

.container-fluid{
	margin: 0%;
	height:40px;
}

.status-red {
    background-color: #EECCCA !important;
    color: black;
}

.status-green {
    background-color: #C9DBBA !important;
    color: black;
}

.status-yellow {
    background-color: #f1e6c1 !important;
    color: black;
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
						{{ \App\Models\ManpowerProcessing::where('approval_status', "Processing")->count() }}
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
		<a class="sidebar-active" href="{{ route('processingdashboard.index') }}"><i class="fas fa-desktop sidebar-active"></i><span class="sidebar-active dashboardoptions">Dashboard</span></a>
		<a href="{{ route('forecastingdata.index') }}"><i class="fas fa-database"></i><span class="dashboardoptions">Manpower Forecast</span></a>
		<a href="{{ route('forecastingsystem.index') }}"><i class="fas fa-chart-bar"></i><span class="dashboardoptions">Forecasting Data</span></a>
		<a href="{{ route('faculty.index') }}"><i class="fas fa-users"></i><span class="dashboardoptions">List of Faculty</span></a>
		<a href="{{ route('users.index') }}"><i class="fas fa-cogs"></i><span class="dashboardoptions" >User Management</span></a>
	</div>
	<!--sidebar end-->

	<style>
		.indexanalytics{
			margin-left: 15px; 
			font-size:15px; 
			color:black
		}

		.indexmrtext{
			color:black ; 
			font-size:18px;
		}

		.indexanalyticsstatus{
			color: black;
			font-family: 'Times New Roman';
			font-size: 25px;
		}

		.procbtns{
			border-radius: 4px 0 0 4px; 
			font-size: 18px!important;
			font-weight: 500;
			font-family: 'Times New Roman';

		}

		.grid-con-input-eval-sec{
			display: flex;
			align-content: center;
			justify-content: space-between;
			margin-right: 10px;
			margin-top: -20px;
			margin-bottom: 30px;
			border-radius: 10px;
			background-color: #F8F8F8;
			height: fit-content;
			width: 100%;
			padding: 10px;
			font-family: 'Times New Roman';
		}
		.processing-dropdown-container {
			display: flex;
    		align-items: center;
			justify-content: flex-end;
			gap: 15px;
			font-weight: 500;
			white-space: nowrap;
			font-family: 'Times New Roman';
			font-size: 18px;
			font-weight: 300;
			align-content: center;
			margin-top:5px;
			
		}

		.indexsetbtn{
			margin-top: -5px;
			font-family: 'Times New Roman';
			font-size: 17px;
			font-weight: 600;
			width: auto;
			padding-left: 15px;
			padding-right: 15px;
			border-radius:5px;
			height: fit-content;
			margin-left: auto;
		}

		.btn-setaysem:hover{
		color: #395583;
		background-color: #ffffff;
		border-color: #395583;
			
		}

		.processing-dropdown-container label, .processing-dropdown-container select {
			margin-right: 10px;
		}

		.dropdown-sem {
			width: 150px!important;
			height: 30px;
			border-color: #315EA0;
			text-align: center;
		}

		.btn-setaysem{
			background-color:#395583;
			border-color: #395583;
			color: #ffffff;
			width: 100px;
			/*max-width: 80px;  Set the maximum width of the button to 80px */
   			text-align: center;
		}

		h2{
			font-weight:700;
			font-size: 20px;
			align-content: center;
			margin-top: 5px;
		}

		.custom-pagination {
			text-align: center; /* Center the entire pagination */
			padding-bottom: 50px;
		}

		.pagination-list {
			list-style: none;
			display: flex;
			justify-content: center;
			align-items: center;
			margin: 0;
			padding: 0;
		}

		.pagination-item {
			margin-right: 10px;
		}

		.pagination-item:last-child {
			margin-right: 0;
		}

		.disabled-link {
			pointer-events: none; /* Disable clicking on the link */
			opacity: 0.5; /* Make the link appear disabled */
		}

		.grid-con-input-eval-sec1{
			margin-left: 10px; 
			margin-right: 10px;
			margin-top: 10px;
			margin-bottom: 30px;
			border-radius: 10px;
			background-color: #F8F8F8;
			height: fit-content;
			width: 99%;
			padding: 20px;
			display: flex;
		}
	</style>
	

	<div class="content">
		<!-- Icon Cards-->
		<div class="row" style="margin-top: -20px; padding-bottom: 10px;">
			<div class="col-xl-4 col-sm-6 mb-3">
				<div class="card text-white o-hidden h-100" style="background-color: #ffcece;">
					<div class="card-body d-flex flex-column align-items-center">
						<div class="card-body-icon indexmrtext" >
							<i class="fa fa-fw fa-envelope "></i> Manpower Requisition 
						</div>
						<div class="mr-3 indexanalytics">Unread</div>
						<div class="card-footer text-white clearfix small z-1">
							<span class="text-center display-5 indexanalyticsstatus" >{{ $newRequestsCount }}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-sm-6 mb-3" >
				<div class="card text-white bg-warning o-hidden h-100" style="background-color: #ffe4c4!important;">
					<div class="card-body d-flex flex-column align-items-center">
						<div class="card-body-icon indexmrtext">
							<i class="fa fa-fw fa-clock "></i> Manpower Requisition 
						</div>
						<div class="mr-3 indexanalytics">Processing</div>
						<div class="card-footer text-white clearfix small z-1">
							<span class="text-center display-5 indexanalyticsstatus">{{ $processingCount }}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-sm-6 mb-3" >
				<div class="card text-white bg-success o-hidden h-100" style="background-color: #d0eec2f1!important">
					<div class="card-body d-flex flex-column align-items-center">
						<div class="card-body-icon indexmrtext">
							<i class="fa fa-fw fa-check-circle"></i>  Manpower Requisition 
						</div>
							<div class="mr-3 indexanalytics">Completed</div>
						<div class="card-footer text-white clearfix small z-1">
							<span class="text-center display-5 indexanalyticsstatus">{{ $completedCount }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<div class="grid-con-btn-searchfilter">
			<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
				<input onclick="showTable('ProMRTable')" type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
				<label class="btn btn-outline-primary custom-btn procbtns" for="btnradio1">Manpower Requisition History</label>
			
				<input onclick="showTable('ProForecastTable')"type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
				<label class="btn btn-outline-primary custom-btn procbtns" for="btnradio2">Manpower Forecast History</label>
			</div>

			<style>
				.procindexsearch{
					width: 350px;
					font-family: 'Times New Roman';
					font-size: 18px;
				}
				.procindexsearch::placeholder{
					font-family: 'Times New Roman';
				}
			</style>

			<div class="search-container" style="font-size: 18px; ">
				<input type="text" class="procindexsearch" id="searchInput" placeholder="Search ">
				<i class="material-icons search-icon" style="margin-left: 24%" >search</i>
			</div>
		</div>

		<div class="grid-con-input-eval-sec1 shadow">
			<table class="table-processing table-hover" id="ProMRTable">
				<tbody>
					<tr>
						<td class="table-processing-header-title" style="width:8%">MR Form No.</td>
						<td class="table-processing-header-title" style="width:12%">College</td>
						<td class="table-processing-header-title" style="width:12%">Department</td>
						<td class="table-processing-header-title" style="width:12%">Semester</td>
						<td class="table-processing-header-title" style="width:12%">Academic Year</td>
						<td class="table-processing-header-title" style="width:10%">Date Received</td>
						<td class="table-processing-header-title" style="width:10%">Status</td>
						<td class="table-processing-header-title" style="width:3%">Action</td>
					</tr>

					@php
						$perPage = 100;
						$currentPage = request()->input('page', 1);
						$startIndex = ($currentPage - 1) * $perPage;
						$paginatedForms = $processingForms->slice($startIndex, $perPage);
						$totalForms = $processingForms->count();
						$totalPages = ceil($totalForms / $perPage);
					@endphp
					
			@if($processingForms->count() > 0)
				@foreach ($paginatedForms as $form)
					<tr>
						<td>{{ $form->mrNum }}</td>
						<td>{{ $form->college }}</td>
						<td>{{ $form->department }}</td>
						<td>{{ $form->semester }}</td>
						<td>{{ $form->ay }}</td>
						<td>{{ $form->datereceived}}</td>
						<td class="@if ($form->approval_status == 'Processing') status-yellow @elseif ($form->approval_status == 'Unread') status-red @else status-green @endif">
							{{ $form->approval_status }}
						</td>
						<td>
							@if ($form->approval_status == 'Processing' || $form->approval_status == 'Unread')
								<a href="{{ route('processingdashboard.show', $form) }}" class="btn btn-outline-primary shadow-none">View</a>
							@elseif ($form->approval_status == 'Completed')
								<a href="{{ route('processingdashboard.show2', $form) }}" class="btn btn-outline-primary shadow-none">View</a>
							@endif		
						</td>
					</tr>
				@endforeach
				@else
					<tr>
						<td colspan="7" class="text-center">No data found.</td>
					</tr>
				@endif
				</tbody>
			</table>

			<table class="table-processing table-hover" id="ProForecastTable" style="display: none;">
				<tbody>
					<tr>
						<td class="table-processing-header-title" style="width:8%">Forecast No.</td>
						<td class="table-processing-header-title" style="width:12%">College</td>
						<td class="table-processing-header-title" style="width:12%">Department</td>
						<td class="table-processing-header-title" style="width:12%">Semester</td>
						<td class="table-processing-header-title" style="width:12%">Academic Year</td>
						<td class="table-processing-header-title" style="width:10%">Date Received</td>
						<td class="table-processing-header-title" style="width:8%">Status</td>
						<td class="table-processing-header-title" style="width:1%">Action</td>
					</tr>
					@if(isset($forecastSection1) && $forecastSection1->count() > 0)
					@foreach($forecastSection1 as $fS1)
						<tr>
							<td class="align-middle">{{ $fS1->forecast_num_id }}</a></td>
							<td class="align-middle">{{ $fS1->college }}</td>
							<td class="align-middle">{{ $fS1->department }}</td>
							<td class="align-middle">{{ $fS1->semester }}</td>
							<td class="align-middle">{{ $fS1->ay }}</td>
							<td class="align-middle">{{ $fS1->created_at->format('Y-m-d') }}</td>
							<td class="status-green">
								{{ $fS1->approval_status }}
							</td>
							<td class="align-middle">
								<a href="{{ route('processingdashboard.showForecastForm', $fS1) }}" class="btn btn-outline-primary shadow-none">View</a>
							</td>
						</tr>
					@endforeach
					@else
						<tr>
							<td colspan="7" class="text-center">No data found.</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>

		<div class="custom-pagination">
			<ul class="pagination-list">
				<li class="pagination-item{{ $currentPage == 1 ? ' disabled' : '' }}">
					<a href="{{ $currentPage == 1 ? '#' : '?page=' . ($currentPage - 1) }}" class="pagination-link{{ $currentPage == 1 ? ' disabled-link' : '' }}"{{ $currentPage == 1 ? ' aria-disabled="true"' : '' }}>&laquo; Previous</a>
				</li>
				@for ($i = 1; $i <= $totalPages; $i++)
					<li class="pagination-item{{ $i == $currentPage ? ' active' : '' }}">
						<a href="{{ '?page=' . $i }}" class="pagination-link{{ $i == $currentPage ? ' disabled-link' : '' }}">{{ $i }}</a>
					</li>
				@endfor
				<li class="pagination-item{{ $currentPage == $totalPages ? ' disabled' : '' }}">
					<a href="{{ $currentPage == $totalPages ? '#' : '?page=' . ($currentPage + 1) }}" class="pagination-link{{ $currentPage == $totalPages ? ' disabled-link' : '' }}"{{ $currentPage == $totalPages ? ' aria-disabled="true"' : '' }}>Next &raquo;</a>
				</li>
			</ul>
		</div>

		<script>
			const searchInput = document.getElementById('searchInput');
			const mrFormTable = document.getElementById('ProMRTable');
			const forecastFormTable = document.getElementById('ProForecastTable');
			const mrFormRows = mrFormTable.getElementsByTagName('tr');
			const forecastFormRows = forecastFormTable.getElementsByTagName('tr');
			
			searchInput.addEventListener('input', function() {
				const searchText = searchInput.value.toLowerCase();
			
				for (let i = 1; i < mrFormRows.length; i++) {
				const row = mrFormRows[i];
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
			
				for (let i = 1; i < forecastFormRows.length; i++) {
				const row = forecastFormRows[i];
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
			});
			
			function showTable(tableName) {
				if (tableName === 'ProMRTable') {
				mrFormTable.style.display = 'table';
				forecastFormTable.style.display = 'none';
				} else {
				mrFormTable.style.display = 'none';
				forecastFormTable.style.display = 'table';
				}
			}
		</script>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>