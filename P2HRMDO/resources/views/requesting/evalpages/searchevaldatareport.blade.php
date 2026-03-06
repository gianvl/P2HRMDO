@extends('layouts.app')

@section('body')

    <!-- BACK TO DASHBOARD AND PRINT BUTTON -->
    <style>
    @media print {
        .navbar{
            display: block !important;
        }
        
        #exportButton{
            display:none !important;
           
        }
        @page {
            size: auto; /* Set the default print orientation to 'auto' */
        }
    }
</style>
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
                var table = document.getElementById('evalDataReportContent');
                var sheetData = [['A.Y', 'Semester', 'AWOL', 'Absences', 'Students', 'Peer', 'Dean', 'Chairperson', 'Contractual/Permanent', 'Full-Time/Part-Time', 'Over-all Status']];

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
                XLSX.writeFile(wb, 'exported_data.xlsx');
            });
        </script>
    </div>


    <div class="grid-container-select-faculty">
        <div class="grid-con-colleges shadow" href="">
            <!--DROPDOWN SELECT PROFESSOR -->
            <div class="dropdown">
                <div class="dropdown-header" onclick="toggleDropdown(event)">
                    <div class="img">
                        <img src="{{ url('/images/profilepic.png') }}" id="prof-image" class="rounded-circle" width="50px" height="50px">
                    </div>
                    <div class="header-text">
                        <p class="text-head1">Select Professor</p>
                        <p class="text-secondline1">Bachelor's Degree</p>
                        <p class="text-thirdline1">Employee Number</p>
                    </div>
                </div>
                <div class="dropdown-icon-default" id="dropdown-icon"></div>
                <div class="dropdown-content" id="dropdown-content">
                    @foreach($professors as $professor)
                        <a href="#" class="selected-professor" professor-id="{{ $professor->id }}">
                            <img src="{{ url('/storage/images/' . $professor->image) }}" class="prof-image rounded-circle" width="50px" height="50px" data-image="{{ $professor->image }}" style="margin-left: 3.5%;">
                            <div class="dropdown-text">
                                <p class="text-head" id="prof-name-{{ $professor->id }}">{{ $professor->first_name }} {{ $professor->last_name }}</p>
                                <p class="text-secondline" id="prof-spec-{{ $professor->id }}">{{ $professor->specialization }}</p>
                                <p class="text-thirdline" id="prof-emp-no-{{ $professor->id }}">{{ $professor->emp_no }}</p>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>

        <!--BASTA UNG KATABI NG DROPDOWN SELECT PROF -->
        <div class="grid-con-colleges shadow" href="">
            <div class="grid-con-colleges-second">
                <div class="text-align-dept-eval-report" style="margin-top: 5px;">
                    <p><a class="btn btn-dept-eval-report shadow-none" id="btn-eval" href="{{ route('deptevaldatareport.index') }}">Department Evaluation Report</a></p>
                </div>
                <div class="text-align-it">
                <h4 style="margin-left: 25%;"><b>{{ $loggedInUser->college }}</b></h4>
                <h6 style="margin-left: -500%;">{{ $loggedInUser->department }}</h6>
                </div>
                <div class="img-it-logo"> 
                    @if ($loggedInUser->college == 'College of Science')
                        <img src="{{ url('/images/COS.png') }}" class="rounded-circle" width="65px" height="65px">
                    @elseif ($loggedInUser->college == 'College of Business Administration')
                        <img src="{{ url('/images/CBA.png') }}" class="rounded-circle" width="65px" height="65px">
                    @elseif ($loggedInUser->college == 'College of Education and Liberal Arts')
                        <img src="{{ url('/images/CELA.png') }}" class="rounded-circle" width="65px" height="65px">
                    @elseif ($loggedInUser->college == 'College of Engineering')
                        <img src="{{ url('/images/COE.png') }}" class="rounded-circle" width="65px" height="65px">
                    @elseif ($loggedInUser->college == 'College of Nursing')
                        <img src="{{ url('/images/CONURSING.png') }}" class="rounded-circle" width="65px" height="65px">
                    @elseif ($loggedInUser->college == 'College of Pharmacy')
                        <img src="{{ url('/images/COP.png') }}" class="rounded-circle" width="65px" height="65px">
                    @elseif ($loggedInUser->college == 'College of Architecture')
                        <img src="{{ url('/images/COA.png') }}" class="rounded-circle" width="65px" height="65px">
                    @endif
                </div>    
            </div>
        </div>
    </div>

    <div class="grid-con-eval-sec shadow">
        <!--TEXT AT DROPDOWN AY -->
        <div class="grid-con-search-eval-results" href="">
            <div class="text-align-eval">
               Evaluation Results
            </div>
                   
            <div class="eval-dropdown-container">
                <label for="ay1" id="aY" style="margin-top: 2px">Academic Year:</label>
                <!-- ACADEMIC YEAR WILL BE GENERATED BASED ON THE CURRENT YEAR -->
                <select id="ay1" name="ay1" style="width: 200px; height: 25px; border-color: #315EA0;" required>
                    <option disabled selected value="" class="optiondisabled"></option>
                </select>
                <span id="dashh">-</span>
                <!-- ACADEMIC YEAR WILL BE GENERATED BASED ON THE CURRENT YEAR -->
                <select id="ay2" name="ay2" style="width: 200px; height: 25px; border-color: #315EA0;" required>
                    <option disabled selected value="" class="optiondisabled"></option>
                </select>

                <button id="searchAyButton" type="button" class="btn btn-searchaybutton shadow-none">Search</button>
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

        <!--SUITABLE/NOT SUITABLE FPR REHIREMENT -->
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

        <!--SCRIPT NG CHANGE AY-->
        <script>
            // Using JavaScript
            var selectElement = document.getElementById('ay1');
            var thElement = document.getElementById('ay1-selected');
            selectElement.addEventListener('change', function() {
              thElement.innerHTML = selectElement.value;
            });
          
            // Using jQuery
            $('#ay1').on('change', function() {
              $('#ay1-selected').html('<b>' + $(this).val());
            });
        </script>

        <!--TABLE EVAL DATA RESULTS-->
        <div>
            <table class="table">
                <thead class="thead-eval-sec">
                    <th scope="col" colspan="11" style="border-color: black; border-bottom-width: 1px; font-size: 15px;"></th>
                </thead>
                <tbody id="evalDataReportContent">
                    <tr>
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
                    <!--
                    <tr>
                        <td rowspan="2" class="text-size"><h3 id="eval-ay" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td class="text-size"><h3 id="eval-semester" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td><h3 id="eval-awolna" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td><h3 id="eval-absences" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td><h3 id="eval-student" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td><h3 id="eval-pear" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td><h3 id="eval-dean" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td><h3 id="eval-chairperson" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td colspan="2"><h3 id="eval-empstatus" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td rowspan="2"><h3 id="eval-overallstatus" style="font-size: 16px; margin-top: 5px;"></h3></td>                  
                    </tr>
                    <tr>
                        <td class="text-size"><h3 id="eval-semester" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td><h3 id="eval-awolna" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td><h3 id="eval-absences" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td><h3 id="eval-student" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td><h3 id="eval-pear" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td><h3 id="eval-dean" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td><h3 id="eval-chairperson" style="font-size: 16px; margin-top: 5px;"></h3></td>
                        <td colspan="2"><h3 id="eval-empstatus" style="font-size: 16px; margin-top: 5px;"></h3></td>
                    </tr>
                    -->
                </tbody>
            </table> <br>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var professorId = null;
        $(".selected-professor").click(function() {
            professorId = $(this).attr("professor-id");
            console.log(professorId);
            var imageSrc = $(this).find('.prof-image').data('image');
            $("#prof-image").attr("src", `/storage/images/${imageSrc}`);
        });

        $("#searchAyButton").click(function() {
            var ay1 = $("#ay1").val();
            var ay2 = $("#ay2").val();

            console.log(professorId);
            console.log(ay1);
            console.log(ay2);
            
            if (professorId && ay1 && ay2) {
                $.ajax({
                    type: 'GET',
                    url: '/api/evaluation/datareport/' + professorId + '/' + ay1 + '/' + ay2,
                    success: function(response) {
                        console.log(response);
                        $("#evalDataReportContent").html(`
                            <tr>
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
                            alert("No data found for the selected Academic Year.");
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
                            row.append(`<td class="text-size"><h3 id="eval-ay" style="font-size: 16px; margin-top: 5px;">${eval.ay}</h3></td>`);
                            row.append(`<td class="text-size"><h3 id="eval-semester" style="font-size: 16px; margin-top: 5px;">${eval.semester}</h3></td>`);
                            row.append(`<td><h3 id="eval-awolna" style="font-size: 16px; margin-top: 5px;">${eval.awolna}</h3></td>`);
                            row.append(`<td><h3 id="eval-absences" style="font-size: 16px; margin-top: 5px;">${eval.absences}</h3></td>`);
                            row.append(`<td><h3 id="eval-student" style="font-size: 16px; margin-top: 5px;">${eval.student}</h3></td>`);
                            row.append(`<td><h3 id="eval-pear" style="font-size: 16px; margin-top: 5px;">${eval.peer}</h3></td>`);
                            row.append(`<td><h3 id="eval-dean" style="font-size: 16px; margin-top: 5px;">${eval.dean}</h3></td>`);
                            row.append(`<td><h3 id="eval-chairperson" style="font-size: 16px; margin-top: 5px;">${eval.chairperson}</h3></td>`);
                            row.append(`<td colspan="2"><h3 id="eval-empstatus" style="font-size: 16px; margin-top: 5px;">${eval.empstatus}</h3></td>`);

                            // Create the "Over-all Status" cell and add the appropriate class
                            let statusCell = $("<td>");
                            statusCell.addClass(`eval-overallstatus ${statusClass}`);
                            statusCell.css("background-color", backgroundColor); 
                            statusCell.append(`<h3 id="eval-overallstatus" style="font-size: 16px; margin-top: 5px;">${eval.overallstatus}</h3>`);
                            row.append(statusCell);

                            // Append the row to the table
                            $("#evalDataReportContent").append(row);
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

<!-- SCRIPT NG DROPDOWN EMPLOYEE -->
<script>
    function toggleDropdown(event) {
        var dropdownContent = document.getElementById("dropdown-content");
        var defaultOptionText = document.querySelector('.text-head1');
        var defaultOptionSecondLine = document.querySelector('.text-secondline1');
        var defaultOptionThirdLine = document.querySelector('.text-thirdline1');
        var defaultOptionImg = document.querySelector('.img img');
        
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
            dropdownContent.querySelectorAll('a').forEach(function(option) {
            option.addEventListener('click', function() {
                var optionText = option.querySelector('.text-head').innerHTML;
                var optionSecondLine = option.querySelector('.text-secondline').innerHTML;
                var optionThirdLine = option.querySelector('.text-thirdline').innerHTML;
                var optionImgSrc = option.querySelector('img').src;
                
                defaultOptionText.innerHTML = optionText;
                defaultOptionSecondLine.innerHTML = optionSecondLine;
                defaultOptionThirdLine.innerHTML = optionThirdLine;
                defaultOptionImg.src = optionImgSrc;

                defaultOptionText.style.marginTop = "-55px";
                defaultOptionText.style.marginLeft = "90px";
                defaultOptionSecondLine.style.marginTop = "-20px";
                defaultOptionSecondLine.style.marginLeft = "90px";
                defaultOptionThirdLine.style.marginTop = "-20px";
                defaultOptionThirdLine.style.marginLeft = "90px";
                defaultOptionImg.style.marginTop = "-18px";
                defaultOptionImg.style.marginLeft = "-18px";

            });
            });
        }
        event.stopPropagation();
    }

    window.onclick = function(event) {
    var dropdownContent = document.getElementById("dropdown-content");
    if (event.target.matches('.dropdown-icon-default')) {
        toggleDropdown(event);
    } else if (!event.target.matches('.dropdown-text-default')) {
        if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
        }
    }
}
</script>

<!-- SCRIPT NG FETCH EMPLOYEE -->    
<script>
    function redirectToPage() {
        var selectedEmployeeId = $('#dropwdown-professor').val();
        window.location.href = '/editperformanceEvaluation/save/{id}' + selectedEmployeeId ;
    }
</script>

<script>
    $(document).ready(function() {
        // $.ajax({
        //     type: 'GET',
        //     url: '/api/professor/' + $('#dropwdown-professor').val(),
        //     success: function(response) {
        //         console.log(response);
        //         console.log('Image URL:', `/storage/images/${response.image}`);
        //         $("#prof-image").attr("src", `/storage/images/${response.image}`);
        //         $("#prof-name").html(` ${response.first_name} ${response.last_name}`);
        //         $("#prof-spec").html(response.specialization)
        //         $("#prof-emp-no").html(response.emp_no)
        //         $("#prof-emp-status").html(response.employment_status)
        //     },
        //     error: function(err) {
        //         console.log(err);
        //     }
        // });

        // $('#dropwdown-professor').change(function () {
        //     $.ajax({
        //         type: 'GET',
        //         url: '/api/professor/' + $('#dropwdown-professor').val(),
        //         success: function(response) {
        //             console.log(response);
        //             $("#prof-image").attr("src", `/storage/images/${response.image}`);
        //             $("#prof-name").html(` ${response.first_name} ${response.last_name}`);
        //             $("#prof-spec").html(response.specialization)
        //             $("#prof-emp-no").html(response.emp_no)
        //             $("#prof-emp-status").html(response.employment_status)
        //         },
        //         error: function(err) {
        //             console.log(err);
        //         }
        //     });
        // })
    });

    function redirectToPage() {
        var selectedOptionValue = $('#dropwdown-professor').val();
        window.location.href = '/another-page?selected_option=' + selectedOptionValue;
    }
</script>

@endsection