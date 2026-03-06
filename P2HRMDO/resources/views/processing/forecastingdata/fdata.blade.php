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
	font-family: 'Times New Roman';
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

.required {
	color: red;
}

.grid-container-print-backtodashboard { 
    display: grid; 
    grid-template-columns: 1fr;
    width: 99.5%; 
    margin-bottom: 10px;
    border-radius: 10px;
	font-family: 'Times New Roman';
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
		<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" alt="Profile Image" class="profile_image" id="profile-image">
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
			It analyzes historical data patterns to predict future workforce requirements by combining three components:
			autoregression (AR), differencing (I), and moving average (MA).
			<br><br>
		</h2>
		<h2>To forecast manpower needs for the HRMDO (Human Resource Management and Development Office), using the latest 5 years data, the ARIMA model uses the following historical data: <br> </h2>
		<h2> - <span style="color: rgb(12, 133, 28)"> "Number of Additional Faculty"</span> as derived from the Forecasting Form.<br> </h2>
		<h2>- <span style="color: #37718E"> "Manpower Required"</span> as obtained from the Manpower Requisition Form.<br></h2>
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

	function generateChartExplanation(chart1ForecastedManpower, chart1RequestedManpower, arimaForecastValue) {
		var explanationDiv = document.querySelector('.forecastdata-arimamodel');

		var explanationText = "The chart shows that the possible <b> Manpower Required </b> for the <b><i>next semester</i></b> is: <b>" + arimaForecastValue + "</b>";
		explanationText += " based on the ARIMA time-series analysis of historical data. The 'Number of Additional Faculty' from Forecasting is: <b>" + chart1ForecastedManpower + "</b>";
		explanationText += " and 'Manpower Required' from Manpower Requisition Form: <b>" + chart1RequestedManpower + " .</b>";

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

			var yearParts = selectedYear.split("-");
			if (yearParts.length === 2) {
			var startYear = parseInt(yearParts[0]);
			var nextAcademicYear = (startYear + 1) + "-" + (startYear + 2);

			if (selectedSemester === "2nd Semester") {
				// Display the next academic year followed by "1st Semester"
				headingElement.textContent = "Manpower Forecast for A.Y. (" + nextAcademicYear + ") - 1st Semester";
			} else if (selectedSemester === "1st Semester") {
				// Display the selected academic year followed by "2nd Semester"
				headingElement.textContent = "Manpower Forecast for A.Y. (" + selectedYear + ") - 2nd Semester";
			}
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
	var aySemesterHeading = document.getElementById('aySemesterHeading2');


	function updateTextContent() {
		var selectedValueAy = selectElementAy.value;
		var selectedValueSem = selectElementSem.value;
		
		// var textContent = "The charts display data for A.Y. " + selectedValueAy + " - " + selectedValueSem;

		displayElementAy.textContent = textContent;
		displayElementSem.textContent = selectedValueSem;
		aySemesterHeading.textContent = textContent;

		updateHeading.destroy();
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
										label: '# of Forecast Manpower',
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

						chart2 = new Chart(manpowerRequiredChart2, {
							type: 'pie',
							data: {
								labels: [
									'# of Forecasted Manpower', 
									'# of Requested Manpower',
									'# of Forecast Manpower'
								],
								datasets: [{
									data: [
										chart1ForecastedManpower,
										chart1RequestedManpower,
										arimaForecastValue
									],
									backgroundColor: [
										'#7CA982',
										'#37718E',
										'#F3B391'
									],
									borderColor: [
										'#285238',
										'#5BC3EB',
										'#A63A50'
									],
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