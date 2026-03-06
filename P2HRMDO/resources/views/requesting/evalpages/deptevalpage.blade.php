@extends('layouts.app')

@section('body')

    <!-- BACK TO DASHBOARD AND PRINT BUTTON -->
    <style>
    @media print {
        .navbar {
        display: block !important;
    }
        #exportButton,
        #aY,
        #dashh,
        #navname{
            display:none;
        }
        @page {
            size: auto; /* Set the default print orientation to 'auto' */
        }
    }
</style>
    <div class="grid-container-print-backtodashboard">
        <div class="grid-container" style="margin-top: 10px;">
            <a class="text-showmrform-backtodashboard" id="back" href="{{route('requestingdashboard.index')}}">Go back to Dashboard</a>
        </div>
        <div class="grid-container" style="margin-top: 10px;">
            <a href="#" id="printButton" class="mrform-print">
                <i class="material-icons">print</i> Print Document
            </a>
            <a href="#" id="exportButton" class="mrform-export">
                <i class="material-icons">cloud_download</i> Export to Excel
            </a>
        </div>
        <script>
            document.getElementById('printButton').addEventListener('click', function(event) {
                event.preventDefault(); // prevent the default link behavior
                window.print(); // trigger the browser's print function
            });

            document.getElementById('exportButton').addEventListener('click', function (event) {
                event.preventDefault();

                // Get the table data
                var table = document.getElementById('evalDepartmentDataReportContent');
                var sheetData = [['Faculty Member', 'A.Y', 'Semester', 'AWOL', 'Absences', 'Students', 'Peer', 'Dean', 'Chairperson', 'Contractual/Permanent', 'Full-Time/Part-Time', 'Over-all Status']];

                // Loop through rows and cells to collect data
                for (var i = 1; i < table.rows.length; i++) {
                    var rowData = [];
                    for (var j = 0; j < table.rows[i].cells.length; j++) {
                        rowData.push(table.rows[i].cells[j].innerText.trim());
                    }
                    sheetData.push(rowData);
                }

                // Create a new workbook and add the data
                var wb = XLSX.utils.book_new();
                var ws = XLSX.utils.aoa_to_sheet(sheetData);
                XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

                // Save the workbook as an Excel file
                XLSX.writeFile(wb, 'exported_department_data.xlsx');
            });
        </script>
    </div>

    <!--TEXT AT DROPDOWN AY -->
    <div class="grid-con-eval-results" href="">
        <div class="text-align-eval">
             
        </div>
        <div class="dropdown-ay-dept">
            <label for="ay" id="aY">Academic Year:</label>
            <!-- ACADEMIC YEAR WILL BE GENERATED BASED ON THE CURRENT YEAR -->
            <select id="ay1" name="ay1" style="width: 150px; height: 25px; border-color: #315EA0;" required>
                <option disabled selected value="" class="optiondisabled"></option>
            </select>
            <span id="dashh">-</span>
            <!-- ACADEMIC YEAR WILL BE GENERATED BASED ON THE CURRENT YEAR -->
            <select id="ay2" name="ay2" style="width: 150px; height: 25px; border-color: #315EA0;" required>
                <option disabled selected value="" class="optiondisabled"></option>
            </select>

            <button id="searchAyButton" type="button" class="btn btn-searchaybutton shadow-none" style="height: 25px; margin-top: -3px; margin-left: 10px;">Search</button>
        </div>
        
        <script>
            // Function to add academic year options
            function generateAcademicYearOptions() {
                // Get the current year
                var currentYear = new Date().getFullYear();
        
                // Set the range of years you want to display, e.g., from 2018 to currentYear
                var startYear = 2018;
                var endYear = currentYear;
        
                // Generate the academic year options dynamically for both dropdowns
                var selectElement1 = document.getElementById("ay1");
                var selectElement2 = document.getElementById("ay2");
        
                for (var year = startYear; year <= endYear; year++) {
                    var academicYear = year + "-" + (year + 1);
                    var option1 = document.createElement("option");
                    option1.value = academicYear;
                    option1.textContent = academicYear;
                    selectElement1.appendChild(option1);
                }
        
                // Clone the options for the second dropdown
                var options2 = selectElement1.innerHTML;
                selectElement2.innerHTML = options2;
            }
        
            // Call the function to initially generate academic year options
            generateAcademicYearOptions();
        
            // Event listener for the first dropdown
            var selectElement1 = document.getElementById("ay1");
            var selectElement2 = document.getElementById("ay2");
        
            selectElement1.addEventListener("change", function () {
                // Get the selected academic year
                var selectedYear1 = selectElement1.value;
        
                // Clear the second dropdown
                selectElement2.innerHTML = "";
        
                // Re-generate the academic year options for the second dropdown
                for (var year = 2018; year <= new Date().getFullYear(); year++) {
                    var academicYear = year + "-" + (year + 1);
                    var option2 = document.createElement("option");
                    option2.value = academicYear;
                    option2.textContent = academicYear;
                    selectElement2.appendChild(option2);
                }
        
                // Remove options in the second dropdown that are less than the selected year
                for (var i = selectElement2.options.length - 1; i >= 0; i--) {
                    if (selectElement2.options[i].value < selectedYear1) {
                        selectElement2.remove(i);
                    }
                }
            });
        
            // Check for a new year and add a new option if it's a new year
            var currentYear = new Date().getFullYear();
        
            setInterval(function () {
                var newYear = new Date().getFullYear();
                if (newYear > currentYear) {
                    currentYear = newYear;
                    var academicYear = currentYear + "-" + (currentYear + 1);
        
                    // Add the new option to both dropdowns
                    var option1 = document.createElement("option");
                    option1.value = academicYear;
                    option1.textContent = academicYear;
                    selectElement1.appendChild(option1);
        
                    var option2 = document.createElement("option");
                    option2.value = academicYear;
                    option2.textContent = academicYear;
                    selectElement2.appendChild(option2);
                }
            }, 1000 * 60 * 60 * 24); // Check once a day (adjust as needed)
        </script>                
    </div>

    <div class="grid-con-eval-sec shadow">
        
        <div class="text-align-eval-dept">
            <img src="{{url('/images/adulogoblue.png')}}" class="depevalprint">
            <a class=h4-dept> Faculty Evaluation Data Report </a>
        </div>
        <div class="text-align-eval-dept">
            <a class=h3-dept>{{ $loggedInUser->department }}</a>
            <a class=h6-dept>A.Y: <span id="ay1-selected1"> </span> to <span id="ay2-selected1"> </span></a>
        </div>

        <!--SCRIPT NG CHANGE AY-->
        <script>
            // Using JavaScript
            var selectElement = document.getElementById('ay1');
            var thElement = document.getElementById('ay1-selected1');
            selectElement.addEventListener('change', function() {
                thElement.innerHTML = selectElement.value;
            });
            
            // Using jQuery
            $('#ay1').on('change', function() {
                $('#ay1-selected1').html('<b>' + $(this).val());
            });

            // Using JavaScript
            var selectElement = document.getElementById('ay1');
            var thElement = document.getElementById('ay1-selected2');
            selectElement.addEventListener('change', function() {
                thElement.innerHTML = selectElement.value;
            });
            
            // Using jQuery
            $('#ay1').on('change', function() {
                $('#ay1-selected2').html('<b>' + $(this).val());
            });

            // Using JavaScript
            var selectElement = document.getElementById('ay2');
            var thElement = document.getElementById('ay2-selected1');
            selectElement.addEventListener('change', function() {
                thElement.innerHTML = selectElement.value;
            });
            
            // Using jQuery
            $('#ay2').on('change', function() {
                $('#ay2-selected1').html('<b>' + $(this).val());
            });
        </script>

        <table class="searchevaldatareport-table-status">
            <tr>
                <td class="box-status-red"colspan="2"></td>
                <td class="text-status-red" colspan="4">Not Suitable for Rehirement (0%-49%)</td>
                <td class="box-status-green" colspan="2"></td>
                <td class="text-status-green" colspan="4">Suitable for Rehirement (50%-100%)</td>
                <td class="box-status-yellow"colspan="2"></td>
                <td class="text-status-yellow" colspan="4">Subject for deliberation</td>
            </tr>
        </table>

        <!--TABLE EVAL DATA RESULTS-->
        <div> 
            <table class="table">
                <thead class="thead-eval-sec">
                    <th scope="col" colspan="12" style="border-color: black; border-bottom-width: 1px; font-size: 15px;"></th>                    
                </thead>
                <tbody id="evalDepartmentDataReportContent">
                    <tr>
                        <td rowspan="2">Faculty Member</td>
                        <td rowspan="2">A.Y</td>
                        <td rowspan="2">Semester</td>
                        <td colspan="2">Performances</td>
                        <td colspan="4">Evaluations</td>
                        <td colspan="2">Employment Status</td>
                        <td rowspan="2">Over-all Status</td>
                    </tr>
                    <tr>
                        <td >AWOL</td>
                        <td>Absences</td>
                        <td class="evalpage-tbi">Students</td>
                        <td class="evalpage-tbi">Peer</td>
                        <td class="evalpage-tbi">Dean</td>
                        <td class="evalpage-tbi">Chairperson</td>
                        <td class="evalpage-empstatus">Contractual/Permanent</td>
                        <td class="evalpage-empstatus">Full-Time/Part-Time</td>
                    </tr>
                    {{-- <tr>
                        <td></td>
			            <td></td>
                        <td class="text-size"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td> 
                        <td></td>                     
                    </tr> --}}
                </tbody>
            </table>
            <br>
        </div>
        <br>
    </div>
</div>

<script>
    $(document).ready(function() {
        // var professorId = null;
        // $(".selected-professor").click(function() {
        //     professorId = $(this).attr("professor-id");
        // });

        $("#searchAyButton").click(function() {
            var ay1 = $("#ay1").val();
            var ay2 = $("#ay2").val();

            // console.log(professorId);
            console.log(ay1);
            console.log(ay2);

            var department = '{{ $department }}';
            
            if (department && ay1 && ay2) {
                $.ajax({
                    type: 'GET',
                    url: '/api/evaluation/department/datareport/' + department + '/' + ay1 + '/' + ay2,
                    success: function(response) {
                        console.log(response);
                        $("#evalDepartmentDataReportContent").html(`
                        <tr>
                            <td rowspan="2">Faculty Member</td>
                            <td rowspan="2">A.Y</td>
                            <td rowspan="2">Semester</td>
                            <td colspan="2">Performances</td>
                            <td colspan="4">Evaluations</td>
                            <td colspan="2">Employment Status</td>
                            <td rowspan="2">Over-all Status</td>
                        </tr>
                        <tr>
                            <td >AWOL</td>
                            <td>Absences</td>
                            <td class="evalpage-tbi">Students</td>
                            <td class="evalpage-tbi">Peer</td>
                            <td class="evalpage-tbi">Dean</td>
                            <td class="evalpage-tbi">Chairperson</td>
                            <td class="evalpage-empstatus">Contractual/Permanent</td>
                            <td class="evalpage-empstatus">Full-Time/Part-Time</td>
                        </tr>
                        `);
                        if (response.length <= 0) {
                            alert("No data.");
                        }

                        response.map(eval => {
                            let statusClass = '';
                            let backgroundColor = ''; 

                            const overallStatusValue = parseFloat(eval.overallstatus.replace('%', ''));

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
                            row.append(`<td class="text-size"><h3 id="eval-employee_name" style="font-size: 16px; margin-top: 5px;">${eval.employee_name}</h3></td>`);
                            row.append(`<td class="text-size"><h3 id="eval-ay" style="font-size: 16px; margin-top: 5px;">${eval.ay}</h3></td>`);
                            row.append(`<td class="text-size"><h3 id="eval-semester" style="font-size: 16px; margin-top: 5px;">${eval.semester}</h3></td>`);
                            row.append(`<td><h3 id="eval-awolna" style="font-size: 16px; margin-top: 5px;">${eval.awolna}</h3></td>`);
                            row.append(`<td><h3 id="eval-absences" style="font-size: 16px; margin-top: 5px;">${eval.absences}</h3></td>`);
                            row.append(`<td><h3 id="eval-student" style="font-size: 16px; margin-top: 5px;">${eval.student}</h3></td>`);
                            row.append(`<td><h3 id="eval-pear" style="font-size: 16px; margin-top: 5px;">${eval.peer}</h3></td>`);
                            row.append(`<td><h3 id="eval-dean" style="font-size: 16px; margin-top: 5px;">${eval.dean}</h3></td>`);
                            row.append(`<td><h3 id="eval-chairperson" style="font-size: 16px; margin-top: 5px;">${eval.chairperson}</h3></td>`);
                            row.append(`<td colspan="2"><h3 id="eval-empstatus" style="font-size: 16px; margin-top: 5px;">${eval.empstatus}</h3></td>`);

                            // Create the "Over-all Status" cell and set the background color
                            let statusCell = $("<td>");
                            statusCell.addClass(`eval-overallstatus ${statusClass}`);
                            statusCell.css("background-color", backgroundColor); 
                            statusCell.append(`<h3 id="eval-overallstatus" style="font-size: 16px; margin-top: 5px;">${eval.overallstatus}</h3>`);
                            row.append(statusCell);

                            // Append the row to the table
                            $("#evalDepartmentDataReportContent").append(row);
                        });
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

@endsection