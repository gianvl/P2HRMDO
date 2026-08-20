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
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
		font-family: 'Times New Roman';
		z-index: 100;
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

    .forecastdata-grid-con-title {
        display: grid; 
        grid-template-columns: 1fr 1fr;
        width: 100%; 
        background-color: #395583;
        height: 50px;
        border-radius: 10px;
		font-family: 'Times New Roman';
		
    }

    .forecastdata-text-title {
        color: #fff;
        font-weight: bold;
        font-size: x-large;
        margin-top: 7.5px;
        margin-left: 15px;
		font-family: 'Times New Roman';

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
		font-family: 'Times New Roman';
	}

	.content {
		width: (100% - 250px);
		margin-top: 30px;
		padding: 20px;
		margin-left: 250px;
		font-family: 'Times New Roman';
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

    .container-fluid{
		margin: 0%;
		height:40px;
	}

	.modal-backdrop {
    	z-index: 1000;
	}

	.modalDelete{
		z-index: 9999;
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

	.disabled-link {
		pointer-events: none; /* Disable clicking on the link */
		opacity: 0.5; /* Make the link appear disabled */
	}

    .grid-con-search-eval-results{
        display: grid; 
        grid-template-columns: 0.5fr 1fr; 
        border: 2px #395583;
        grid-gap: 20px; 
        width: 96%; 
        margin-left: 20px;
        margin-right: 20px;
        margin-top: 25px;
        position: relative;
    }

    .text-align-title{
        font-size: 24px;
        font-weight: bold;
        margin-left: -5px;
        color: #395583;
    }

	.dashboardoptions{
		font-family: 'Times New Roman';
		font-size: 18px;
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
        width: 467px!important;
        height: fit-content
    }
    .dropdown-department{
        width: 467px!important;
        height: fit-content
    }

	.lofaddfacbtn{
		margin-top: -5px;
		font-family: 'Times New Roman';
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

	.required {
		color: red;
	}

	.grid-container-print-backtodashboard { 
		display: grid; 
		grid-template-columns: 1fr;
		width: 99.5%; 
		border-radius: 10px;
		margin-bottom: 10px;
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

		<div class="sidebar" id="sidebar">
			<div class="profile_info">
				<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" onerror="this.onerror=null; this.src='{{ asset('images/profilepic.png') }}';" alt="Profile Image" class="profile_image" id="profile-image">
				<h1>{{ $loggedInUser->name }}<br></h1>
				<h3>{{ $loggedInUser->position }} of {{ $loggedInUser->department }}</h3>
			</div>
			<a href="{{ route('processingdashboard.index') }}"><i class="fas fa-desktop"></i><span class="dashboardoptions">Dashboard</span></a>
			<a href="{{ route('forecastingdata.index') }}"><i class="fas fa-database"></i><span class="dashboardoptions">Manpower Forecast</span></a>
			<a class="sidebar-active" href="{{ route('forecastingsystem.index') }}"><i class="fas fa-chart-bar sidebar-active"></i><span class="sidebar-active dashboardoptions">Forecasting Data</span></a>
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
				<div class="grd-container">
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
			</div>

            <div class="forecastdata-grid-container shadow">
                <div class="forecastdata-grid-con-title">
                    <div class="forecastdata-text-title">
                        Forecasting Data   
                    </div>
                </div>
            </div> 

            <div class="grid-con-input-eval-sec shadow">
                <div class="forecast-dropdown-container-left">
                    <label for="college" style="margin-top: 2px ;">College: <span class="required">*</span></label>
                        <select class="dropdown-college" id="college" name="college" onchange="updateDepartments()" required style="width: 170px; height: 30px; border-color: #315EA0;">
                            <option disabled selected value="" class="optiondisabled">Select College</option>
							@foreach ($collegeList as $college)
							<option value="{{ $college->college }}">{{ $college->college }}</option>
							@endforeach
                        </select>
                        <label for="department" style="margin-top: 2px; margin-left: 10%;">Department: <span class="required">*</span></label>
                        <select class="dropdown-department" id="department" name="department" style="width: 170px; height: 30px; border-color: #315EA0;">
                            <option disabled selected value="" class="optiondisabled">Select Department</option>  
                        </select>
                </div>
				
                <div class="forecast-dropdown-container">
					<div>
						<label for="ay" style="margin-top: 2px">Academic Year: <span class="required">*</span></label>
						<select id="ay" name="ay" style="width: 175px; height: 30px; border-color: #315EA0;" required>
							<option disabled selected value="" class="optiondisabled">Select</option>
						</select>
					</div>
					<div>
						<label for="sem" style="margin-top: 2px; margin-left: -200px;">Semester: <span class="required">*</span></label>
						<select class="dropdown-sem" id="sem" name="sem" style="width: 165px; height: 30px; border-color: #315EA0;">
							<option value="" disabled selected>Select</option>
							<option value="1st Semester">1st Semester</option>
							<option value="2nd Semester">2nd Semester</option>
						</select>
					</div>
					<div class="container lofcontainer" style="margin-right: -15px;">
						<button id="ForecastBtn" class="btn btn-adduser shadow-none lofaddfacbtn"></i> Forecast</a>
					</div>
                </div>
            </div>

			<style>

			/* Container for the two grids */
				.grid-container {
					display: flex;
					justify-content: space-between;
					margin-right: 2px;
					margin-top: 20px;
					margin-bottom: 30px;
					gap: 10px
				}

				/* Left grid */
				.grid-con-input-eval-left {
					flex: 1.3;
					border-radius: 10px;
					background-color: #ffffff;
					padding: 20px;
				}

				/* Right grid */
				.grid-con-input-eval-right {
					flex: 0.7;
					border-radius: 10px;
					background-color: #ffffff;
					padding: 20px;

				}

				.table{
					margin-top: 10%;
					margin-left: 13px;
					width:110%;
				}

				.table1forecastsystem1{
					margin-top: 30px;
					width: 100%
				}
				.table1forecastsystem{
					width: 100%;
					margin-top: 90px;
				}
				table , td, th {
					border: 1px solid #000000;
					border-collapse: collapse;
					text-align:center;
					padding: 0%;
					font-family: 'Times New Roman';
					font-size: 18px;
				}
				td, th {
					padding: 3px;
					height: 30px;
				}
				th {
					background: #f0e6cc;
				}
				.even {
					background: #fbf8f0;
				}
				.odd {
					background: #fefcf9;
				}

				.semtablehead{
					width: 1px;
				}

				tr:nth-child(even)

				.empstatustablehead{
					width: 5px;
				}

				.totaltblhead{
					width: 120px !important;
				}

				.aytblhead{
					font-family: 'Times New Roman';
					font-weight: 700;
					font-size: px;
				}

				/* .existingcolumn{
					background-color: rgb(253, 252, 245);

				}

				.requisitioncolumn{
					background-color: #f8efef;
				}
				
				.forecasttbleline{
					background-color:#ebf5fc;
				} */
			</style>
			
			<div class="grid-container">
				<div class="grid-con-input-eval-left shadow" style="overflow-x:auto;">
					<h2>  </h2>
					<table class="table1forecastsystem1">
						
							<tr>
								<td colspan="8" class="tblHeader">Manpower Requisition: Manpower Requirement</td>
							</tr>
							<tr>
								<td rowspan="2" class="semtablehead">A.Y.</td>
								<td rowspan="2" class="semtablehead">Semester</td>
								<td rowspan="2" class="semtablehead"></td>
								<td colspan="2" class="empstatustablehead">Permanent</td>
								<td colspan="2">Contractual</td>
								<td></td>
							</tr>
							<tr>
								<td>Full-Time</td>
								<td>Part-Time</td>
								<td>Full-Time</td>
								<td>Part-Time</td>
								<td class="totaltblhead">Total</td>
							</tr>
							<tr class="existingcolumn">
								<td rowspan="3" style="background-color: #FFFFFF" id="currentAcademicYear"></td>
								<td rowspan="3" style="background-color: #FFFFFF" >1st</td>
								<td >Existing</td>
								<td id="1st-existing-fulltime-permanent"></td>
								<td id="1st-existing-parttime-permanent"></td>
								<td id="1st-existing-fulltime-contractual"></td>
								<td id="1st-existing-parttime-contractual"></td>
								<td id="1st-existing-total"></td>
							</tr>
							<tr class="requisitioncolumn">
								<td >Requisition</td>
								<td colspan="2" id="1st-requisition-permanent"></td>
								<td colspan="2" id="1st-requisition-contractual"></td>
								<td id="1st-requisition-total"></td>
							</tr>
							<tr class="forecasttbleline">
								<td >Forecasting</td>
								<td id="1st-forecasted-fulltime-permanent"></td>
								<td id="1st-forecasted-parttime-permanent"></td>
								<td id="1st-forecasted-fulltime-contractual"></td>
								<td id="1st-forecasted-parttime-contractual"></td>
								<td id="1st-forecasted-total"></td>
							</tr>

							<tr class="existingcolumn">
								<td rowspan="3" style="background-color: #FFFFFF" id="previousAcademicYear"></td>
								<td rowspan="3" style="background-color: #FFFFFF">1st</td>
								<td>Existing</td>
								<td id="2nd-existing-fulltime-permanent"></td>
								<td id="2nd-existing-parttime-permanent"></td>
								<td id="2nd-existing-fulltime-contractual"></td>
								<td id="2nd-existing-parttime-contractual"></td>
								<td id="2nd-existing-total"></td>
							</tr>
							<tr class="requisitioncolumn">
								<td>Requisition</td>
								<td colspan="2" id="2nd-requisition-permanent"></td>
								<td colspan="2" id="2nd-requisition-contractual"></td>
								<td id="2nd-requisition-total"></td>
							</tr>
							<tr class="forecasttbleline">
								<td>Forecasting</td>
								<td id="2nd-forecasted-fulltime-permanent"></td>
								<td id="2nd-forecasted-parttime-permanent"></td>
								<td id="2nd-forecasted-fulltime-contractual"></td>
								<td id="2nd-forecasted-parttime-contractual"></td>
								<td id="2nd-forecasted-total"></td>
							</tr>
							
						</tbody>
					</table>
				</div>
				<div class="grid-con-input-eval-right shadow"> <!-- dito same sa unang graph ng forecasting data -->
					<!-- <div id="chartContainer" style="height: 370px; width: 100%;"></div>			 -->
					<canvas id="manpowerRequiredChartContainer"></canvas>
				</div>
			</div>
			<div class="grid-container">
				<div class="grid-con-input-eval-left shadow"> 
					<table class="table1forecastsystem">
						<tbody>
							<tr>
								<td colspan="8" class="tblHeader">Manpower Requisition Data: Reason for Replacement</td>
							</tr>
							<tr>
								<td class="semtablehead">A.Y.</td>
								<td class="semtablehead">Semester</td>
								<td></td>
								<td>Transfer</td>
								<td>Resigned</td>
								<td>Promotion</td>
								<td>Others</td>
								<td class="totaltblhead">Total</td>
							</tr>
							<tr class="requisitioncolumn">
								<td rowspan="2" style="background-color: #FFFFFF" id="currentAcademicYear2"></td>
								<td rowspan="2" style="background-color: #FFFFFF">1st</td>
								<td>Requisition</td>
								<td id="1st-requested-rreplacement-transfer"></td>
								<td id="1st-requested-rreplacement-resigned"></td>
								<td id="1st-requested-rreplacement-promotion"></td>
								<td id="1st-requested-rreplacement-others"></td>
								<td id="1st-requested-rreplacement-total"></td>
							</tr>
							<tr class="forecasttbleline">
								<td>Forecasting</td>
								<td id="1st-forecasted-rreplacement-transfer"></td>
								<td id="1st-forecasted-rreplacement-resigned"></td>
								<td id="1st-forecasted-rreplacement-promotion"></td>
								<td id="1st-forecasted-rreplacement-others"></td>
								<td id="1st-forecasted-rreplacement-total"></td>
							</tr>
							<tr class="requisitioncolumn">
								<td rowspan="2" style="background-color: #FFFFFF" id="previousAcademicYear2"></td>
								<td rowspan="2" style="background-color: #FFFFFF">1st</td>
								<td>Requisition</td>
								<td id="2nd-requested-rreplacement-transfer"></td>
								<td id="2nd-requested-rreplacement-resigned"></td>
								<td id="2nd-requested-rreplacement-promotion"></td>
								<td id="2nd-requested-rreplacement-others"></td>
								<td id="2nd-requested-rreplacement-total"></td>
							</tr>
							<tr class="forecasttbleline">
								<td>Forecasting</td>
								<td id="2nd-forecasted-rreplacement-transfer"></td>
								<td id="2nd-forecasted-rreplacement-resigned"></td>
								<td id="2nd-forecasted-rreplacement-promotion"></td>
								<td id="2nd-forecasted-rreplacement-others"></td>
								<td id="2nd-forecasted-rreplacement-total"></td>
							</tr>
						</tbody>
					</table>		
				</div>
				<div class="grid-con-input-eval-right shadow">
					<canvas id="reasonReplacementChartContainer"></canvas>	
				</div>
			</div>
			
			<div class="grid-con-input-eval shadow" style="overflow-x:auto;">
				<table class="mrdatafs1">
					<tbody id="manpowerRequisitionDataDates">
						<tr>
							<td colspan="22" class="tblHeader"> Manpower Requisition Data: Requisition Process</td>
						</tr>
						<tr>
							<td colspan="22" class="aytblhead" id="ay-mrdata"></td>
						</tr>
						<tr>
							<td rowspan="2" >MR No.</td>
							<td rowspan="2">Semester</td>
							<td colspan="3">HR / Processing</td>
							<td colspan="3">Request</td>
							
							
						</tr>
						<tr>
							<td>Received by</td>
							<td>Position</td>
							<td>Approved Date</td>
							<td>Requested</td>
							<td>Date Provided</td>
							<td>Lead-Time</td>
						</tr>
					</tbody>
				</table>
				<br>
			</div>
			<br>
			<div class="grid-con-input-eval shadow" style="overflow-x:auto;">
				<h4> </h4>
				<table class="mrdatafs">
					<tbody id="manpowerRequisitionDataContent">
						<tr>
							<td colspan="22" class="tblHeader"> Manpower Requisition Data: Lead Time </td>
						</tr>
						<tr>
							<td rowspan="2">MR No.</td>
							<td rowspan="2">Semester</td>
							<td colspan="9">Requesting Side</td>
							
						</tr>
						<tr>
							<td>College</td>
							<td>Department </td>
							<td>Employment Status</td>
							<td>Teaching/ Non-Teaching</td>
							<td>New/ Additional/ Replacement</td>
							<td>Reason for New/Additional</td>
							<td>Reason for Replacement</td>
							<td>Budget</td>
						</tr>
						{{-- <tr>
							<td id="1stsem-mrnum-fsystem-mrdata"></td>
							<td id="1stsem-semester-fsystem-mrdata"></td>
							<td id="1stsem-college-fsystem-mrdata"></td>
							<td id="1stsem-dept-fsystem-mrdata"></td>
							<td id="1stsem-numEmpReq-fsystem-mrdata"></td>
							<td id="1stsem-empStatus-fsystem-mrdata"></td>
							<td id="1stsem-position-fsystem-mrdata"></td>
							<td id="1stsem-category-fsystem-mrdata"></td>
							<td id="1stsem-categoryTxt-fsystem-mrdata"></td>
							<td id="1stsem-budget-fsystem-mrdata"></td>
						</tr>
						<tr>
							<td id="2ndsem-mrnum-fsystem-mrdata"></td>
							<td id="2ndsem-semester-fsystem-mrdata"></td>
							<td id="2ndsem-college-fsystem-mrdata"></td>
							<td id="2ndsem-dept-fsystem-mrdata"></td>
							<td id="2ndsem-numEmpReq-fsystem-mrdata"></td>
							<td id="2ndsem-empStatus-fsystem-mrdata"></td>
							<td id="2ndsem-position-fsystem-mrdata"></td>
							<td id="2ndsem-category-fsystem-mrdata"></td>
							<td id="2ndsem-categoryTxt-fsystem-mrdata"></td>
							<td id="2ndsem-budget-fsystem-mrdata"></td>
						</tr> --}}
					</tbody>
				</table>
				<br> <br>
			</div>
			<br>

			<style>
				.majorsubjdata, .subjservdata, .grandtotaldata {
					width: 96.5%;
					margin-top: 15px;
					margin-left: 20px;
					margin-right: 18px;
					border: 1px solid #000000;
					border-collapse: collapse;
					text-align:center;
					font-family: 'Times New Roman';
					font-size: 18px;
				}

				.factobereplaceddata{
					width: 98.8%;
					margin-top: 10px;
					margin-left: 4px;
					margin-right: 10px;
					border: 1px solid #000000;
					border-collapse: collapse;
					text-align:center;
					font-family: 'Times New Roman';
					font-size: 18px;
				}

				h4 {
					font-family: 'Times New Roman';
					font-size: 28px;
					font-weight: 700;
					margin-top: 15px;
					text-align: center;
				}

				.totalmajorsubj{
				}

				.tblHeader{
					font-family: 'Times New Roman';
					font-weight: 600;
					background-color: #DDE6F5;
					background-color: #395583;
					color: #ffffff;
					font-size: 20px;
				}

				.servsubjhead{
					width: 108px;
				}

				.mrdatafs{
					width: 150%;
					margin-top: 20px;
					margin-left: 20px;
					margin-right: 18px;
					border: 1px solid #000000;
					border-collapse: collapse;
					text-align:center;
					font-family: 'Times New Roman';
					font-size: 18px;
				}
				.mrdatafs1{
					width: 97%;
					margin-top: 20px;
					margin-left: 20px;
					margin-right: 18px;
					border: 1px solid #000000;
					border-collapse: collapse;
					text-align:center;
					font-family: 'Times New Roman';
					font-size: 18px;
				}

				.deptevalfs{
					width: 100%;
					margin-top: 15px;
					border: 1px solid #000000;
					border-collapse: collapse;
					text-align:center;
					font-family: 'Times New Roman';
					font-size: 18px;
				}
			</style>

			<div class="grid-con-input-eval shadow" style="overflow-x:auto;">
				<table class="majorsubjdata">
					<tbody>
						<tr>
							<td colspan="7" class="tblHeader">Forecasting Data: A. For Professional/Major Subjects</td>
						</tr>
						<tr>
							<td class="aytblhead" id="ay-yearlevel"></td>
							<td colspan="2">Student Population</td>
							<td class="forecasttbleline">Forecast</td>
							<td colspan="2">Number of Sections Opened</td>
							<td class="forecasttbleline">Forecast</td>
						</tr>
						<tr>
							<td>Year Level</td>
							<td>1st Semester</td>
							<td>2nd Semester</td>
							<td class="forecasttbleline"><span id="sem1"></span></td>

							<td>1st Semester</td>
							<td>2nd Semester</td>
							<td class="forecasttbleline"><span id="sem2"></span></td>
						</tr>
						<tr>
							<td>1st Year</td>
							<td id="1styear-1sem-studpop"></td>
							<td id="1styear-2sem-studpop"></td>
							<td id="1styear-forecast-studpop" class="forecasttbleline"></td>
							<td id="1styear-1sem-numsecopened"></td>
							<td id="1styear-2sem-numsecopened"></td>
							<td id="1styear-forecast-numsecopened" class="forecasttbleline"></td>
						</tr>
						<tr>
							<td>2nd Year</td>
							<td id="2ndyear-1sem-studpop"></td>
							<td id="2ndyear-2sem-studpop"></td>
							<td id="2ndyear-forecast-studpop" class="forecasttbleline"></td>
							<td id="2ndyear-1sem-numsecopened"></td>
							<td id="2ndyear-2sem-numsecopened"></td>
							<td id="2ndyear-forecast-numsecopened" class="forecasttbleline"></td>
						</tr>
						<tr>
							<td>3rd Year</td>
							<td id="3rdyear-1sem-studpop"></td>
							<td id="3rdyear-2sem-studpop"></td>
							<td id="3rdyear-forecast-studpop" class="forecasttbleline"></td>
							<td id="3rdyear-1sem-numsecopened"></td>
							<td id="3rdyear-2sem-numsecopened"></td>
							<td id="3rdyear-forecast-numsecopened" class="forecasttbleline"></td>
						</tr>
						<tr>
							<td>4th Year</td>
							<td id="4thyear-1sem-studpop"></td>
							<td id="4thyear-2sem-studpop"></td>
							<td id="4thyear-forecast-studpop" class="forecasttbleline"></td>
							<td id="4thyear-1sem-numsecopened"></td>
							<td id="4thyear-2sem-numsecopened"></td>
							<td id="4thyear-forecast-numsecopened" class="forecasttbleline"></td>
						</tr>
						<tr>
							<td>5th Year</td>
							<td id="5thyear-1sem-studpop"></td>
							<td id="5thyear-2sem-studpop"></td>
							<td id="5thyear-forecast-studpop" class="forecasttbleline"></td>
							<td id="5thyear-1sem-numsecopened"></td>
							<td id="5thyear-2sem-numsecopened"></td>
							<td id="5thyear-forecast-numsecopened" class="forecasttbleline"></td>
						</tr>
						<tr class="totalmajorsubj">
							<td>Total</td>
							<td id="total-1sem-studpop"></td>
							<td id="total-2sem-studpop"></td>
							<td id="total-forecast-studpop" class="forecasttbleline"></td>
							<td id="total-1sem-numsecopened"></td>
							<td id="total-2sem-numsecopened"></td>
							<td id="total-forecast-numsecopened" class="forecasttbleline" ></td>
						</tr>
					</tbody>
				</table>
				<br>

				<table class="subjservdata">
					<tbody id="subjservdata-tbody">
						<tr>
							<td colspan="5" class="tblHeader" >Forecasting Data: B. For Service Subjects</td>
						</tr>
						
						<tr>
							<td rowspan="2" class="aytblhead servsubjhead" id="ay-servicesubject"></td>
							<td rowspan="2">Subjects</td>
							<td colspan="2">Number of Sections Opened</td>
							<td ></td>
						</tr>
						<tr>
							<td>1st Semester</td>
							<td>2nd Semester</td>
							<td class="forecasttbleline">Forecast</td>
						</tr>
					</tbody>
				</table>
				<br>

				<table class="grandtotaldata">
					<tbody>
						<tr>
							<td colspan="4" class="tblHeader">Forecasting Data: GRAND TOTAL (A+B)</td>
						</tr>
						<tr>
							<td rowspan="3">Number of Sections</td>
							<td colspan="2" class="aytblhead" id="ay-grandtotal"></td>
							<td rowspan="2" class="forecasttbleline">Forecast</td>
						</tr>
						<tr>
							<td>1st Semester</td>
							<td>2nd Semester</td>
						</tr>
						<tr>
							<td id="gtotal-1stsem"></td>
							<td id="gtotal-2ndsem"></td>
							<td id="gtotal-forecasted"></td>
						</tr>
					</tbody>
				</table>
				<br>
			</div> 
			<br>

			{{-- Forecasting Data 3s --}}
			<div class="grid-con-input-eval-left shadow" style="overflow-x:auto; ">
				<table class="factobereplaceddata">
					<tbody id="facultytobereplacedDataContent">
						<tr>
							<td colspan="4" class="tblHeader">Forecasting Data:  Faculty to be Replaced</td>
						</tr>
						<tr>
							<td style="width: 8%;">Forecast ID</td>
							<td>Name of Faculty to be Replaced</td>
							<td>Reason for Replacement</td>
							<td>Reason for Hiring</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>
			<div class="grid-con-input-eval-left shadow" style="overflow-x:auto; ">
				<table class="deptevalfs">
					<tbody id="evalDepartmentDataReportContent">
						<tr>
							<td colspan="12" class="tblHeader">Faculty Evaluation Report</td>
						<tr>
							<td rowspan="2">Faculty Member</td>
							<td rowspan="2">A.Y</td>
							<td rowspan="2">Semester</td>
							<td colspan="2">Performances</td>
							<td colspan="4">Evaluations</td>
							<td rowspan="2" colspan="2">Employment Status</td>
							<td rowspan="2">Over-all Status</td>
						</tr>
						<tr>
							<td >AWOL</td>
							<td>Absences</td>
							<td class="evalpage-tbi">Students</td>
							<td class="evalpage-tbi">Peer</td>
							<td class="evalpage-tbi">Dean</td>
							<td class="evalpage-tbi">Chairperson</td>
						</tr>
					</tbody>
				</table>
			</div> <br><br>
        </div>
		

		<script>
			$(document).ready(function() {
				var chart1, 
				chart2 = null;

				$("#ForecastBtn").click(function() {
					let collegeSelect = $("#college").val();
					let departmentSelect = $("#department").val();
					let aySelect = $("#ay").val();
					let semSelect = $("#sem").val();

					if (chart1) {
						chart1.destroy();
						chart2.destroy();
					}

					$("#subjservdata-tbody").html(`
						<tr>
							<td colspan="5" class="tblHeader" >Forecasting Data: B. For Service Subjects</td>
						</tr>
						<tr>
							<td rowspan="2" class="aytblhead servsubjhead" id="ay-servicesubject"></td>
							<td rowspan="2">Subjects</td>
							<td colspan="2">Number of Sections Opened</td>
							<td ></td>
						</tr>
						<tr>
							<td>1st Semester</td>
							<td>2nd Semester</td>
							<td class="forecasttbleline">Forecast</td>
						</tr>

					`);

					$("#evalDepartmentDataReportContent").html(`
						<tr>
							<td colspan="12" class="tblHeader">Faculty Evaluation Report</td>
						<tr>
							<td rowspan="2">Faculty Member</td>
							<td rowspan="2">A.Y</td>
							<td rowspan="2">Semester</td>
							<td colspan="2">Performances</td>
							<td colspan="4">Evaluations</td>
							<td rowspan="2" colspan="2">Employment Status</td>
							<td rowspan="2">Over-all Status</td>
						</tr>
						<tr>
							<td >AWOL</td>
							<td>Absences</td>
							<td class="evalpage-tbi">Students</td>
							<td class="evalpage-tbi">Peer</td>
							<td class="evalpage-tbi">Dean</td>
							<td class="evalpage-tbi">Chairperson</td>
						</tr>
					`);

					$("#manpowerRequisitionDataDates").html(`
						<tr>
							<td colspan="22" class="tblHeader"> Manpower Requisition Data: Lead Time</td>
						</tr>
						<tr>
							<td rowspan="2" >MR No.</td>
							<td rowspan="2">Semester</td>
							<td colspan="3">HR / Processing</td>
							<td colspan="3">Request</td>
							
							
						</tr>
						<tr>
							<td>Received by</td>
							<td>Position</td>
							<td>Approved Date</td>
							<td>Requested</td>
							<td>Date Provided</td>
							<td>Lead-Time</td>
						</tr>
					`);

					$("#manpowerRequisitionDataContent").html(`
							<tr>
								<td colspan="22" class="tblHeader"> Manpower Requisition Data</td>
							</tr>
							<tr>
								<td rowspan="2">MR No.</td>
								<td rowspan="2">Semester</td>
								<td colspan="9">Requesting Side</td>
								
							</tr>
							<tr style="white-space:nowrap;">
								<td>College</td>
								<td>Department </td>
								<td>No. of Employees Required</td>
								<td>Employment Status</td>
								<td>Teaching/ Non-Teaching</td>
								<td>New/ Additional/ Replacement</td>
								<td>Reason for New/Additional</td>
								<td>Reason for Replacement</td>
								<td>Budget</td>
							</tr>
					`);
					
					$("#facultytobereplacedDataContent").html(`
						<tr>
							<td colspan="4" class="tblHeader">Forecasting Data: Faculty to be Replaced</td>
						</tr>
						<tr>
							<td style="width: 8%;">Forecast ID</td>
							<td>Name of Faculty to be Replaced</td>
							<td>Reason for Replacement</td>
							<td>Reason for Hiring</td>
						</tr>
					`);

					if (
						collegeSelect &&
						departmentSelect &&
						aySelect &&
						semSelect
					) {
						$.ajax({
							type: 'GET',
							url: '/api/forecasting/system/' + collegeSelect + '/' + departmentSelect + '/' + aySelect + '/' + semSelect,
							success: function(response) {
								console.log(response);
								
								// FORECASTED
								let firstForecastedTotal = (response.semesterCurrentSchoolYr.ForecastSection4?.jspermfull ?? 0) +
									(response.semesterCurrentSchoolYr.ForecastSection4?.jscontracfull ?? 0) +
									(response.semesterCurrentSchoolYr.ForecastSection4?.jspermpart ?? 0) +
									(response.semesterCurrentSchoolYr.ForecastSection4?.jscontracpart ?? 0);

								let secondForecastedTotal = (response.semesterLastSchoolYr.ForecastSection4?.jspermfull ?? 0) +
									(response.semesterLastSchoolYr.ForecastSection4?.jscontracfull ?? 0) +
									(response.semesterLastSchoolYr.ForecastSection4?.jspermpart ?? 0) +
									(response.semesterLastSchoolYr.ForecastSection4?.jscontracpart ?? 0);

								$('#1st-forecasted-fulltime-permanent').html(response.semesterCurrentSchoolYr.ForecastSection4.jspermfull ?? 0);
								$('#1st-forecasted-parttime-permanent').html(response.semesterCurrentSchoolYr.ForecastSection4.jspermpart ?? 0);
								$('#1st-forecasted-fulltime-contractual').html(response.semesterCurrentSchoolYr.ForecastSection4.jscontracfull ?? 0);
								$('#1st-forecasted-parttime-contractual').html(response.semesterCurrentSchoolYr.ForecastSection4.jscontracpart ?? 0);
								$('#1st-forecasted-total').html(firstForecastedTotal ? firstForecastedTotal : 0);

								$('#2nd-forecasted-fulltime-permanent').html(response.semesterLastSchoolYr.ForecastSection4.jspermfull ?? 0);
								$('#2nd-forecasted-fulltime-contractual').html(response.semesterLastSchoolYr.ForecastSection4.jscontracfull ?? 0);
								$('#2nd-forecasted-parttime-permanent').html(response.semesterLastSchoolYr.ForecastSection4.jspermpart ?? 0);
								$('#2nd-forecasted-parttime-contractual').html(response.semesterLastSchoolYr.ForecastSection4.jscontracpart ?? 0);
								$('#2nd-forecasted-total').html(secondForecastedTotal ? secondForecastedTotal : 0);
								

								//EXISTING
								let firstExistingTotal = (response.semesterCurrentSchoolYr.ForecastSection2?.fulltimeperm ?? 0) +
									(response.semesterCurrentSchoolYr.ForecastSection2?.parttimeperm ?? 0) +
									(response.semesterCurrentSchoolYr.ForecastSection2?.fulltimecontrac ?? 0) +
									(response.semesterCurrentSchoolYr.ForecastSection2?.parttimecontrac ?? 0);

								let secondExistingTotal = (response.semesterLastSchoolYr.ForecastSection2?.fulltimeperm ?? 0) +
									(response.semesterLastSchoolYr.ForecastSection2?.parttimeperm ?? 0) +
									(response.semesterLastSchoolYr.ForecastSection2?.fulltimecontrac ?? 0) +
									(response.semesterLastSchoolYr.ForecastSection2?.parttimecontrac ?? 0);

								$('#1st-existing-fulltime-permanent').html(response.semesterCurrentSchoolYr.ForecastSection2.fulltimeperm ?? 0);
								$('#1st-existing-parttime-permanent').html(response.semesterCurrentSchoolYr.ForecastSection2.parttimeperm ?? 0);
								$('#1st-existing-fulltime-contractual').html(response.semesterCurrentSchoolYr.ForecastSection2.fulltimecontrac ?? 0);
								$('#1st-existing-parttime-contractual').html(response.semesterCurrentSchoolYr.ForecastSection2.parttimecontrac ?? 0);
								$('#1st-existing-total').html(firstExistingTotal ? firstExistingTotal : 0);

								$('#2nd-existing-fulltime-permanent').html(response.semesterLastSchoolYr.ForecastSection2.fulltimeperm ?? 0);
								$('#2nd-existing-parttime-permanent').html(response.semesterLastSchoolYr.ForecastSection2.parttimeperm ?? 0);
								$('#2nd-existing-fulltime-contractual').html(response.semesterLastSchoolYr.ForecastSection2.fulltimecontrac ?? 0);
								$('#2nd-existing-parttime-contractual').html(response.semesterLastSchoolYr.ForecastSection2.parttimecontrac ?? 0);
								$('#2nd-existing-total').html(secondExistingTotal ? secondExistingTotal : 0);

								//REQUISITION
								let firstRequisitionTotal = (response.semesterCurrentSchoolYr.manpowers?.regular) ?? 0 +
									(response.semesterCurrentSchoolYr.manpowers?.contractual ?? 0);

								let secondRequisitionTotal = (response.semesterLastSchoolYr.manpowers?.regular) ?? 0 +
									(response.semesterLastSchoolYr.manpowers?.contractual ?? 0);

								$('#1st-requisition-permanent').html(response.semesterCurrentSchoolYr.manpowers.regular ?? 0);
								$('#1st-requisition-contractual').html(response.semesterCurrentSchoolYr.manpowers.contractual ?? 0);
								$('#1st-requisition-total').html(firstRequisitionTotal ? firstRequisitionTotal : 0);

								$('#2nd-requisition-permanent').html(response.semesterLastSchoolYr.manpowers.regular ?? 0);
								$('#2nd-requisition-contractual').html(response.semesterLastSchoolYr.manpowers.contractual ?? 0);
								$('#2nd-requisition-total').html(secondRequisitionTotal? secondRequisitionTotal : 0);

								

								const manpowerRequiredChart = document.getElementById('manpowerRequiredChartContainer');

								chart1 = new Chart(manpowerRequiredChart, {
									type: 'bar',
									data: {
										labels: [''],
										datasets: [{
										label: '# of Existing Manpower',
										data: [firstExistingTotal + secondExistingTotal],
										backgroundColor: [
											'#C99DA3',
										],
										borderColor: [
											'#996888',
										],
										borderWidth: 1
										}, {
										label: '# of Requested Manpower',
										data: [firstRequisitionTotal + secondRequisitionTotal],
										backgroundColor: [
											'#37718E'
										],
										borderColor: [
											'#5BC3EB'
										],
										borderWidth: 1
										}, {
										label: '# Forecast Manpower',
										data: [firstForecastedTotal + secondForecastedTotal],
										backgroundColor: [
											'#7CA982',
										],
										borderColor: [
											'#285238',
										],
										borderWidth: 1
										}]
									},
									options: {
										scales: {
											y: {
												beginAtZero: true
											}
										},
										plugins: {
											legend: {
												position: 'top',
												labels: {
													color: 'black',
													font: {
														size: 15,
														family: 'Segoe UI',
														weight: 400
													}
												},
											},
											title: {
												display: true,
												text: 'Manpower Requisition',
												color: 'black',
												font: {
													size: 18,
													family: 'Segoe UI'
												}
											}
										},
										maintainAspectRatio: false,
        								aspectRatio: 3, 
									}
								});

								// Forecasted

								let first_semester_forecastSection3 = response.semesterCurrentSchoolYr.ForecastSection3;

								let first_semester_transferObj = first_semester_forecastSection3.find(data => data.reasonreplace == "Transfer");
								let first_semester_resignedObj = first_semester_forecastSection3.find(data => data.reasonreplace == "Resigned");
								let first_semester_promotionObj = first_semester_forecastSection3.find(data => data.reasonreplace == "Promotion");
								let first_semester_othersObj = first_semester_forecastSection3.find(data => data.reasonreplace == "Others");

								let first_semester_transferTotal = first_semester_transferObj?.total ?? 0;
								let first_semester_resignedTotal = first_semester_resignedObj?.total ?? 0;
								let first_semester_promotionTotal = first_semester_promotionObj?.total ?? 0;
								let first_semester_othersTotal = first_semester_othersObj?.total ?? 0;
								let firstForecastedReplacementTotal = first_semester_transferTotal +
									first_semester_resignedTotal +
									first_semester_promotionTotal +
									first_semester_othersTotal;

								$("#1st-forecasted-rreplacement-transfer").html(first_semester_transferTotal);
								$("#1st-forecasted-rreplacement-resigned").html(first_semester_resignedTotal);
								$("#1st-forecasted-rreplacement-promotion").html(first_semester_promotionTotal);
								$("#1st-forecasted-rreplacement-others").html(first_semester_othersTotal);
								$("#1st-forecasted-rreplacement-total").html(firstForecastedReplacementTotal);

								let second_semester_forecastSection3 = response.semesterLastSchoolYr.ForecastSection3;

								let second_semester_transferObj = second_semester_forecastSection3.find(data => data.reasonreplace == "Transfer");
								let second_semester_resignedObj = second_semester_forecastSection3.find(data => data.reasonreplace == "Resigned");
								let second_semester_promotionObj = second_semester_forecastSection3.find(data => data.reasonreplace == "Promotion");
								let second_semester_othersObj = second_semester_forecastSection3.find(data => data.reasonreplace == "Others");

								let second_semester_transferTotal = second_semester_transferObj?.total ?? 0;
								let second_semester_resignedTotal = second_semester_resignedObj?.total ?? 0;
								let second_semester_promotionTotal = second_semester_promotionObj?.total ?? 0;
								let second_semester_othersTotal = second_semester_othersObj?.total ?? 0;
								let secondForecastedReplacementTotal = second_semester_transferTotal +
									second_semester_resignedTotal +
									second_semester_promotionTotal +
									second_semester_othersTotal;

								$("#2nd-forecasted-rreplacement-transfer").html(second_semester_resignedTotal);
								$("#2nd-forecasted-rreplacement-resigned").html(second_semester_resignedTotal);
								$("#2nd-forecasted-rreplacement-promotion").html(second_semester_promotionTotal);
								$("#2nd-forecasted-rreplacement-others").html(second_semester_othersTotal);
								$("#2nd-forecasted-rreplacement-total").html(secondForecastedReplacementTotal);

								// Requested
								let first_semester_manpowers = response.semesterCurrentSchoolYr.manpowers;
								let first_semester_manpowers_transferObj = first_semester_manpowers.replacement_dropdown == "Transfer" ? first_semester_manpowers : null;
								let first_semester_manpowers_resignedObj = first_semester_manpowers.replacement_dropdown == "Resigned" ? first_semester_manpowers : null;
								let first_semester_manpowers_promotionObj = first_semester_manpowers.replacement_dropdown == "Promotion" ? first_semester_manpowers : null;
								let first_semester_manpowers_othersObj = first_semester_manpowers.replacement_dropdown == "Others" ? first_semester_manpowers : null;

								let first_semester_manpowers_transferTotal = first_semester_manpowers_transferObj?.num_emp_required ?? 0;
								let first_semester_manpowers_resignedTotal = first_semester_manpowers_resignedObj?.num_emp_required ?? 0;
								let first_semester_manpowers_promotionTotal = first_semester_manpowers_promotionObj?.num_emp_required ?? 0;
								let first_semester_manpowers_othersTotal = first_semester_manpowers_othersObj?.num_emp_required ?? 0;
								let firstRequestedReplacementTotal = first_semester_manpowers_transferTotal +
									first_semester_manpowers_resignedTotal +
									first_semester_manpowers_promotionTotal +
									first_semester_manpowers_othersTotal;
								
								$("#1st-requested-rreplacement-transfer").html(first_semester_manpowers_transferTotal);
								$("#1st-requested-rreplacement-resigned").html(first_semester_manpowers_resignedTotal);
								$("#1st-requested-rreplacement-promotion").html(first_semester_manpowers_promotionTotal);
								$("#1st-requested-rreplacement-others").html(first_semester_manpowers_othersTotal);
								$("#1st-requested-rreplacement-total").html(firstRequestedReplacementTotal);

								console.log("First Semester Requested - Transfer Total:", first_semester_manpowers_transferTotal);
								console.log("First Semester Requested - Resigned Total:", first_semester_manpowers_resignedTotal);
								console.log("First Semester Requested - Promotion Total:", first_semester_manpowers_promotionTotal);
								console.log("First Semester Requested - Others Total:", first_semester_manpowers_othersTotal);
								console.log("First Semester Requested - Total:", firstRequestedReplacementTotal);

								let second_semester_manpowers = response.semesterLastSchoolYr.manpowers;
								let second_semester_manpowers_transferObj = second_semester_manpowers.replacement_dropdown == "Transfer" ? second_semester_manpowers : null;
								let second_semester_manpowers_resignedObj = second_semester_manpowers.replacement_dropdown == "Resigned" ? second_semester_manpowers : null;
								let second_semester_manpowers_promotionObj = second_semester_manpowers.replacement_dropdown == "Promotion" ? second_semester_manpowers : null;
								let second_semester_manpowers_othersObj = second_semester_manpowers.replacement_dropdown == "Others" ? second_semester_manpowers : null;

								let second_semester_manpowers_transferTotal = second_semester_manpowers_transferObj?.num_emp_required ?? 0;
								let second_semester_manpowers_resignedTotal = second_semester_manpowers_resignedObj?.num_emp_required ?? 0;
								let second_semester_manpowers_promotionTotal = second_semester_manpowers_promotionObj?.num_emp_required ?? 0;
								let second_semester_manpowers_othersTotal = second_semester_manpowers_othersObj?.num_emp_required ?? 0;
								let secondRequestedReplacementTotal = second_semester_manpowers_transferTotal +
									second_semester_manpowers_resignedTotal +
									second_semester_manpowers_promotionTotal +
									second_semester_manpowers_othersTotal;
								

								$("#2nd-requested-rreplacement-transfer").html(second_semester_manpowers_transferTotal);
								$("#2nd-requested-rreplacement-resigned").html(second_semester_manpowers_resignedTotal);
								$("#2nd-requested-rreplacement-promotion").html(second_semester_manpowers_promotionTotal);
								$("#2nd-requested-rreplacement-others").html(second_semester_manpowers_othersTotal);
								$("#2nd-requested-rreplacement-total").html(secondRequestedReplacementTotal);

								const reasonReplacementChart = document.getElementById('reasonReplacementChartContainer');

								chart2 = new Chart(reasonReplacementChart, {
									type: 'pie',
									data: {
										labels: ['Transfer', 'Resigned', 'Promotion', 'Others'],
										datasets: [{
										label: 'Requisition',
										backgroundColor: [
											'#77A6B6', // Background color for Transfer
											'#F7A072', // Background color for Resigned
											'#FF9B42',  // Background color for Promotion
											'#344055'  // Background color for Others
										],
										borderColor: [
											'#283845',
											'#DE3C4B',
											'#AA5042',
											'#242038',
										],
										data: [first_semester_manpowers_transferTotal + second_semester_manpowers_transferTotal, 
												first_semester_manpowers_resignedTotal + second_semester_manpowers_resignedTotal, 
												first_semester_manpowers_promotionTotal + second_semester_manpowers_promotionTotal, 
												first_semester_manpowers_othersTotal + second_semester_manpowers_othersTotal],
												borderWidth: 1
											}, {
										label: 'Forecasting',
										backgroundColor: [
											'#77A6B6', // Background color for Transfer
											'#F7A072', // Background color for Resigned
											'#FF9B42',  // Background color for Promotion
											'#344055'  // Background color for Others
										],
										borderColor: [
											'#283845',
											'#DE3C4B',
											'#AA5042',
											'#242038',
										],
										data: [first_semester_transferTotal + second_semester_transferTotal, 
												first_semester_resignedTotal + second_semester_resignedTotal, 
												first_semester_promotionTotal + second_semester_promotionTotal, 
												first_semester_othersTotal + second_semester_othersTotal],
										borderWidth: 1
										}]
									},
									options: {
										responsive: true,
										plugins: {
											legend: {
												position: 'top',
												labels: {
													color: 'black',
													font: {
														size: 15,
														family: 'Segoe UI',
														weight: 400
													}
												},
											},
											title: {
												display: true,
												text: 'Reason for Replacement',
												color: 'black',
												font: {
													size: 18,
													family: 'Segoe UI'
												}
											}
										}
									}
								});

								// A. For Professional/Major Subjects
								let ForecastSection6 = null;
								if (semSelect == "1st Semester") {
									ForecastSection6 = response.semesterCurrentSchoolYr.ForecastSection6;
								} else {
									ForecastSection6 = response.semesterLastSchoolYr.ForecastSection6;
								}

								$("#1styear-1sem-studpop").html(ForecastSection6?.studentpop1y1s ?? 0);
								$("#1styear-2sem-studpop").html(ForecastSection6?.studentpop1y2s ?? 0);
								$("#1styear-forecast-studpop").html(ForecastSection6?.Total1y1s2sstudent ?? 0);
								$("#1styear-1sem-numsecopened").html(ForecastSection6?.numsectopened1y1s ?? 0);
								$("#1styear-2sem-numsecopened").html(ForecastSection6?.numsectopened1y2s ?? 0);
								$("#1styear-forecast-numsecopened").html(ForecastSection6?.Total1y1s2ssection ?? 0);
								$("#2ndyear-1sem-studpop").html(ForecastSection6?.studentpop2y1s ?? 0);
								$("#2ndyear-2sem-studpop").html(ForecastSection6?.studentpop2y2s ?? 0);
								$("#2ndyear-forecast-studpop").html(ForecastSection6?.Total2y1s2sstudent ?? 0);
								$("#2ndyear-1sem-numsecopened").html(ForecastSection6?.numsectopened2y1s ?? 0);
								$("#2ndyear-2sem-numsecopened").html(ForecastSection6?.numsectopened2y2s ?? 0);
								$("#2ndyear-forecast-numsecopened").html(ForecastSection6?.Total2y1s2ssection ?? 0);
								
								$("#3rdyear-1sem-studpop").html(ForecastSection6?.studentpop3y1s ?? 0);
								$("#3rdyear-2sem-studpop").html(ForecastSection6?.studentpop3y2s ?? 0);
								$("#3rdyear-forecast-studpop").html(ForecastSection6?.Total3y1s2sstudent ?? 0);
								$("#3rdyear-1sem-numsecopened").html(ForecastSection6?.numsectopened3y1s ?? 0);
								$("#3rdyear-2sem-numsecopened").html(ForecastSection6?.numsectopened3y2s ?? 0);
								$("#3rdyear-forecast-numsecopened").html(ForecastSection6?.Total3y2s2ssection ?? 0);
								
								$("#4thyear-1sem-studpop").html(ForecastSection6?.studentpop4y1s ?? 0);
								$("#4thyear-2sem-studpop").html(ForecastSection6?.studentpop4y2s ?? 0);
								$("#4thyear-forecast-studpop").html(ForecastSection6?.Total4y1s2sstudent ?? 0);
								$("#4thyear-1sem-numsecopened").html(ForecastSection6?.numsectopened4y1s ?? 0);
								$("#4thyear-2sem-numsecopened").html(ForecastSection6?.numsectopened4y2s ?? 0);
								$("#4thyear-forecast-numsecopened").html(ForecastSection6?.Total4y2s2ssection ?? 0);
								
								$("#5thyear-1sem-studpop").html(ForecastSection6?.studentpop5y1s ?? 0);
								$("#5thyear-2sem-studpop").html(ForecastSection6?.studentpop5y2s ?? 0);
								$("#5thyear-forecast-studpop").html(ForecastSection6?.Total5y1s2sstudent ?? 0);
								$("#5thyear-1sem-numsecopened").html(ForecastSection6?.numsectopened5y1s ?? 0);
								$("#5thyear-2sem-numsecopened").html(ForecastSection6?.numsectopened5y2s ?? 0);
								$("#5thyear-forecast-numsecopened").html(ForecastSection6?.Total5y2s2ssection ?? 0);
								
								let total1stsemstudpop = (ForecastSection6?.studentpop1y1s ?? 0)+
								(ForecastSection6?.studentpop2y1s ?? 0) +
								(ForecastSection6?.studentpop3y1s ?? 0) +
								(ForecastSection6?.studentpop4y1s ?? 0) +
								(ForecastSection6?.studentpop5y1s ?? 0);

								let total2ndsemstudpop = (ForecastSection6?.studentpop1y2s ?? 0) +
								(ForecastSection6?.studentpop2y2s ?? 0) +
								(ForecastSection6?.studentpop3yy2s ?? 0) +
								(ForecastSection6?.studentpop4y2s ?? 0) +
								(ForecastSection6?.studentpop5y2s ?? 0);

								let totalforecaststudpop = (ForecastSection6?.Total1y1s2sstudent ?? 0) +
								(ForecastSection6?.Total2y1s2sstudent ?? 0) +
								(ForecastSection6?.Total3y1s2sstudent ?? 0) +
								(ForecastSection6?.Total4y1s2sstudent ?? 0) +
								(ForecastSection6?.Total5y1s2sstudent ?? 0);

								let total1stsemnumsecopened = (ForecastSection6?.numsectopened1y1s ?? 0) +
								(ForecastSection6?.numsectopened2y1s ?? 0) +
								(ForecastSection6?.numsectopened3y1s ?? 0) +
								(ForecastSection6?.numsectopened4y1s ?? 0) +
								(ForecastSection6?.numsectopened5y1s ?? 0);

								let total2ndsemnumsecopened = (ForecastSection6?.numsectopened1y2s ?? 0) +
								(ForecastSection6?.numsectopened2y2s ?? 0) +
								(ForecastSection6?.numsectopened3y2s ?? 0) +
								(ForecastSection6?.numsectopened4y2s ?? 0) +
								(ForecastSection6?.numsectopened5y2s ?? 0);
								
								let totalforecastnumsecopened = (ForecastSection6?.Total1y1s2ssection ?? 0) +
								(ForecastSection6?.Total2y1s2ssection ?? 0) +
								(ForecastSection6?.Total3y1s2ssection ?? 0) +
								(ForecastSection6?.Total4y1s2ssection ?? 0) +
								(ForecastSection6?.Total5y1s2ssection ?? 0);

								$("#total-1sem-studpop").html(total1stsemstudpop);
								$("#total-2sem-studpop").html(total2ndsemstudpop);
								$("#total-forecast-studpop").html(totalforecaststudpop);
								$("#total-1sem-numsecopened").html(total1stsemnumsecopened);
								$("#total-2sem-numsecopened").html(total2ndsemnumsecopened);
								$("#total-forecast-numsecopened").html(totalforecastnumsecopened);

								
								// B. For Service Subjects
								let ForecastSection7 = null;
								if (semSelect == "1st Semester") {
									ForecastSection7 = response.semesterCurrentSchoolYr.ForecastSection7;
								} else {
									ForecastSection7 = response.semesterLastSchoolYr.ForecastSection7;
								}

								let totalforecastservsubj = 0
								let totalssubj1stnumsectopened = 0
								let totalssubj2ndnumsectopened = 0

								ForecastSection7.map(data => {
									totalssubj1stnumsectopened += data.ssubj1stnumsectopened;
									totalssubj2ndnumsectopened += data.ssubj2ndnumsectopened;
									const Total1s2sForecastServSubject = data.ssubj1stnumsectopened + data.ssubj2ndnumsectopened;
									
									$("#subjservdata-tbody").append(`
										<tr>
											<td>${data.servsubj_id}</td>
											<td>${data.servsubj}</td>
											<td>${data.ssubj1stnumsectopened}</td>
											<td>${data.ssubj2ndnumsectopened}</td>
											<td>${Total1s2sForecastServSubject} </td> 
										</tr>
									`);
								});

								
								$("#subjservdata-tbody").append(`
									<tr class="totalmajorsubj">
										<td>Total</td>
										<td></td>
										<td id="total-1stsem-sevsubj">${totalssubj1stnumsectopened}</td>
										<td id="total-2ndsem-sevsubj">${totalssubj2ndnumsectopened}</td>
										<td id="total-forecasted-sevsubj">${totalssubj1stnumsectopened + totalssubj2ndnumsectopened}</td>
									</tr>
								`);

								// GRAND TOTAL (A+B)
								let ForecastSection8 = null;
								if (semSelect == "1st Semester") {
									ForecastSection8 = response.semesterCurrentSchoolYr.ForecastSection8;
								} else {
									ForecastSection8 = response.semesterLastSchoolYr.ForecastSection8;
								}
								$("#gtotal-1stsem").html(ForecastSection8?.grandt1st ?? 0);
								$("#gtotal-2ndsem").html(ForecastSection8?.grand2nd ?? 0);
								$("#gtotal-forecasted").html(ForecastSection8?.forecastgrandtotal ?? 0);

								// Faculty Evaluation Report
								let evalpages = null;
								if (semSelect == "1st Semester") {
									evalpages = response.semesterCurrentSchoolYr.evalpages;
								} else {
									evalpages = response.semesterLastSchoolYr.evalpages;
								}

								evalpages.map(data => {
									let statusClass = '';
									let backgroundColor = ''; 

									const overallStatusValue = parseFloat(data.overallstatus.replace('%', ''));

									if (isNaN(overallStatusValue)) {
										// Handle the case when data.overallstatus is not a valid number
										statusClass = 'status-yellow';
										backgroundColor = 'yellow';
									} else if (overallStatusValue >= 50.0 && overallStatusValue <= 100.0) {
										statusClass = 'status-green';
										backgroundColor = 'green';
									} else if (overallStatusValue >= 0.0 && overallStatusValue <= 49.0) {
										statusClass = 'status-red';
										backgroundColor = 'red';
									}
									
									// Create a new row
									let row = $("<tr>");

									// Append other columns to the row
									row.append(`<td>${data.first_name} ${data.last_name}</td>`);
									row.append(`<td>${data.ay}</td>`);
									row.append(`<td>${data.semester}</td>`);
									row.append(`<td>${data.awolna}</td>`);
									row.append(`<td>${data.absences}</td>`);
									row.append(`<td class="evalpage-tbi">${data.student}</td>`);
									row.append(`<td class="evalpage-tbi">${data.peer}</td>`);
									row.append(`<td class="evalpage-tbi">${data.dean}</td>`);
									row.append(`<td class="evalpage-tbi">${data.chairperson}</td>`);
									row.append(`<td colspan="2" class="evalpage-empstatus">${data.empstatus}</td>`);

									// Create the "Over-all Status" cell and set the background color
									let statusCell = $("<td>");
									statusCell.addClass(`evalpage-empstatus ${statusClass}`);
									statusCell.css("background-color", backgroundColor); 
									statusCell.append(data.overallstatus);
									row.append(statusCell);

									// Append the row to the table
									$("#evalDepartmentDataReportContent").append(row);
								});

								// Manpower Requisiton Data Dates
								if (semSelect == "1st Semester") {
									manpowerprocessing = response.semesterCurrentSchoolYr.manpowerprocessing;
								} else {
									manpowerprocessing = response.semesterLastSchoolYr.manpowerprocessing;
								}

								console.log(manpowerprocessing)

								//  manpowerprocessing 1
								manpowerprocessing.map(data => {
									// Create a new row
									let row = $("<tr>");

									// Append other columns to the row
									row.append(`<td>${data.mrNum}</td>`);
									row.append(`<td>${data.semester}</td>`);
									row.append(`<td>${data.receivedBy}</td>`);
									row.append(`<td>${data.position}</td>`);
									row.append(`<td>${data.dateapproved}</td>`);
									row.append(`<td>${data.daterequested}</td>`); //2023-10-02 14:51:39
									row.append(`<td>${data.datecompleted}</td>`);

									// Calculate the difference in days
									const createdDate = new Date(data.daterequested);
									const completedDate = new Date(data.datecompleted);
									const timeDifference = Math.abs(completedDate - createdDate);
									const differenceInDays = Math.ceil(timeDifference / (1000 * 3600 * 24));

									// Append the difference in days to the row
									row.append(`<td>${differenceInDays} days</td>`); 

									
									// Append the row to the table
									$("#manpowerRequisitionDataDates").append(row);
								});

								// Manpower Requisiton Data NumEmpRequired
								if (semSelect == "1st Semester") {
									manpowerprocessing = response.semesterCurrentSchoolYr.manpowerprocessing;
								} else {
									manpowerprocessing = response.semesterLastSchoolYr.manpowerprocessing;
								}

								console.log(manpowerprocessing)

								//  manpowerprocessing 2
								manpowerprocessing.map(data => {
									// Create a new row
									let row = $("<tr>");

									// Append other columns to the row
									row.append(`<td>${data.mrNum}</td>`);
									row.append(`<td>${data.semester}</td>`);
									row.append(`<td>${data.college}</td>`);
									row.append(`<td>${data.department}</td>`);
									row.append(`<td>${data.num_emp_required}</td>`);
									row.append(`<td>${data.employment_status}</td>`);
									row.append(`<td>${data.position}</td>`);
									row.append(`<td>${data.category}</td>`);
									row.append(`<td>${data.category_textbox}</td>`);
									row.append(`<td>${data.replacement_dropdown}</td>`);
									row.append(`<td>${data.budget}</td>`);

									
									// Append the row to the table
									$("#manpowerRequisitionDataContent").append(row);
								});
								// FORECAST 3S NAME OF FACULTY TO BE REPLACED		
								if (semSelect == "1st Semester") {
									manpowerprocessing = response.semesterCurrentSchoolYr.manpowerprocessing 

									console.log(response.semesterCurrentSchoolYr.ForecastSection3List);
									response.semesterCurrentSchoolYr.ForecastSection3List.map(data => {
										// Create a new row
										let row = $("<tr>");

										// Append other columns to the row
										row.append(`<td>${data.forecast_num_id}</td>`);
										row.append(`<td>${data.namefacreplace}</td>`);
										row.append(`<td>${data.reasonreplace}</td>`);
										row.append(`<td>${data.reasonforhiring}</td>`);

										row.append(`</tr>`);

										// Append the row to the table
										$("#facultytobereplacedDataContent").append(row);
									});
								} else {
									manpowerprocessing = response.semesterLastSchoolYr.manpowerprocessing;

									console.log(response.semesterLastSchoolYr.ForecastSection3List);
									response.semesterLastSchoolYr.ForecastSection3List.map(data => {
										// Create a new row
										let row = $("<tr>");

										// Append other columns to the row
										row.append(`<td>${data.forecast_num_id}</td>`);
										row.append(`<td>${data.namefacreplace}</td>`);
										row.append(`<td>${data.reasonreplace}</td>`);
										row.append(`<td>${data.reasonforhiring}</td>`);

										row.append(`</tr>`);

										// Append the row to the table
										$("#facultytobereplacedDataContent").append(row);
									});
								}
								
								function toggleDataSeries(e) {
									if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
										e.dataSeries.visible = false;
									}
									else {
										e.dataSeries.visible = true;
									}
									chart4.render();
								}
							},
							error: function(err) {
								console.log(err);
							}
						});
					} else {
						alert("Please select required fields.");
					}
				});
			});
		</script>

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

		<script>
			var selectElement = document.getElementById('ay');
            var thElement1 = document.getElementById('ay1');
			var thElement4 = document.getElementById('ay4');
			var thElement5 = document.getElementById('ay5');
			var thElement6 = document.getElementById('ay6');
			var thElement7 = document.getElementById('ay7');

            // Using jQuery
            $('#ay').on('change', function() {
                $('#ay-yearlevel, #ay-servicesubject, #ay-section, #ay-grandtotal, #ay-mrdata, #ay-mrdata2').html('' + $(this).val());
            });
		</script>

		<script>
			//SCRIPT FOR CHANGING SEMESTER
			// Get references to the select element and target td elements
			const semSelect = document.getElementById("sem");
			const semTd = document.getElementById("sem1");
			const semTd2 = document.getElementById("sem2");
			const semTd3 = document.getElementById("sem3");

			// Add an event listener to the select element
			semSelect.addEventListener("change", updatesem);

			// Function to update the content of the target td element
			function updatesem() {
				const selectedOption = semSelect.value;
				if (selectedOption === "1st Semester") {
					semTd.textContent = "2nd Semester";
					semTd2.textContent = "2nd Semester";
					semTd3.textContent = "2nd Semester";
				} else if (selectedOption === "2nd Semester") {
					semTd.textContent = "1st Semester";
					semTd2.textContent = "1st Semester";
					semTd3.textContent = "1st Semester";
				}
			}
		</script>

		<script>
			var selectElement = document.getElementById("ay");
			var currentAcademicYearElement = document.getElementById("currentAcademicYear");
			var previousAcademicYearElement = document.getElementById("previousAcademicYear");
			var currentAcademicYear2Element = document.getElementById("currentAcademicYear2");
			var previousAcademicYear2Element = document.getElementById("previousAcademicYear2");
		
			// Function to add academic year options
			function generateAcademicYearOptions() {
				// Get the current year
				var currentYear = new Date().getFullYear();
		
				// Set the range of years you want to display, e.g., from 2018 to currentYear
				var startYear = 2018;
				var endYear = currentYear;
		
				// Generate the academic year options dynamically
				for (var year = startYear; year <= endYear; year++) {
					var academicYear = year + "-" + (year + 1);
					var option = document.createElement("option");
					option.value = academicYear;
					option.textContent = academicYear;
					selectElement.appendChild(option);
				}
			}
		
			// Call the function to initially generate academic year options
			generateAcademicYearOptions();
		
			// Update the academic years when the dropdown changes
			selectElement.addEventListener("change", function () {
				var selectedAcademicYear = selectElement.value;
				var previousOption = selectElement.options[selectElement.selectedIndex - 1];
				var previousAcademicYear = previousOption ? previousOption.value : "";
		
				currentAcademicYearElement.textContent = selectedAcademicYear;
				previousAcademicYearElement.textContent = previousAcademicYear;
				currentAcademicYear2Element.textContent = selectedAcademicYear;
				previousAcademicYear2Element.textContent = previousAcademicYear;
			});
		</script>	

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</body>
</html>