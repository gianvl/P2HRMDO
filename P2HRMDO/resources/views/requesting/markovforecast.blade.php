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
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<style>
.body{
	font-family: 'Times New Roman';
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
	font-family: 'Times New Roman';
	z-index: 100;
}

.badge-container {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	margin-left: 34%;
	font-family: 'Times New Roman';
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
	font-family: 'Times New Roman';
	font-size: 23px;
	line-height: 10px;
}

h5{
	font-family: 'Times New Roman';
	font-size: 25px;
	line-height: 40px;
}

h3 {
	font-family: 'Times New Roman';
	font-size: 15px;
	text-align: center;
	line-height: 20px;
}

h2{
	font-family: 'Times New Roman';
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
	font-family: 'Times New Roman';
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
	font-family: 'Times New Roman';
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
			<a href="{{ route('requestingdashboard.index') }}">
			<img src="{{url('/images/adulogowhite.png')}}" class="img-fluid">
			</a>
		</div>
		<ul class="navbar-nav navbar-profile">
			<div class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"> {{ $loggedInUser->name }}
                    <img src="{{ asset('storage/images/' . $loggedInUser->image) }}" class="avatar" alt="Avatar" style="margin-left:10px; color:azure">
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
				@php
					$approvalCount = 0; // Initialize the count variable
					$loggedInUser = auth()->user(); // Assuming you have the logged-in user available

					if ($loggedInUser->position === 'Chairperson') {
						// Count the waiting for approval records in the Manpower table where the department matches the user's department
						$approvalCount = \App\Models\Manpower::where('approval_status', 'Waiting for Approval')
							->where('department', $loggedInUser->department)
							->count();
					} elseif ($loggedInUser->position === 'Dean') {
						// Count the waiting for approval records in the Manpower table where the college matches the user's college
						$approvalCount = \App\Models\Manpower::where('approval_status', 'Waiting for Approval')
							->where('college', $loggedInUser->college)
							->count();
					} elseif ($loggedInUser->position === 'VPA' || $loggedInUser->position === 'HRMDO Director') {
						// Count all waiting for approval records in the Manpower table
						$approvalCount = \App\Models\ManpowerApproval::where('approval_status', 'Waiting for Approval')->count();
					}
				@endphp
				<span class="badge badge-danger" style="font-size: 15px; padding: 8px 10px; margin-right: 20px;">
					<i class="fa fa-bell"></i> <!-- Notification icon -->
					{{ $approvalCount }}
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
        <a class="text-showmrform-backtodashboard" id="back" href="{{route('requestingdashboard.index')}}">Go back to Dashboard</a>
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

	<div class="grid-con-input-eval-sec shadow">
		<div class="forecast-dropdown-container-left">
			<label for="college" style="margin-top: 2px ;">College: <span class="required">*</span></label>
				<select class="dropdown-college" id="college" name="college" onchange="updateDepartments()" required style="width: 150px; height: 30px; border-color: #315EA0;">
					<option disabled selected value="" class="optiondisabled">Select College</option>
					@foreach ($collegeList as $college)
					<option value="{{ $college->college }}">{{ $college->college }}</option>
					@endforeach
				</select>
				<label for="department" style="margin-top: 2px; margin-left: 10%;">Department: <span class="required">*</span></label>
				<select class="dropdown-department" id="department" name="department" style="width: 150px; height: 30px; border-color: #315EA0;">
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

	<div class="forecastdata-header">
		<h1 class="manpowerData" id="manpowerDataAY"> <span id="manpowerDataSem"> </span></h1>

		<h1 class="forecastdata-selectedaysem2" id="aySemesterHeading"></h1>
	</div>

	<div class="grid-con-forecastdata-one shadow">
		<div>
			<canvas id="manpowerRequiredChartContainer"></canvas>
			<span class="forecastdata-arimamodel"> </span>
		</div>
		<div>
			<canvas id="manpowerRequiredChartContainer2"></canvas>
		</div>
	</div>
	{{-- // '#7CA982',
	// '#37718E',
	// '#F3B391' --}}
	<div class="grid-con-forecastdata-two">
		<h5> How the ARIMA Model Works: </h5>
		<h2> ARIMA (AutoRegressive Integrated Moving Average) is a statistical model for time-series forecasting.
			It analyzes historical data patterns to predict future workforce requirements. This system uses
			<b>ARIMA(1,1,0)</b>: one order of differencing (I) followed by a first-order autoregression (AR).
			The moving average (MA) component is not used.
			<br><br>
		</h2>
		<h2>To forecast manpower needs for the HRMDO (Human Resource Management and Development Office), the ARIMA model is fitted on a single historical series, collected over the latest 5 academic years: <br> </h2>
		<h2>- <span style="color: #37718E"> "Manpower Required"</span> as obtained from the Manpower Requisition Form.<br></h2>
		<h2>The <span style="color: rgb(12, 133, 28)"> "Number of Additional Faculty"</span> from the Forecasting Form is charted beside the forecast for comparison. It is not an input to the model.<br> </h2>
		<br>
		<h2>The ARIMA model applies the following steps: <br></h2>
		<h2>1. <b>Differencing (I)</b> - The historical manpower data is differenced to achieve stationarity.<br></h2>
		<h2>2. <b>Autoregression (AR)</b> - A regression model is fitted on the differenced data using past values to predict future values.<br></h2>
		<h2>3. <b>Forecasting</b> - The model predicts the next period's manpower requirement based on the learned patterns.<br></h2>
		<br>
		<h2> <span style="background-color: #F3B391"> ARIMA Forecast</span> = f(<span style="background-color: #9acee7"> Historical "Manpower Required" </span>)</h2>
	</div>
	<br>

	
	<script>

	function nextAcademicYear(ay) {
		var startYear = parseInt(ay.split("-")[0]);

		return (startYear + 1) + "-" + (startYear + 2);
	}

	function generateChartExplanation(chart1ForecastedManpower, chart1RequestedManpower, arimaForecastValue) {
		var explanationDiv = document.querySelector('.forecastdata-arimamodel');

		if (arimaForecastValue === null) {
			explanationDiv.innerHTML = "The <b>ARIMA forecast is unavailable</b> for this selection. There may not be enough historical data, or the forecast could not be computed.";
			return;
		}

		var explanationText = "The chart shows that the possible <b> Manpower Required </b> is: <b>" + arimaForecastValue + "</b>";
		explanationText += ", forecast by ARIMA(1,1,0) from the last 5 academic years of <b>'Manpower Required'</b> figures.";
		explanationText += " Shown beside it for comparison, for the selected academic year: 'Number of Additional Faculty' from Forecasting is <b>" + chart1ForecastedManpower + "</b>";
		explanationText += " and 'Manpower Required' from the Manpower Requisition Form is <b>" + chart1RequestedManpower + "</b>.";

		explanationDiv.innerHTML = explanationText;
	}

		// Function to add academic year options
		function generateAcademicYearOptions() {
			// Get the current year
			var currentYear = new Date().getFullYear();
	
			// Set the range of years you want to display, e.g., from 2018 to currentYear
			var startYear = 2018;
			var endYear = currentYear;
	
			// Generate the academic year options dynamically
			var selectElement = document.getElementById("ay");
	
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
	
			function updateHeading() {
			var selectedSemester = document.getElementById("sem").value;
			var selectedYear = document.getElementById("ay").value;
			var headingElement = document.getElementById("aySemesterHeading");

			if (selectedYear.split("-").length === 2) {
			// The model is fitted on one semester's figures across five academic
			// years, so the value it forecasts is that same semester in the next
			// academic year -- not the semester immediately after the selected
			// one. Select the other semester to forecast the other semester.
			headingElement.textContent = "ARIMA Forecast for A.Y. (" + nextAcademicYear(selectedYear) + ") - " + selectedSemester;
			}
		}
	</script>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<script>
	// Using JavaScript
	var selectElementAy = document.getElementById('ay');
	var selectElementSem = document.getElementById('sem');
	var displayElementAy = document.getElementById('manpowerDataAY');
	var displayElementSem = document.getElementById('manpowerDataSem');
	function updateTextContent() {
		var selectedValueAy = selectElementAy.value;
		var selectedValueSem = selectElementSem.value;

		var textContent = "The charts display data for A.Y. " + selectedValueAy + " - " + selectedValueSem;

		displayElementAy.textContent = textContent;
		displayElementSem.textContent = selectedValueSem;
	}	
</script>

<script>
	$("document").ready(function() {
		var chart1, 
		chart2 = null;

		$("#ForecastBtn").click(function() {
			let selectedCollege = $("#college").val();
			let selectedDepartment = $("#department").val();
			let selectedAY = $("#ay").val();
			let selectedSem = $("#sem").val();

			if (chart1) { chart1.destroy() }
			if (chart2) { chart2.destroy() }

			if (
				selectedCollege &&
				selectedDepartment &&
				selectedAY &&
				selectedSem
			) {
				
				$.ajax({
					type: 'GET',
					url: `/api/processing/forecastingdata/${selectedCollege}/${selectedDepartment}/${selectedAY}/${selectedSem}`,
					success: function(response) {
						console.log(response);

						var chart1RequestedManpower = 0;
						var chart1ForecastedManpower = 0;
						response.manpower.map(data => {
							chart1RequestedManpower += data.num_emp_required
						});
						response.forecastSection1.map(fs1 => {
							fs1.forecast_section4s.map(data => {
								chart1ForecastedManpower += data.numaddfacmember
							});
						});

						var arimaForecastValue = response.arima.forecast;

						var manpowerRequiredChart = document.getElementById('manpowerRequiredChartContainer');
						chart1 = new Chart(manpowerRequiredChart, {
							type: 'bar',
							data: {
								labels: [''],
								datasets: [ 
									{
										label: '# of Forecasted Manpower',
										data: [
											chart1ForecastedManpower
										],
										backgroundColor: [
											'#7CA982',
										],
										borderColor: [
											'#285238',
										],
										borderWidth: 1
									}, 
									{
										label: '# of Requested Manpower',
										data: [
											chart1RequestedManpower
										],
										backgroundColor: [
											'#37718E'
										],
										borderColor: [
											'#5BC3EB'
										],
										
										borderWidth: 1
									},
									{
										label: '# of ARIMA Forecast Manpower (5 Years Data)',
										data: [
											arimaForecastValue
										],
										backgroundColor: [
											'#F3B391',
										],
										borderColor: [
											'#A63A50',
										],
										borderWidth: 1
									}
								]
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
										text: 'Manpower Required (Bar Graph)',
										color: 'black',
										font: {
											size: 18,
											family: 'Segoe UI'
										}
									}
								}
							}
						});

						var manpowerRequiredChart2 = document.getElementById('manpowerRequiredChartContainer2');

						// The five academic years the model was fitted on, followed by
						// the year it forecasts. A year with no requisition stays null,
						// so a gap in the history is visible rather than drawn through.
						var historyYears = response.ayListArima;
						var historyValues = historyYears.map(function (year) {
							var recorded = response.arima.historicalData[year];

							return recorded === undefined ? null : recorded;
						});
						var forecastYear = nextAcademicYear(historyYears[historyYears.length - 1]);

						// The forecast line starts at the last recorded year so the
						// projected segment joins onto the history instead of floating.
						var forecastValues = historyYears.map(function () { return null; });
						forecastValues[forecastValues.length - 1] = historyValues[historyValues.length - 1];
						forecastValues.push(arimaForecastValue);

						chart2 = new Chart(manpowerRequiredChart2, {
							type: 'line',
							data: {
								labels: historyYears.concat([forecastYear]),
								datasets: [
									{
										label: 'Manpower Required (recorded)',
										data: historyValues.concat([null]),
										backgroundColor: '#37718E',
										borderColor: '#37718E',
										borderWidth: 2,
										spanGaps: false,
										tension: 0
									},
									{
										label: 'ARIMA Forecast',
										data: forecastValues,
										backgroundColor: '#F3B391',
										borderColor: '#A63A50',
										borderWidth: 2,
										borderDash: [6, 4],
										tension: 0
									}
								]
							},
							options: {
								responsive: true,
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
										text: 'Manpower Required by Academic Year',
										color: 'black',
										font: {
											size: 18,
											family: 'Segoe UI'
										}
									}
								},
								maintainAspectRatio: false,
								aspectRatio: 5,
							}
						});
						generateChartExplanation(chart1ForecastedManpower, chart1RequestedManpower, arimaForecastValue);
						// document.getElementById("sem").addEventListener("change", updateHeading);
						// document.getElementById("ay").addEventListener("change", updateHeading);
						updateHeading();
						// selectElementAy.addEventListener('change', updateTextContent);
						// selectElementSem.addEventListener('change', updateTextContent);
						updateTextContent();

						
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

</body>
</html>