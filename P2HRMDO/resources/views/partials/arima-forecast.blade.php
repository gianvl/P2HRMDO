{{--
    The ARIMA manpower forecast section: the two charts, the explanation of the
    model, and the script that fetches the data and draws them.

    Shared by the requesting, approval and processing pages, which previously
    held three copies of it. They had drifted apart -- see changes.md #15 -- and
    every fix to the forecast had to be applied by hand three times.

    Self-contained: the partial owns the four selectors and the Forecast button
    as well as the charts, so an including page only needs $collegeList.
--}}
<style>
	/* The four selectors and the Forecast button. Replaces a hand-positioned
	   layout that used margin-left:-200px to pull the Semester label back over
	   the Academic Year dropdown, which is why the two used to overlap. */
	.arima-form {
		display: grid;
		grid-template-columns: repeat(4, minmax(150px, 1fr)) auto;
		gap: 14px 18px;
		align-items: end;
	}

	.arima-field {
		display: flex;
		flex-direction: column;
		gap: 4px;
		min-width: 0;
	}

	.arima-field label {
		margin: 0;
		font-weight: 500;
		white-space: nowrap;
	}

	.arima-field select {
		width: 100%;
		height: 34px;
		padding: 0 8px;
		border: 1px solid #315EA0;
		border-radius: 4px;
		background-color: #fff;
	}

	.arima-form #ForecastBtn {
		height: 34px;
		min-width: 130px;
		white-space: nowrap;
	}

	/* A disabled Forecast button says "not yet" before the click does. */
	.arima-form #ForecastBtn:disabled {
		background-color: #b4bed0;
		border-color: #b4bed0;
		cursor: not-allowed;
	}

	/*
	 * The explanation block marks its prose up as <h2>, and the page's global
	 * h2 rule sets line-height:20px on 20px text -- a ratio of 1.0. The old
	 * serif face, with its smaller x-height, disguised how tight that was.
	 * Scoped here rather than changing h2 across the application.
	 */
	.grid-con-forecastdata-two h2 {
		font-size: 1rem;
		font-weight: 400;
		line-height: 1.65;
		text-align: left;
		margin-bottom: var(--app-space-2);
	}

	.grid-con-forecastdata-two h5 {
		font-size: 1.2rem;
		font-weight: 600;
		margin-bottom: var(--app-space-4);
		text-align: left;
	}

	.arima-charts-empty {
		padding: 48px 24px;
		text-align: center;
		color: #5d6b82;
		background-color: #f7f8fa;
		border-radius: 6px;
	}

	.arima-form-hint {
		margin: 12px 0 0;
		font-size: 0.9rem;
		color: #5d6b82;
	}

	@media (max-width: 1100px) {
		.arima-form { grid-template-columns: repeat(2, minmax(150px, 1fr)); }
		.arima-form .arima-field--action { grid-column: 1 / -1; }
	}
</style>

<div class="grid-con-input-eval-sec shadow">
	<div class="arima-form">
		<div class="arima-field">
			<label for="college">College <span class="required">*</span></label>
			<select id="college" name="college" onchange="updateDepartments()" required>
				<option disabled selected value="" class="optiondisabled">Select College</option>
				@foreach ($collegeList as $college)
					<option value="{{ $college->college }}">{{ $college->college }}</option>
				@endforeach
			</select>
		</div>

		<div class="arima-field">
			<label for="department">Department <span class="required">*</span></label>
			<select id="department" name="department" required>
				<option disabled selected value="" class="optiondisabled">Select Department</option>
			</select>
		</div>

		<div class="arima-field">
			<label for="ay">Academic Year <span class="required">*</span></label>
			<select id="ay" name="ay" required>
				<option disabled selected value="" class="optiondisabled">Select</option>
			</select>
		</div>

		<div class="arima-field">
			<label for="sem">Semester <span class="required">*</span></label>
			<select id="sem" name="sem" required>
				<option value="" disabled selected>Select</option>
				<option value="1st Semester">1st Semester</option>
				<option value="2nd Semester">2nd Semester</option>
			</select>
		</div>

		<div class="arima-field arima-field--action">
			<button type="button" id="ForecastBtn" class="btn btn-adduser shadow-none" disabled>Forecast</button>
		</div>
	</div>

	<p class="arima-form-hint" id="arimaFormHint">Choose a college, department, academic year and semester to run a forecast.</p>
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

	<div class="grid-con-forecastdata-one shadow" id="arimaCharts" style="display: none;">
		<div>
			<canvas id="manpowerRequiredChartContainer"></canvas>
			<span class="forecastdata-arimamodel"> </span>
		</div>
		<div>
			<canvas id="manpowerRequiredChartContainer2"></canvas>
		</div>
	</div>

	<div class="arima-charts-empty shadow" id="arimaChartsEmpty">
		The charts appear here once you run a forecast.
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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

		var HINT_INCOMPLETE = "Choose a college, department, academic year and semester to run a forecast.";
		var HINT_READY = "Ready \u2014 click Forecast to run the model.";

		// The Forecast button stays disabled until all four selectors have a
		// value, so an incomplete selection is visible before the click rather
		// than answered with an alert afterwards.
		function refreshForecastAvailability() {
			var ready = ["#college", "#department", "#ay", "#sem"].every(function (selector) {
				return $(selector).val();
			});

			$("#ForecastBtn").prop("disabled", !ready);
			$("#arimaFormHint").text(ready ? HINT_READY : HINT_INCOMPLETE);

			return ready;
		}

		$("#college, #department, #ay, #sem").on("change", refreshForecastAvailability);
		refreshForecastAvailability();

		$("#ForecastBtn").click(function() {
			let selectedCollege = $("#college").val();
			let selectedDepartment = $("#department").val();
			let selectedAY = $("#ay").val();
			let selectedSem = $("#sem").val();

			if (chart1) { chart1.destroy() }
			if (chart2) { chart2.destroy() }

			if (!refreshForecastAvailability()) {
				return;
			}

			// The request runs a database query and a Node subprocess, so say
			// something is happening rather than leaving the page inert.
			$("#ForecastBtn").prop("disabled", true).text("Forecasting\u2026");
			$("#arimaFormHint").text("Computing the forecast\u2026");

			{
				$.ajax({
					type: 'GET',
					url: `/api/processing/forecastingdata/${selectedCollege}/${selectedDepartment}/${selectedAY}/${selectedSem}`,
					success: function(response) {
						console.log(response);

						// Reveal before drawing: Chart.js sizes the canvas from
						// its container, which is zero-sized while hidden.
						$("#arimaChartsEmpty").hide();
						$("#arimaCharts").show();

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
								labels: [selectedAY + ' \u2014 ' + selectedSem],
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
										beginAtZero: true,
										// A count of people has no fractional values.
										ticks: { precision: 0 }
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
										beginAtZero: true,
										// A count of people has no fractional values.
										ticks: { precision: 0 }
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
						$("#arimaFormHint").text("The forecast could not be loaded. Please try again.");
					},
					complete: function() {
						$("#ForecastBtn").text("Forecast");
						refreshForecastAvailability();
					}
				});
			}
		});
	});
</script>
