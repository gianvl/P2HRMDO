<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="{{url('/images/ADULOGO.png')}}">  
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>HRMDO Manpower Requisition and Forecasting System</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<link rel="stylesheet" href="{{ URL::asset('css/navbar.css') }}"/>
<link rel="stylesheet" href="{{ URL::asset('css/req_mainpage.css') }}"/>
<link rel="stylesheet" href="{{ URL::asset('css/req_mrform.css') }}"/>
<link rel="stylesheet" href="{{ URL::asset('css/req_mforecastform.css') }}"/>
<link rel="stylesheet" href="{{ URL::asset('css/req_inputevalpage.css') }}"/>
<link rel="stylesheet" href="{{ URL::asset('css/req_saveevalpage.css') }}"/>
<link rel="stylesheet" href="{{ URL::asset('css/req_searchevaldatareport.css') }}"/>
<link rel="stylesheet" href="{{ URL::asset('css/req_printevaldatareport.css') }}"/>
<link rel="stylesheet" href="{{ URL::asset('css/app_mainpage.css') }}"/>

</head>
<body>
    <nav class="navbar navbar-header d-print">
        <div font-style="#395583">
            <div class="adulogo">
                <img src="{{ url('/images/adulogowhite.png') }}" class="img-fluid">
            </div>
            <ul class="navbar-nav navbar-profile d-print">
                <div class="nav-item dropdown">
                    {{-- <b class="caret"></b>
                    <span class="badge badge-danger" style="font-size: 15px; padding: 8px 10px; margin-right: 5px;">
                        <i class="fa fa-bell"></i> <!-- Notification icon -->
                        {{ auth()->user()->unreadNotifications->count() }} <!-- Notification count -->
                    </span> --}}
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">
                        {{ $loggedInUser->name }}<img src="{{ asset('storage/images/' . $loggedInUser->image) }}"  class="avatar" alt="Avatar" style="margin-left:10px; color:azure">
                    </a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item"><i class="fa fa-user-o"></i>Profile</a>
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-logout dropdown-item"><i class="fa fa-user-o"></i>Logout</button>
                        </form>
                    </div>
                </div>
            </ul>
        </div>
    </nav>
    
    <script>
        $(document).ready(function() {
            // Handle click event on the notification badge
            $('.dropdown-toggle.user-action').on('click', function() {
                // Show the dropdown menu
                $(this).siblings('.dropdown-menu').toggle();
            });
        });
    </script>
    
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

    <!-- BACK TO DASHBOARD AND PRINT DOCUMENT -->
    <style>
    @media print {
        .navbar{
            display:block !important;
        }
        #navname
        {
            display:none;
        }
        @page {
            size: auto; /* Set the default print orientation to 'auto' */
        }
    }
</style>

<div class="grid-container-print-backtodashboard">
    <div class="grid-container" style="margin-top: 10px;">
        <a class="text-showmrform-backtodashboard" id="back" href="{{route('forecast.index')}}">Go back to Dashboard</a>
    </div>
    <div class="grid-container" style="margin-top: 10px;">
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

    <form id="forecastForm" action="{{ route('forecast.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- TITLE FORM -->
        <div class="mforecastform-grid-container shadow">
            <div class="mforecastform-grid-con-title">
                <div class="mforecastform-text-title">
                    Form    
                </div>
            </div>
        </div>
        <!-- MAIN CONTENT -->    
        <div class="dark-grey-background shadow">
            <input type="number" class="dropdownbox-num_id" for="forecast_num_id" readonly name="forecast_num_id">
            <h1><b> <br> <br>Manpower Forecast Form <br><br></b></h1> 
            
            <!--DROPDOWN DEPARTMENT-->
            <div class="dropdownsection">
                <table class="table-fmanpower-form">
                    <tbody>
                        <tr> <!--PAG CLICK COLLEGE DEPENDS YUNG LAMAN NG DEPARTMENT-->
                            <td class="dropsec-title"> College:</td>
                            <td class="dropsec-contents-colleges"> 
                                <div  id="college" name="college">
                                @if ($positionFormMapping)
                                    {{ $positionFormMapping->college }}
                                    {!! $positionFormMapping->forms_college_column !!}
                                @endif
                                </div>
                            </td>
                            <td class="dropsec-title1"> Department:</td>
                            <td class="dropsec-contents-dep"> 
                                <div id="department" name="department">
                                    @if ($loggedInUserPosition === 'Chairperson')
                                        @if ($positionFormMapping)
                                            {{ $positionFormMapping->department }}
                                            {!! $positionFormMapping->forms_department_column !!}
                                        @endif
                                    @else
                                        @if ($positionFormMapping)
                                            {!! $positionFormMapping->forms_department_column !!}
                                        @endif
                                    @endif
                                </div>
                            </td>


                            <td class="dropsec-title2"> Academic Year:</td>
                            <td class="dropsec-contents-ay"> 
                                <select class="dropwdown-select" id="ay" name="ay" style="height: 25px; width: 100%" required>
                                    <option disabled selected value="" class="optiondisabled"></option>
                                </select>
                            </td>

                            <script>
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

                                // Check for a new year and add a new option if it's a new year
                                var currentYear = new Date().getFullYear();
                                var selectElement = document.getElementById("ay");

                                setInterval(function () {
                                    var newYear = new Date().getFullYear();
                                    if (newYear > currentYear) {
                                        currentYear = newYear;
                                        var academicYear = currentYear + "-" + (currentYear + 1);
                                        var option = document.createElement("option");
                                        option.value = academicYear;
                                        option.textContent = academicYear;
                                        selectElement.appendChild(option);
                                    }
                                }, 1000 * 60 * 60 * 24); // Check once a day (adjust as needed)
                            </script>

                            <td class="dropsec-title4"> Semester:</td>
                            <td class="dropsec-contents-sem">
                                <select class="dropwdown-select-sem" id="semester" name="semester" style="width: 100%;" required>
                                    <option disabled selected value="" class="optiondisabled"></option>
                                    <option value="1st Semester">1st Semester</option>
                                    <option value="2nd Semester">2nd Semester</option>
                                </select>
                            </td>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    // Get references to the select element and target td elements
                                    const semesterSelect = document.getElementById("semester");
                                    const selectedAy1st = document.getElementById("selectedAy1st");
                                    const selectedAy2nd = document.getElementById("selectedAy2nd");
                                    const aydropdown1SemesterInput = document.getElementById("aydropdown1SemesterInput");
                                    const aydropdown2SemesterInput = document.getElementById("aydropdown2SemesterInput");

                                    const tdElementIds = ["td1", "td2", "td3", "td4", "td5", "td6"]; 

                                    // Add an event listener to the select element
                                    semesterSelect.addEventListener("change", updateAcademicYear);

                                    // Add an event listener to the academic year select element
                                    const academicYearSelect = document.getElementById("ay");
                                    academicYearSelect.addEventListener("change", function () {
                                        // Clear the semester selection
                                        semesterSelect.selectedIndex = 0;
                                        updateAcademicYear();
                                    });

                                    // Function to update the content of the target td elements
                                    function updateAcademicYear() {
                                        const selectedOption = semesterSelect.value;
                                        const selectedAcademicYear = document.getElementById("ay").value;
                                        const academicYearParts = selectedAcademicYear.split('-');
                                        const startYear = parseInt(academicYearParts[0]);
                                        const endYear = parseInt(academicYearParts[1]);
                                        

                                        if (selectedOption === "1st Semester") {
                                            selectedAy1st.textContent = selectedAcademicYear;
                                            selectedAy2nd.textContent = (startYear - 1) + "-" + startYear;
                                        } else if (selectedOption === "2nd Semester") {
                                            selectedAy1st.textContent = selectedAcademicYear;
                                            selectedAy2nd.textContent = selectedAcademicYear;
                                        }

                                        // Loop through the td elements and set their content and input values
                                        for (const tdId of tdElementIds) {
                                            const tdElement = document.getElementById(tdId);
                                            if (tdElement) {
                                                if (tdId === "td1") {
                                                    tdElement.textContent = selectedAy1st.textContent;
                                                } else if (tdId === "td2") {
                                                    tdElement.textContent = selectedAy2nd.textContent;
                                                } else if (tdId === "td3") {
                                                    tdElement.textContent = selectedAy1st.textContent;
                                                } else if (tdId === "td4") {
                                                    tdElement.textContent = selectedAy2nd.textContent;
                                                } else if (tdId === "td5") {
                                                    tdElement.textContent = selectedAy1st.textContent;
                                                } else if (tdId === "td6") {
                                                    tdElement.textContent = selectedAy2nd.textContent;
                                                }
                                            }
                                        }

                                        aydropdown1SemesterInput.value = selectedAy1st.textContent;
                                        aydropdown2SemesterInput.value = selectedAy2nd.textContent;
                                    }

                                    // Initialize with the default academic year
                                    updateAcademicYear();
                                });
                            </script>
                        </tr>
                    </tbody>
                </table>
            </div>
                    
            <!--EXISTING MANPOWER COMPLEMENT-->
            <div class="light-grey-existingmanpower shadow">
                <h2><b> <br> Existing Manpower Complement</b></h2>
                <table class="forecasting-EMC">
                    <tbody>
                        <tr>
                            <td class="emc-titlecol">No. of Full-time Permanent:</td>
                            <td class="emc-inputtxt"><input type="number" class="txtboxemc" min="0" id="Fulltimeperm" name="fulltimeperm" required value="{{ $employeeCountByEmployeeStatusArr['Permanent Full-time'] ?? 0 }}" readonly></td>
                            <td class="emc-titlecol">No. of Part-time Permanent:</td>
                            <td class="emc-inputtxt"><input type="number" class="txtboxemc"  min="0" id="Parttimeperm" name="parttimeperm" required value="{{ $employeeCountByEmployeeStatusArr['Permanent Part-time'] ?? 0 }}" readonly></td>
                            <td class="emc-total"><button class="totalbtn" name="totalbutton" disabled ><b>Total</b></button></td>
                            <td class="emc-inputtxt"><input type="text"  min="0" id="TotalPerm" readonly value="{{ intval($employeeCountByEmployeeStatusArr['Permanent Part-time'] ?? 0) + intval($employeeCountByEmployeeStatusArr['Permanent Full-time'] ?? 0) }}" readonly></td>
                        </tr>
                        <tr>
                            <td class="emc-titlecol">No. of Full-time Contractual:</td>
                            <td class="emc-inputtxt"><input type="number" class="txtboxemc"  min="0" id="Fulltimecontrac" name="fulltimecontrac" required value="{{ $employeeCountByEmployeeStatusArr['Contractual Full-time'] ?? 0 }}" readonly></td>
                            <td class="emc-titlecol">No. of Part-time Contractual:</td>
                            <td class="emc-inputtxt"><input type="number" class="txtboxemc" min="0" id="Parttimecontrac" name="parttimecontrac" required value="{{ $employeeCountByEmployeeStatusArr['Contractual Part-time'] ?? 0 }}" readonly></td>
                            <td class="emc-total"><button class="totalbtn" name="totalbutton"disabled ><b>Total</b></button></td>
                            <td class="emc-inputtxt"><input type="text" min="0" id="TotalCon" readonly value="{{ intval($employeeCountByEmployeeStatusArr['Contractual Full-time'] ?? 0) + intval($employeeCountByEmployeeStatusArr['Contractual Part-time'] ?? 0) }}" readonly></td>
                        </tr>
                    </tbody>
                </table> <br>
            </div>

            <!--Existing Manpower Complement-->
            <script>
                var FulltimepermInput = document.getElementById("Fulltimeperm");
                var ParttimepermInput = document.getElementById("Parttimeperm");
                var FulltimecontracInput = document.getElementById("Fulltimecontrac");
                var ParttimecontracInput = document.getElementById("Parttimecontrac");
                var totalPermInput = document.getElementById("TotalPerm");
                var totalConInput = document.getElementById("TotalCon");
            
                var calculateTotalPerm = function() {
                    var FulltimepermValue = parseFloat(FulltimepermInput.value) || 0;
                    var ParttimepermValue = parseFloat(ParttimepermInput.value) || 0;

                    var total = FulltimepermValue + ParttimepermValue;
                    totalPermInput.value = total;
                };

                var calculateTotalCon = function() {
                    var FulltimecontracValue = parseFloat(FulltimecontracInput.value) || 0;
                    var ParttimecontracValue = parseFloat(ParttimecontracInput.value) || 0;
            
                    var total = FulltimecontracValue + ParttimecontracValue;
                    totalConInput.value = total;
                };
            
                FulltimepermInput.addEventListener("input", calculateTotalPerm);
                ParttimepermInput.addEventListener("input", calculateTotalPerm);
                FulltimecontracInput.addEventListener("input", calculateTotalCon);
                ParttimecontracInput.addEventListener("input", calculateTotalCon);
            </script>

            <!--ADD BUTTON!! -->
            <div class="light-grey-facultymembers shadow">
                <div class="grid-con-facultymembers">
                    <br>
                    <table class="tablefr-overall-status">
                        <tbody>
                            <tr>
                                <td class="text-con-fr-first-section">
                                    <div>
                                        Name of Faculty Members to be Replaced :
                                    </div>
                                </td>
                                <td class="text-con-fr-second-section">
                                    <div>
                                        Reason for Replacement :
                                    </div>
                                </td>
                                <td class="text-con-fr-third-section">
                                    <div>
                                        Reason for Hiring Additional Faculty Members :
                                    </div>
                                </td>
                                <td class="action-buttons">
                                    <button class="addmem" name="namefacreplacebtn">Add Member</button>
                                </td>
                            </tr>
                            <tr class="original-row">
                                {{-- <td>
                                    <select name="namefacreplace[]" class="namefacreplace" required>
                                        <option disabled selected value="" class="optiondisabled">Select</option>
                                        @foreach($professors as $professor) 
                                            <option value="{{ $professor->first_name }} {{ $professor->last_name }} | {{ $professor->employment_status }}">{{ $professor->first_name }} {{ $professor->last_name }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                </td>
                                <td>
                                    <select name="reasonreplace[]" class="reasonreplace" required>
                                        <option disabled selected value="">Select</option>
                                        <option value="Transfer">Transfer</option>
                                        <option value="Resigned">Resigned</option>
                                        <option value="Promotion">Promotion</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <br>
                                </td>
                                <td>
                                    <input class="reasonforhiring" name="reasonforhiring[]" required type="text" placeholder="Type 'N/A' if not applicable.">
                                </td> --}}
                            </tr>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    var totalAdditionalEmployee = {
                        "PermanentFulltime": 0,
                        "PermanentParttime": 0,
                        "ContractualFulltime": 0,
                        "ContractualParttime": 0
                    };
                    var listOfSelectedEmployee = [];
                    var listOfSelectedEmployeeNames = [];
                    function updateTotalAdditionalEmployee() {
                        totalAdditionalEmployee = {
                            "PermanentFulltime": 0,
                            "PermanentParttime": 0,
                            "ContractualFulltime": 0,
                            "ContractualParttime": 0
                        };

                        $("#Jspermfull").val(totalAdditionalEmployee.PermanentFulltime);
                        $("#Jspermpart").val(totalAdditionalEmployee.PermanentParttime);
                        $("#Jscontracfull").val(totalAdditionalEmployee.ContractualFulltime);
                        $("#Jscontracpart").val(totalAdditionalEmployee.ContractualParttime);

                        listOfSelectedEmployee = [];
                        listOfSelectedEmployeeNames = [];

                        $(".namefacreplace").each(function() {
                            let selectedEmployee = $(this).val();
                            if (selectedEmployee != null) {
                                let pipeIndex = selectedEmployee.indexOf("|");
                                let selectedEmploymentStatus = (selectedEmployee.substring(pipeIndex + 1)).trim();
                                listOfSelectedEmployee.push(selectedEmploymentStatus);

                                let selectedEmploymeeName= (selectedEmployee.substring(0, pipeIndex)).trim();
                                if (listOfSelectedEmployeeNames.includes(selectedEmploymeeName)) {
                                    alert("Selected professor is already chosen. Please select another.")
                                    $(this).val(null);
                                } else {
                                    listOfSelectedEmployeeNames.push(selectedEmploymeeName);
                                }
                            }
                        });

                        // console.log(listOfSelectedEmployee);
                        console.log(listOfSelectedEmployeeNames);

                        for (let ctr = 0; listOfSelectedEmployee.length > ctr; ctr++) {
                            if (listOfSelectedEmployee[ctr] == "Permanent Full-time") {
                                totalAdditionalEmployee.PermanentFulltime = totalAdditionalEmployee.PermanentFulltime + 1;
                                totalAdditionalEmployee.PermanentParttime = totalAdditionalEmployee.PermanentParttime + 2;
                                totalAdditionalEmployee.ContractualFulltime = totalAdditionalEmployee.ContractualFulltime + 1;
                                totalAdditionalEmployee.ContractualParttime = totalAdditionalEmployee.ContractualParttime + 2;
                            } else if (listOfSelectedEmployee[ctr] == "Permanent Part-time") {
                                totalAdditionalEmployee.PermanentFulltime = totalAdditionalEmployee.PermanentFulltime + .5;
                                totalAdditionalEmployee.PermanentParttime = totalAdditionalEmployee.PermanentParttime + 1;
                                totalAdditionalEmployee.ContractualFulltime = totalAdditionalEmployee.ContractualFulltime + .5;
                                totalAdditionalEmployee.ContractualParttime = totalAdditionalEmployee.ContractualParttime + 1;
                            } else if (listOfSelectedEmployee[ctr] == "Contractual Full-time") {
                                totalAdditionalEmployee.PermanentFulltime = totalAdditionalEmployee.PermanentFulltime + 1;
                                totalAdditionalEmployee.PermanentParttime = totalAdditionalEmployee.PermanentParttime + 2;
                                totalAdditionalEmployee.ContractualFulltime = totalAdditionalEmployee.ContractualFulltime + 1;
                                totalAdditionalEmployee.ContractualParttime = totalAdditionalEmployee.ContractualParttime + 2;
                            } else if (listOfSelectedEmployee[ctr] == "Contractual Part-time") {
                                totalAdditionalEmployee.PermanentFulltime = totalAdditionalEmployee.PermanentFulltime + .5;
                                totalAdditionalEmployee.PermanentParttime = totalAdditionalEmployee.PermanentParttime + 1;
                                totalAdditionalEmployee.ContractualFulltime = totalAdditionalEmployee.ContractualFulltime + .5;
                                totalAdditionalEmployee.ContractualParttime = totalAdditionalEmployee.ContractualParttime + 1;
                            }

                            $("#Jspermfull").val(totalAdditionalEmployee.PermanentFulltime);
                            $("#Jspermpart").val(totalAdditionalEmployee.PermanentParttime);
                            $("#Jscontracfull").val(totalAdditionalEmployee.ContractualFulltime);
                            $("#Jscontracpart").val(totalAdditionalEmployee.ContractualParttime);
                        }

                        console.log(totalAdditionalEmployee);
                    }
                    $(".addmem").click(function(e) {
                        e.preventDefault();
                        var table = $(".original-row").closest('table');

                        const loggedInUserPosition = "{{ $loggedInUserPosition }}";
                        const loggedInUserCollege= "{{ $positionFormMapping->college }}";

                        if (loggedInUserPosition == "Dean") {
                            let addMemDepartment = $(".dropwdown-dean").val();
                            if (!addMemDepartment) {
                                alert("Select Department.");
                            } else {
                                $.ajax({
                                    url: '/api/forecasting/professors/' + loggedInUserCollege + "/" + addMemDepartment,
                                    method: 'get',
                                    success: function(response) {

                                        console.log(response);

                                        let PermanentFulltime = response.employeeCountByEmployeeStatusArr["Permanent Full-time"] ?? 0;
                                        let ContractualFulltime = response.employeeCountByEmployeeStatusArr["Contractual Full-time"] ?? 0;
                                        let PermanentParttime = response.employeeCountByEmployeeStatusArr["Permanent Part-time"] ?? 0;
                                        let ContractualParttime = response.employeeCountByEmployeeStatusArr["Contractual Part-time"] ?? 0;

                                        $("#Fulltimeperm").val(PermanentFulltime);
                                        $("#Fulltimecontrac").val(ContractualFulltime);
                                        $("#Parttimeperm").val(PermanentParttime);
                                        $("#Parttimecontrac").val(ContractualParttime);
                                        $("#TotalPerm").val(PermanentFulltime + PermanentParttime);
                                        $("#TotalCon").val(ContractualFulltime + ContractualParttime);

                                        let optionValues = "";
                                        response.professors.map(res => {
                                            optionValues += `<option value="${res.first_name } ${res.last_name } | ${res.employment_status}">${res.first_name} ${res.last_name}</option>`;
                                        });

                                        table.append(`
                                            <tr class="appended-row">
                                                <td>
                                                    <select id="namefacreplace" name="namefacreplace[]" class="namefacreplace" required>
                                                        <option disabled selected value="" class="optiondisabled">Select</option>
                                                        ${optionValues}
                                                    </select>
                                                    <br>
                                                </td>
                                                <td>
                                                    <select id="reasonreplace" name="reasonreplace[]" class="reasonreplace" required>
                                                        <option disabled selected value="">Select</option>
                                                        <option value="Transfer">Transfer</option>
                                                        <option value="Resigned">Resigned</option>
                                                        <option value="Promotion">Promotion</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                    <br>
                                                </td>
                                                <td>
                                                    <input class="reasonforhiring" name="reasonforhiring[]" id="reasonforhiring" required type="text" placeholder="Type 'N/A' if not applicable.">
                                                </td>
                                                <td class="action-buttons">
                                                    <button class="addmem remove_namefacreplacebtn">Remove</button>
                                                </td>
                                            </tr>
                                        `);

                                        $(".namefacreplace").on('change', function() {
                                            updateTotalAdditionalEmployee();
                                        });
                                    }
                                });
                            }
                        } else {
                            table.append(`
                                <tr class="appended-row">
                                    <td>
                                        <select id="namefacreplace" name="namefacreplace[]" class="namefacreplace" required>
                                            <option disabled selected value="" class="optiondisabled">Select</option>
                                            @foreach($professors as $professor) 
                                                <option value="{{ $professor->first_name }} {{ $professor->last_name }} | {{ $professor->employment_status }}">{{ $professor->first_name }} {{ $professor->last_name }}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                    </td>
                                    <td>
                                        <select id="reasonreplace" name="reasonreplace[]" class="reasonreplace" required>
                                            <option disabled selected value="">Select</option>
                                            <option value="Transfer">Transfer</option>
                                            <option value="Resigned">Resigned</option>
                                            <option value="Promotion">Promotion</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <br>
                                    </td>
                                    <td>
                                        <input class="reasonforhiring" name="reasonforhiring[]" id="reasonforhiring" required type="text" placeholder="Type 'N/A' if not applicable.">
                                    </td>
                                    <td class="action-buttons">
                                        <button class="addmem remove_namefacreplacebtn">Remove</button>
                                    </td>
                                </tr>
                            `);
                        }

                        $(".namefacreplace").on('change', function() {
                            updateTotalAdditionalEmployee();
                        });
                    });

                    $(document).on('click', '.remove_namefacreplacebtn', function(e) {
                        e.preventDefault();
                        let row_item = $(this).closest('tr');
                        row_item.remove();
                        updateTotalAdditionalEmployee();
                    });

                    //ajax request to insert form
                    $("#mforecastform").submit(function(e) {
                        e.preventDefault();
                        $("#save").val('Adding...');

                        $.ajax({
                            url: '/forecast/save/{forecast_num_id}',
                            method: 'post',
                            data: $(this).serialize(),
                            success: function(response) {
                                $("#addmem").val('Add');
                                $("#mforecastform")[0].reset();
                                $(".appended-row").remove();
                            }
                        });
                    });

                    $(".namefacreplace").on('change', function() {
                        updateTotalAdditionalEmployee();
                    });
                });
            </script>
            <!--END OF ADD BUTTON!! -->
            <div class="light-grey-jobspecification shadow">
                <br>
                <table class="table-num-add-fac">
                    <tbody>
                        <tr>
                            <td colspan="4">
                                <div class="grid-con-num-add-fac-member" >
                                    <label for="numaddfacmember"style="text-align:left"><b>Number of Additional Faculty Members: </b></label>
                                    <label>(Please choose one from the selection.)</label>
                                    <input id="numaddfacmember" name="numaddfacmember" type="hidden" readonly>
                                    <input id="numaddfacmemberSelectedType" name="numaddfacmemberSelectedType" type="hidden" readonly>
                                </div>
                                <br>
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <div class="employment-stat-first-column" style="margin-left: 10%">
                                    <input type="radio" id="radiobtnJspermfull" name="employmentStatus" class="faculty-member-type" faculty-member-type="Permanent-Full-time">
                                    <label for="Jspermfull">Permanent Full-time:</label>
                                    <input id="Jspermfull" name="jspermfull" type="number" style="width: 5em; margin-left: 10px;" min="0" class="numberFacultySelector">
                                    <label for="Jspermfull" style="margin-left: 13%">or</label>
                                </div>
                            </td>
                            <td>
                                <div class="employment-stat-second-column" style="margin-left: 10%">
                                    <input type="radio" id="radiobtnJspermpart" name="employmentStatus" class="faculty-member-type" faculty-member-type="Permanent-Part-time" >
                                    <label for="Jspermpart">Permanent Part-time:</label>
                                    <input id="Jspermpart" name="jspermpart" type="number" style="width: 5em; margin-left: 10px;" min="0" class="numberFacultySelector">
                                    <label for="Jspermpart" style="margin-left: 13%">or</label>
                                </div>
                            </td>
                            <td>
                                <div class="employment-stat-third-column" style="margin-left: 10%">
                                    <input type="radio" id="radiobtnJscontracfull" name="employmentStatus" class="faculty-member-type" faculty-member-type="Contractual-Full-time" >
                                    <label for="Jscontracfull">Contractual Full-time:</label>
                                    <input id="Jscontracfull" name="jscontracfull" type="number" style="width: 5em; margin-left: 10px;" min="0" class="numberFacultySelector">
                                    <label for="Jscontracfull" style="margin-left: 13%">or</label>
                                </div>
                            </td>
                            <td>
                                <div class="employment-stat-fourth-column">
                                    <input type="radio" id="radiobtnJscontracpart" name="employmentStatus" class="faculty-member-type" faculty-member-type="Contractual-Part-time" >
                                    <label for="Jscontracpart">Contractual Part-time:</label>
                                    <input id="Jscontracpart" name="jscontracpart" type="number" style="width: 5em; margin-left: 10px;" min="0" class="numberFacultySelector">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>              

                <table class="table-jobspecification">
                    <div class="grid-con-text-jobspecif">
                        <h2> <b> <br>Job Specification</h2> </b>
                    </div>
                    <tbody>
                        <tr>
                            <td>Bachelor's Degree:</td>
                            <td><input type="text" id="jsbachelor" name="jsbachelor" style="width: 500px; height: 25px;" placeholder="Type 'N/A' if not applicable."  required></td>
                        </tr>
                        <tr>
                            <td>Master's Degree:</td>
                            <td><input type="text" id="jsmasters" name="jsmasters" style="width: 500px; height: 25px;" placeholder="Type 'N/A' if not applicable." required></td>
                        </tr>
                        <tr>
                            <td>Allied Programs: (Other courses/program that can  considered)</td>
                            <td><input type="text" id="jsalliedprog" name="jsalliedprog" style="width: 500px; height: 25px;" placeholder="Type 'N/A' if not applicable." required></td>
                        </tr>
                        <tr>
                            <td>Years of teaching experience:</td>
                            <td><input type="text" id="yrsofteachexp" name="yrsofteachexp" style="width: 500px; height: 25px;" placeholder="Type 'N/A' if not applicable." required></td>
                        </tr>
                        <tr>
                            <td>Technical Skills:</td>
                            <td><input type="text" id="technicalskills" name="technicalskills"style="width: 500px; height: 25px;" placeholder="Type 'N/A' if not applicable." required></td>
                        </tr>
                        <tr>
                            <td>Interpersonal Skills:</td>
                            <td><input type="text" id="interpersonalskills" name="interpersonalskills" style="width: 500px; height: 25px;" placeholder="Type 'N/A' if not applicable." required></td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>

            <div class="light-grey-majorsubjects shadow">
                <h2><b><br>A. For Professional/Major Subjects</b> </h2>
                <div class="table-major-subjects">
                    <table class="major-subjects">
                        <tbody>
                            <tr>
                                <td rowspan="3">Year Level</td>
                                <td colspan="3">Student Population</td>
                                <td colspan="3">Number of Sections Opened</td>
                            </tr>
                            <tr>
                                <td class="blue-header" id="selectedAy1st"></td>
                                    <input type="hidden" id="aydropdown1SemesterInput" name="aydropdown1s" value="">
                                
                                <td class="blue-header" id="selectedAy2nd"></td>
                                    <input type="hidden" id="aydropdown2SemesterInput" name="aydropdown2s" value="">
                               
                                <td class="blue-header" id="forecastSemester"></td>
                                    <input type="hidden" id="forecastSemesterInput" name="forecastSemester" value="">
                                <td class="blue-header" id="td1"></td>
                                <td class="blue-header" id="td2"></td>
                                <td class="blue-header" id="forecastSemester2"></td>
                            </tr>

                            {{-- <script>
                                // Function to add academic year options
                                function generateAcademicYearOptions() {
                                    // Get the current year
                                    var currentYear = new Date().getFullYear();
                            
                                    // Set the range of years you want to display, e.g., from 2018 to currentYear
                                    var startYear = 2018;
                                    var endYear = currentYear;
                            
                                    // Generate the academic year options dynamically
                                    var selectElement = document.getElementById("aydropdown1s");
                            
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
                            
                                // Check for a new year and add a new option if it's a new year
                                var currentYear = new Date().getFullYear();
                                var selectElement = document.getElementById("aydropdown1s");
                            
                                setInterval(function () {
                                    var newYear = new Date().getFullYear();
                                    if (newYear > currentYear) {
                                        currentYear = newYear;
                                        var academicYear = currentYear + "-" + (currentYear + 1);
                                        var option = document.createElement("option");
                                        option.value = academicYear;
                                        option.textContent = academicYear;
                                        selectElement.appendChild(option);
                                    }
                                }, 1000 * 60 * 60 * 24); // Check once a day (adjust as needed)
                            </script>   --}}

                            {{-- <script>
                                // Function to add academic year options
                                function generateAcademicYearOptions() {
                                    // Get the current year
                                    var currentYear = new Date().getFullYear();
                            
                                    // Set the range of years you want to display, e.g., from 2018 to currentYear
                                    var startYear = 2018;
                                    var endYear = currentYear;
                            
                                    // Generate the academic year options dynamically
                                    var selectElement = document.getElementById("aydropdown2s");
                            
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
                            
                                // Check for a new year and add a new option if it's a new year
                                var currentYear = new Date().getFullYear();
                                var selectElement = document.getElementById("aydropdown2s");
                            
                                setInterval(function () {
                                    var newYear = new Date().getFullYear();
                                    if (newYear > currentYear) {
                                        currentYear = newYear;
                                        var academicYear = currentYear + "-" + (currentYear + 1);
                                        var option = document.createElement("option");
                                        option.value = academicYear;
                                        option.textContent = academicYear;
                                        selectElement.appendChild(option);
                                    }
                                }, 1000 * 60 * 60 * 24); // Check once a day (adjust as needed)
                            </script>   --}}

                            <tr>
                                <td>1st Semester</td>
                                <td>2nd Semester</td>
                                <td>Forecast</td>
                                <td>1st Semester</td>
                                <td>2nd Semester</td>
                                <td>Forecast</td>
                            </tr>
                            <tr> <!--IM HEEEREEEEE-->
                                <td>1st Year</td>
                                <td><input class="emc-inputtext" id="studentpop1y1s" name="studentpop1y1s" min="0" type="number" placeholder="Type 0 if none." required></td>
                                <td><input class="emc-inputtext"  id="studentpop1y2s" name="studentpop1y2s" min="0"type="number" placeholder="Type 0 if none." required></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total1y1s2sstudent" name="Total1y1s2sstudent" readonly></td>
                                <td><input class="emc-inputtext" id="numsectopened1y1s" name="numsectopened1y1s"readonly></td>
                                <td><input class="emc-inputtext" id="numsectopened1y2s" name="numsectopened1y2s"readonly></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total1y1s2ssection" name="Total1y1s2ssection" readonly></td>
                            </tr>
                            <tr>
                                <td>2nd Year</td>
                                <td><input class="emc-inputtext" id="studentpop2y1s" name="studentpop2y1s" type="number" min="0"placeholder="Type 0 if none." required></td>
                                <td><input class="emc-inputtext"  id="studentpop2y2s" name="studentpop2y2s" type="number" min="0"placeholder="Type 0 if none." required></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total2y1s2sstudent" name="Total2y1s2sstudent" readonly></td>
                                <td><input class="emc-inputtext" id="numsectopened2y1s" name="numsectopened2y1s" readonly></td>
                                <td><input class="emc-inputtext" id="numsectopened2y2s" name="numsectopened2y2s" readonly></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total2y1s2ssection" name="Total2y1s2ssection" readonly></td>
                            </tr>
                            <tr>
                                <td>3rd Year</td>
                                <td><input class="emc-inputtext" id="studentpop3y1s" name="studentpop3y1s" type="number" min="0"placeholder="Type 0 if none." required></td>
                                <td><input class="emc-inputtext"  id="studentpop3y2s" name="studentpop3y2s" type="number" min="0"placeholder="Type 0 if none." required></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total3y1s2sstudent" name="Total3y1s2sstudent" readonly></td>
                                <td><input class="emc-inputtext" id="numsectopened3y1s" name="numsectopened3y1s"readonly></td>
                                <td><input class="emc-inputtext" id="numsectopened3y2s" name="numsectopened3y2s"readonly></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total3y1s2ssection" name="Total3y1s2ssection" readonly></td>
                            </tr>
                            <tr>
                                <td>4th Year</td>
                                <td><input class="emc-inputtext" id="studentpop4y1s" name="studentpop4y1s" type="number" min="0"placeholder="Type 0 if none." required></td>
                                <td><input class="emc-inputtext"  id="studentpop4y2s" name="studentpop4y2s" type="number"min="0" placeholder="Type 0 if none." required></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total4y1s2sstudent" name="Total4y1s2sstudent" readonly></td>
                                <td><input class="emc-inputtext" id="numsectopened4y1s" name="numsectopened4y1s"readonly></td>
                                <td><input class="emc-inputtext" id="numsectopened4y2s" name="numsectopened4y2s"readonly></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total4y1s2ssection" name="Total4y1s2ssection" readonly></td>
                            </tr>
                            <tr>
                                <td>5th Year</td>
                                <td><input class="emc-inputtext" id="studentpop5y1s" name="studentpop5y1s" min="0"type="number" placeholder="Type 0 if none." required></td>
                                <td><input class="emc-inputtext"  id="studentpop5y2s" name="studentpop5y2s"min="0" type="number" placeholder="Type 0 if none." required></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total5y1s2sstudent" name="Total5y1s2sstudent" readonly></td>
                                <td><input class="emc-inputtext" id="numsectopened5y1s" name="numsectopened5y1s" readonly></td>
                                <td><input class="emc-inputtext" id="numsectopened5y2s" name="numsectopened5y2s"readonly></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total5y1s2ssection" name="Total5y1s2ssection" readonly></td>
                            </tr>
                            <tr>
                                <td class="totalrow"><button class="totalbtnmajorsubj" id="Total-A" disabled><b>Total</b></button></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total1sstudent" name="Total1sstudent" readonly></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total2sstudent" name="Total2sstudent" readonly></td>
                                <td class="totalrow"><input class="emc-inputtext" id="TotalStudentForecast" name="TotalStudentForecast" readonly></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total1ssection" name="Total1ssection" readonly></td>
                                <td class="totalrow"><input class="emc-inputtext" id="Total2ssection" name="Total2ssection" readonly></td>
                                <td class="totalrow"><input class="emc-inputtext" id="TotalSectionForecast" name="TotalSectionForecast" readonly></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
            <script>

                // TOTAL STUDENT FORECAST
                function computeTotalStudentForecast() {
                    var Total1y1s2sstudent = parseInt($("#Total1y1s2sstudent").val()) ?? 0;
                    var Total2y1s2sstudent = parseInt($("#Total2y1s2sstudent").val()) ?? 0;
                    var Total3y1s2sstudent = parseInt($("#Total3y1s2sstudent").val()) ?? 0;
                    var Total4y1s2sstudent = parseInt($("#Total4y1s2sstudent").val()) ?? 0;
                    var Total5y1s2sstudent = parseInt($("#Total5y1s2sstudent").val()) ?? 0;
                    
                    var totalStudentForecast = Total1y1s2sstudent 
                        + Total2y1s2sstudent
                        + Total3y1s2sstudent
                        + Total4y1s2sstudent
                        + Total5y1s2sstudent;

                    if (totalStudentForecast) {
                        $("#TotalStudentForecast").val(totalStudentForecast);
                    }
                }

                // TOTAL 1ST SEM SECTION OPENED
                function computeTotal1sSectionForecast() {
                    var numsectopened1y1s = parseInt($("#numsectopened1y1s").val()) ?? 0;
                    var numsectopened2y1s = parseInt($("#numsectopened2y1s").val()) ?? 0;
                    var numsectopened3y1s = parseInt($("#numsectopened3y1s").val()) ?? 0;
                    var numsectopened4y1s = parseInt($("#numsectopened4y1s").val()) ?? 0;
                    var numsectopened5y1s = parseInt($("#numsectopened5y1s").val()) ?? 0;
                    
                    var total1sSectionForecast = numsectopened1y1s 
                        + numsectopened2y1s
                        + numsectopened3y1s
                        + numsectopened4y1s
                        + numsectopened5y1s;

                    if (total1sSectionForecast) {
                        $("#Total1ssection").val(total1sSectionForecast);
                    }
                }

                // TOTAL 2ND SEM SECTION OPENED
                function computeTotal2sSectionForecast() {
                    var numsectopened1y2s = parseInt($("#numsectopened1y2s").val()) ?? 0;
                    var numsectopened2y2s = parseInt($("#numsectopened2y2s").val()) ?? 0;
                    var numsectopened3y2s = parseInt($("#numsectopened3y2s").val()) ?? 0;
                    var numsectopened4y2s = parseInt($("#numsectopened4y2s").val()) ?? 0;
                    var numsectopened5y2s = parseInt($("#numsectopened5y2s").val()) ?? 0;
                    
                    var total2sSectionForecast = numsectopened1y2s 
                        + numsectopened2y2s
                        + numsectopened3y2s
                        + numsectopened4y2s
                        + numsectopened5y2s;

                    if (total2sSectionForecast) {
                        $("#Total2ssection").val(total2sSectionForecast);
                    }
                }

                function roundtoWholeNumber(value) {
                    let decimalIndex = value.indexOf(".");
                    let decimalValue = parseInt(value.substring(decimalIndex + 1, decimalIndex + 2));

                    if (decimalValue >= 5) {
                        return parseInt(value) + 1;
                    } else {
                        return parseInt(value);
                    }
                }

                // TOTAL 2ND SEM SECTION OPENED
                function computeSemForecast() {
                    var total1y1s2sstudent = (parseInt($("#Total1y1s2sstudent").val()) ?? 0) / 40;
                    total1y1s2sstudent = Math.round((total1y1s2sstudent + Number.EPSILON) * 100) / 100;
                    total1y1s2sstudent = roundtoWholeNumber(total1y1s2sstudent.toFixed(2));
                    if (total1y1s2sstudent) {
                        $("#Total1y1s2ssection").val(total1y1s2sstudent);
                    }

                    var total2y1s2sstudent = (parseInt($("#Total2y1s2sstudent").val()) ?? 0) / 40;
                    total2y1s2sstudent = Math.round((total2y1s2sstudent + Number.EPSILON) * 100) / 100;
                    total2y1s2sstudent = roundtoWholeNumber(total2y1s2sstudent.toFixed(2));
                    if (total2y1s2sstudent) {
                        $("#Total2y1s2ssection").val(total2y1s2sstudent);
                    }

                    var total3y1s2sstudent = (parseInt($("#Total3y1s2sstudent").val()) ?? 0) / 40;
                    total3y1s2sstudent = Math.round((total3y1s2sstudent + Number.EPSILON) * 100) / 100;
                    total3y1s2sstudent = roundtoWholeNumber(total3y1s2sstudent.toFixed(2));
                    if (total3y1s2sstudent) {
                        $("#Total3y1s2ssection").val(total3y1s2sstudent);
                    }

                    var total4y1s2sstudent = (parseInt($("#Total4y1s2sstudent").val()) ?? 0) / 40;
                    total4y1s2sstudent = Math.round((total4y1s2sstudent + Number.EPSILON) * 100) / 100;
                    total4y1s2sstudent = roundtoWholeNumber(total4y1s2sstudent.toFixed(2));
                    if (total4y1s2sstudent) {
                        $("#Total4y1s2ssection").val(total3y1s2sstudent);
                    }

                    var total5y1s2sstudent = (parseInt($("#Total5y1s2sstudent").val()) ?? 0) / 40;
                    total5y1s2sstudent = Math.round((total5y1s2sstudent + Number.EPSILON) * 100) / 100;
                    total5y1s2sstudent = roundtoWholeNumber(total5y1s2sstudent.toFixed(2));
                    if (total5y1s2sstudent) {
                        $("#Total5y1s2ssection").val(total5y1s2sstudent);
                    }

                    var totalStudentForecast = (parseInt($("#TotalStudentForecast").val()) ?? 0) / 40;
                    totalStudentForecast = Math.round((totalStudentForecast + Number.EPSILON) * 100) / 100;
                    totalStudentForecast = roundtoWholeNumber(totalStudentForecast.toFixed(2));
                    if (totalStudentForecast) {
                        $("#TotalSectionForecast").val(totalStudentForecast);
                    }

                    updateTotalForecastServiceSubject();
                }
                
               
                //1ST SEM STUDENT POPULATION
                var studentpop1y1sInput = document.getElementById("studentpop1y1s");
                var studentpop2y1sInput = document.getElementById("studentpop2y1s");
                var studentpop3y1sInput = document.getElementById("studentpop3y1s");
                var studentpop4y1sInput = document.getElementById("studentpop4y1s");
                var studentpop5y1sInput = document.getElementById("studentpop5y1s");

                var total1sInput = document.getElementById("Total1sstudent");
            
                var calculateTotal1sstud = function() {
                    var studentpop1y1sValue = parseFloat(studentpop1y1sInput.value) || 0;
                    var studentpop2y1sValue = parseFloat(studentpop2y1sInput.value) || 0;
                    var studentpop3y1sValue = parseFloat(studentpop3y1sInput.value) || 0;
                    var studentpop4y1sValue = parseFloat(studentpop4y1sInput.value) || 0;
                    var studentpop5y1sValue = parseFloat(studentpop5y1sInput.value) || 0;

                    var total1s = studentpop1y1sValue + studentpop2y1sValue + studentpop3y1sValue +studentpop4y1sValue + studentpop5y1sValue;
                    total1s = Math.ceil(total1s);
                    total1sInput.value = total1s;

                    computeTotalStudentForecast();
                    computeTotal1sSectionForecast();
                    computeTotal2sSectionForecast();
                    computeSemForecast();
                };
            
                studentpop1y1sInput.addEventListener("input", calculateTotal1sstud);
                studentpop2y1sInput.addEventListener("input", calculateTotal1sstud);
                studentpop3y1sInput.addEventListener("input", calculateTotal1sstud);
                studentpop4y1sInput.addEventListener("input", calculateTotal1sstud);
                studentpop5y1sInput.addEventListener("input", calculateTotal1sstud);

                //2ND SEM STUDENT POPULATION
                var studentpop1y2sInput = document.getElementById("studentpop1y2s");
                var studentpop2y2sInput = document.getElementById("studentpop2y2s");
                var studentpop3y2sInput = document.getElementById("studentpop3y2s");
                var studentpop4y2sInput = document.getElementById("studentpop4y2s");
                var studentpop5y2sInput = document.getElementById("studentpop5y2s");

                var total2sInput = document.getElementById("Total2sstudent");
            
                var calculateTotal2sstud = function() {
                    var studentpop1y2sValue = parseFloat(studentpop1y2sInput.value) || 0;
                    var studentpop2y2sValue = parseFloat(studentpop2y2sInput.value) || 0;
                    var studentpop3y2sValue = parseFloat(studentpop3y2sInput.value) || 0;
                    var studentpop4y2sValue = parseFloat(studentpop4y2sInput.value) || 0;
                    var studentpop5y2sValue = parseFloat(studentpop5y2sInput.value) || 0;

                    var total2s = studentpop1y2sValue + studentpop2y2sValue + studentpop3y2sValue +studentpop4y2sValue + studentpop5y2sValue;
                    total2s = Math.ceil(total2s);
                    total2sInput.value = total2s;

                    computeTotalStudentForecast();
                    computeTotal1sSectionForecast();
                    computeTotal2sSectionForecast();
                    computeSemForecast();
                };
            
                studentpop1y2sInput.addEventListener("input", calculateTotal2sstud);
                studentpop2y2sInput.addEventListener("input", calculateTotal2sstud);
                studentpop3y2sInput.addEventListener("input", calculateTotal2sstud);
                studentpop4y2sInput.addEventListener("input", calculateTotal2sstud);
                studentpop5y2sInput.addEventListener("input", calculateTotal2sstud);

                // student/40 = subj 
                var studentpop1y1sInput = document.getElementById("studentpop1y1s");
                var studentpop2y1sInput = document.getElementById("studentpop2y1s");
                var studentpop3y1sInput = document.getElementById("studentpop3y1s");
                var studentpop4y1sInput = document.getElementById("studentpop4y1s");
                var studentpop5y1sInput = document.getElementById("studentpop5y1s");

                var studentpop1y2sInput = document.getElementById("studentpop1y2s");
                var studentpop2y2sInput = document.getElementById("studentpop2y2s");
                var studentpop3y2sInput = document.getElementById("studentpop3y2s");
                var studentpop4y2sInput = document.getElementById("studentpop4y2s");
                var studentpop5y2sInput = document.getElementById("studentpop5y2s");

                /// 1y
                var stud40subj1y1sInput = document.getElementById("numsectopened1y1s");
                var calculatestud40subj1y1s = function() {
                    var studentpop1y1sValue = parseFloat(studentpop1y1sInput.value) || 0;
                    var totalsec1y = studentpop1y1sValue/40; totalsec1y = Math.ceil(totalsec1y); stud40subj1y1sInput.value = totalsec1y;
                };
                studentpop1y1sInput.addEventListener("input", calculatestud40subj1y1s);

                ///2y
                var stud40subj2y1sInput = document.getElementById("numsectopened2y1s");
                var calculatestud40subj2y1s = function() {
                    var studentpop2y1sValue = parseFloat(studentpop2y1sInput.value) || 0;
                    var totalsec2y = studentpop2y1sValue/40;  totalsec2y = Math.ceil(totalsec2y); stud40subj2y1sInput.value = totalsec2y;
                };
                studentpop2y1sInput.addEventListener("input", calculatestud40subj2y1s);
                
                ///3y
                var stud40subj3y1sInput = document.getElementById("numsectopened3y1s");
                var calculatestud40subj3y1s = function() {
                    var studentpop3y1sValue = parseFloat(studentpop3y1sInput.value) || 0;
                    var totalsec3y = studentpop3y1sValue/40;  totalsec3y = Math.ceil(totalsec3y); stud40subj3y1sInput.value = totalsec3y;
                };
                studentpop3y1sInput.addEventListener("input", calculatestud40subj3y1s);
                
                ///4y
                var stud40subj4y1sInput = document.getElementById("numsectopened4y1s");
                var calculatestud40subj4y1s = function() {
                    var studentpop4y1sValue = parseFloat(studentpop4y1sInput.value) || 0;
                    var totalsec4y = studentpop4y1sValue/40;  totalsec4y = Math.ceil(totalsec4y); stud40subj4y1sInput.value = totalsec4y;
                };
                studentpop4y1sInput.addEventListener("input", calculatestud40subj4y1s);
                
                ///5y
                var stud40subj5y1sInput = document.getElementById("numsectopened5y1s");
                var calculatestud40subj5y1s = function() {
                    var studentpop5y1sValue = parseFloat(studentpop5y1sInput.value) || 0;
                    var totalsec5y = studentpop5y1sValue/40;  totalsec5y = Math.ceil(totalsec5y); stud40subj5y1sInput.value = totalsec5y;
                };
                studentpop5y1sInput.addEventListener("input", calculatestud40subj5y1s);
                
                /// 1y2s
                var stud40subj1y2sInput = document.getElementById("numsectopened1y2s");
                var calculatestud40subj1y2s = function() {
                    var studentpop1y2sValue = parseFloat(studentpop1y2sInput.value) || 0;
                    var totalsec1y2s = studentpop1y2sValue/40; totalsec1y2s = Math.ceil(totalsec1y2s); stud40subj1y2sInput.value = totalsec1y2s;
                };
                studentpop1y2sInput.addEventListener("input", calculatestud40subj1y2s);

                ///2y2s
                var stud40subj2y2sInput = document.getElementById("numsectopened2y2s");
                var calculatestud40subj2y2s = function() {
                    var studentpop2y2sValue = parseFloat(studentpop2y2sInput.value) || 0;
                    var totalsec2y2s = studentpop2y2sValue/40;  totalsec2y2s = Math.ceil(totalsec2y2s); stud40subj2y2sInput.value = totalsec2y2s;
                };
                studentpop2y2sInput.addEventListener("input", calculatestud40subj2y2s);
                
                ///3y2s
                var stud40subj3y2sInput = document.getElementById("numsectopened3y2s");
                var calculatestud40subj3y2s = function() {
                    var studentpop3y2sValue = parseFloat(studentpop3y2sInput.value) || 0;
                    var totalsec3y2s = studentpop3y2sValue/40;  totalsec3y2s = Math.ceil(totalsec3y2s); stud40subj3y2sInput.value = totalsec3y2s;
                };
                studentpop3y2sInput.addEventListener("input", calculatestud40subj3y2s);
                
                ///4y2s
                var stud40subj4y2sInput = document.getElementById("numsectopened4y2s");
                var calculatestud40subj4y2s = function() {
                    var studentpop4y2sValue = parseFloat(studentpop4y2sInput.value) || 0;
                    var totalsec4y2s = studentpop4y2sValue/40;  totalsec4y2s = Math.ceil(totalsec4y2s); stud40subj4y2sInput.value = totalsec4y2s;
                };
                studentpop4y2sInput.addEventListener("input", calculatestud40subj4y2s);
                
                ///5y2s
                var stud40subj5y2sInput = document.getElementById("numsectopened5y2s");
                var calculatestud40subj5y2s = function() {
                    var studentpop5y2sValue = parseFloat(studentpop5y2sInput.value) || 0;
                    var totalsec5y2s = studentpop5y2sValue/40;  totalsec5y2s = Math.ceil(totalsec5y2s); stud40subj5y2sInput.value = totalsec5y2s;
                };
                studentpop5y2sInput.addEventListener("input", calculatestud40subj5y2s);
                

                //STUDENT

                // Total Student Forecast 1st Year 1st and 2nd Sem
                var totalStudent1y1s2sInput = document.getElementById("Total1y1s2sstudent");

                var calculateTotal1y1s2sstud = function() {
                    var studentpop1y1sValue = parseFloat(studentpop1y1sInput.value) || 0;
                    var studentpop1y2sValue = parseFloat(studentpop1y2sInput.value) || 0;

                    var totalStud1y1s2s = studentpop1y1sValue + studentpop1y2sValue * 0.02;
                    totalStud1y1s2s = Math.ceil(totalStud1y1s2s); 
                    totalStudent1y1s2sInput.value = totalStud1y1s2s;

                };

                studentpop1y1sInput.addEventListener("input", calculateTotal1y1s2sstud);
                studentpop1y2sInput.addEventListener("input", calculateTotal1y1s2sstud);
                
                // Total Student Forecast 2nd Year 1st and 2nd Sem
                var totalStudent2y1s2sInput = document.getElementById("Total2y1s2sstudent");

                var calculateTotal2y1s2sstud = function() {
                    var studentpop2y1sValue = parseFloat(studentpop2y1sInput.value) || 0;
                    var studentpop2y2sValue = parseFloat(studentpop2y2sInput.value) || 0;

                    var totalStud2y1s2s = studentpop2y1sValue + studentpop2y2sValue * 0.02;
                    totalStud2y1s2s = Math.ceil(totalStud2y1s2s);
                    totalStudent2y1s2sInput.value = totalStud2y1s2s;

                };

                studentpop2y1sInput.addEventListener("input", calculateTotal2y1s2sstud);
                studentpop2y2sInput.addEventListener("input", calculateTotal2y1s2sstud);

                // Total Student Forecast 3rd Year 1st and 2nd Sem
                var totalStudent3y1s2sInput = document.getElementById("Total3y1s2sstudent");

                var calculateTotal3y1s2sstud = function() {
                    var studentpop3y1sValue = parseFloat(studentpop3y1sInput.value) || 0;
                    var studentpop3y2sValue = parseFloat(studentpop3y2sInput.value) || 0;

                    var totalStud3y1s2s = studentpop3y1sValue + studentpop3y2sValue * 0.02;
                    totalStud3y1s2s = Math.ceil(totalStud3y1s2s);
                    totalStudent3y1s2sInput.value = totalStud3y1s2s;

                };
                
                studentpop3y1sInput.addEventListener("input", calculateTotal3y1s2sstud);
                studentpop3y2sInput.addEventListener("input", calculateTotal3y1s2sstud);

                // Total Student Forecast 4th Year 1st and 2nd Sem
                var totalStudent4y1s2sInput = document.getElementById("Total4y1s2sstudent");

                var calculateTotal4y1s2sstud = function() {
                    var studentpop4y1sValue = parseFloat(studentpop4y1sInput.value) || 0;
                    var studentpop4y2sValue = parseFloat(studentpop4y2sInput.value) || 0;

                    var totalStud4y1s2s = studentpop4y1sValue + studentpop4y2sValue * 0.02;
                    totalStud4y1s2s = Math.ceil(totalStud4y1s2s);
                    totalStudent4y1s2sInput.value = totalStud4y1s2s;

                };

                studentpop4y1sInput.addEventListener("input", calculateTotal4y1s2sstud);
                studentpop4y2sInput.addEventListener("input", calculateTotal4y1s2sstud);

                // Total Student Forecast 5th Year 1st and 2nd Sem
                var totalStudent5y1s2sInput = document.getElementById("Total5y1s2sstudent");

                var calculateTotal5y1s2sstud = function() {
                    var studentpop5y1sValue = parseFloat(studentpop5y1sInput.value) || 0;
                    var studentpop5y2sValue = parseFloat(studentpop5y2sInput.value) || 0;

                    var totalStud5y1s2s = studentpop5y1sValue + studentpop5y2sValue * 0.02;
                    totalStud5y1s2s = Math.ceil(totalStud5y1s2s);
                    totalStudent5y1s2sInput.value = totalStud5y1s2s;

                };

                studentpop5y1sInput.addEventListener("input", calculateTotal5y1s2sstud);
                studentpop5y2sInput.addEventListener("input", calculateTotal5y1s2sstud);

                //SECTION

                // Total Section Forecast 1st Year 1st and 2nd Sem
                var totalSection1y1s2sInput = document.getElementById("Total1y1s2ssection");

                var calculateTotal1y1s2ssec = function() {
                    var numsectopened1y1sValue = parseFloat(numsectopened1y1sInput.value) || 0;
                    var numsectopened1y2sValue = parseFloat(numsectopened1y2sInput.value) || 0;

                    var total = numsectopened1y1sValue + numsectopened1y2sValue * 0.02;
                    totalSection1y1s2sInput.value = total;

                };

                // numsectopened1y1sInput.addEventListener("input", calculateTotal1y1s2ssec);
                // numsectopened1y2sInput.addEventListener("input", calculateTotal1y1s2ssec);

                // Total Section Forecast 2nd Year 1st and 2nd Sem
                var totalSection2y1s2sInput = document.getElementById("Total2y1s2ssection");

                var calculateTotal2y1s2ssec = function() {
                    var numsectopened2y1sValue = parseFloat(numsectopened2y1sInput.value) || 0;
                    var numsectopened2y2sValue = parseFloat(numsectopened2y2sInput.value) || 0;

                    var total = numsectopened2y1sValue + numsectopened2y2sValue * 0.02;
                    totalSection2y1s2sInput.value = total;

                };

                // numsectopened2y1sInput.addEventListener("input", calculateTotal2y1s2ssec);
                // numsectopened2y2sInput.addEventListener("input", calculateTotal2y1s2ssec);

                // Total Section Forecast 3rd Year 1st and 2nd Sem
                var totalSection3y1s2sInput = document.getElementById("Total3y1s2ssection");

                var calculateTotal3y1s2ssec = function() {
                    var numsectopened3y1sValue = parseFloat(numsectopened3y1sInput.value) || 0;
                    var numsectopened3y2sValue = parseFloat(numsectopened3y2sInput.value) || 0;

                    var total = numsectopened3y1sValue + numsectopened3y2sValue * 0.02;
                    totalSection3y1s2sInput.value = total;

                };

                // numsectopened3y1sInput.addEventListener("input", calculateTotal3y1s2ssec);
                // numsectopened3y2sInput.addEventListener("input", calculateTotal3y1s2ssec);  

                // Total Section Forecast 4th Year 1st and 2nd Sem
                var totalSection4y1s2sInput = document.getElementById("Total4y1s2ssection");

                var calculateTotal4y1s2ssec = function() {
                    var numsectopened4y1sValue = parseFloat(numsectopened4y1sInput.value) || 0;
                    var numsectopened4y2sValue = parseFloat(numsectopened4y2sInput.value) || 0;

                    var total = numsectopened4y1sValue + numsectopened4y2sValue * 0.02;
                    totalSection4y1s2sInput.value = total;

                };

                // numsectopened4y1sInput.addEventListener("input", calculateTotal4y1s2ssec);
                // numsectopened4y2sInput.addEventListener("input", calculateTotal4y1s2ssec);  

                // Total Section Forecast 5th Year 1st and 2nd Sem
                var totalSection5y1s2sInput = document.getElementById("Total5y1s2ssection");

                var calculateTotal5y1s2ssec = function() {
                    var numsectopened5y1sValue = parseFloat(numsectopened5y1sInput.value) || 0;
                    var numsectopened5y2sValue = parseFloat(numsectopened5y2sInput.value) || 0;

                    var total = numsectopened5y1sValue + numsectopened5y2sValue * 0.02;
                    totalSection5y1s2sInput.value = total;

                };

                // numsectopened5y1sInput.addEventListener("input", calculateTotal5y1s2ssec);
                // numsectopened5y2sInput.addEventListener("input", calculateTotal5y1s2ssec);  

                

                // TOTAL SECTION FORECAST

            </script>

            <div class="light-grey-servicesubjects shadow">
                <h2><b><br>B. For Service Subjects</b> </h2>
                <div class="table-service-subjects">
                    <table class="service-subjects">
                        <tbody>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">Number of Sections Opened</td>
                                <td>Forecast</b></td>
                            </tr>
                            <tr>
                                <td rowspan="2" class="action-buttons"><button class="addsubj">Add Subject</button></td>
                                <td class="servicesubjsrow blue-header" rowspan="2">Subjects</td>
                                <td class="semsrow blue-header" id="td3"></td>
                                <td class="semsrow blue-header" id="td4"></td>
                                <td rowspan="2" class="blue-header" id="forecastSemester3"></td>
                            </tr>
                            <tr>
                                <td class="blue-header">1st Semester</td>
                                <td class="blue-header">2nd Semester</td>
                            </tr>
                            <tr class="original-rowsubj">
                                {{-- <td class="action-buttons"><button class="addsubj">Add Subject</button></td>
                                <td><input class="emc-inputtext" id="servsubj" name="servsubj[]" type="text" placeholder="Type here" required></td>
                                <td><input class="emc-inputtext" id="ssubj1stnumsectopened" name="ssubj1stnumsectopened[]" type="number" placeholder="Type 0 if none." required></td>
                                <td><input class="emc-inputtext" id="ssubj2ndnumsectopened" name="ssubj2ndnumsectopened[]" type="number" placeholder="Type 0 if none." required></td>
                                <td class="totalrowservsubj"><input class="emc-inputtext forecast-service-subject" id="Total1s2sForecastServSubject" name="Total1s2sForecastServSubject" readonly></td> --}}
                            </tr>
                            <tr>
                                <td class="totalrow" id="totalRowForServiceSubjects"><button class="totalbtnservsubj" id="Total-B" disabled><b>Total</b></button></td>
                                <td></td>
                                <td class="totalrow"><input class="emc-inputtext " id="totalssubj1stnumsectopened" name="totalssubj1stnumsectopened" readonly></td>
                                <td class="totalrow"><input class="emc-inputtext " id="totalssubj2ndnumsectopened" name="totalssubj2ndnumsectopened" readonly></td>
                                <td class="totalrow"><input class="emc-inputtext " id="totalforecastservsubj" name="totalforecastservsubj" readonly></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>

            <script>
                var forecastServiceSubject1sem = 0;
                var forecastServiceSubject2sem = 0;
                var sumTotalForecastServiceSubject = 0;
                function updateTotalForecastServiceSubject() {
                    forecastServiceSubject1sem = 0;
                    forecastServiceSubject2sem = 0;
                    sumTotalForecastServiceSubject = 0;
                    $(".forecast-service-subject").each(function() {
                        let forecastValue = parseInt($(this).val());
                        if (forecastValue) {
                            sumTotalForecastServiceSubject += forecastValue;
                        }
                    });
                    $(".forecast-service-subject-1sem").each(function() {
                        let forecastValue = parseInt($(this).val());
                        if (forecastValue) {
                            forecastServiceSubject1sem += forecastValue;
                        }
                    });
                    $(".forecast-service-subject-2sem").each(function() {
                        let forecastValue = parseInt($(this).val());
                        if (forecastValue) {
                            forecastServiceSubject2sem += forecastValue;
                        }
                    });
                    $("#totalssubj1stnumsectopened").val(forecastServiceSubject1sem);
                    $("#totalssubj2ndnumsectopened").val(forecastServiceSubject2sem);
                    $("#totalforecastservsubj").val(sumTotalForecastServiceSubject);
                    $('#grandt1st').val(forecastServiceSubject1sem + parseInt($('#Total1ssection').val()) ?? 0);
                    $('#grand2nd').val(forecastServiceSubject2sem + parseInt($('#Total2ssection').val()));
                    $('#forecastgrandtotal').val(sumTotalForecastServiceSubject + parseInt($('#TotalSectionForecast').val()) ?? 0);
                }

                $(document).ready(function() {
                    var totalSubjectRow = 0;
                    $(".addsubj").click(function(e) {
                        e.preventDefault();
                        totalSubjectRow++;
                        var totalRow = $("#totalRowForServiceSubjects").closest('tr'); // Get the row containing the "Add Subject" button
                        var newRow = `
                            <tr class="appended-row">
                                <td class="action-buttons"><button class="addsubj remove-subj">Remove</button></td>
                                <td><input class="emc-inputtext" id="servsubj-${totalSubjectRow}" name="servsubj-${totalSubjectRow}[]" type="text" placeholder="Type here"></td>
                                <td><input class="emc-inputtext forecast-service-subject-1sem" id="ssubj1stnumsectopened-${totalSubjectRow}" name="ssubj1stnumsectopened-${totalSubjectRow}[]" type="number" placeholder="Type 0 if none."></td>
                                <td><input class="emc-inputtext forecast-service-subject-2sem" id="ssubj2ndnumsectopened-${totalSubjectRow}" name="ssubj2ndnumsectopened-${totalSubjectRow}[]" type="number" placeholder="Type 0 if none."></td>
                                <td class="totalrow"><input class="emc-inputtext forecast-service-subject" id="Total1s2sForecastServSubject-${totalSubjectRow}" name="Total1s2sForecastServSubject-${totalSubjectRow}" readonly></td>
                            </tr>
                        `;
                        totalRow.before(newRow); // Insert the new row after the current row

                        let ssubj1stnumsectopenedInput = document.getElementById(`ssubj1stnumsectopened-${totalSubjectRow}`);
                        let ssubj2ndnumsectopenedInput = document.getElementById(`ssubj2ndnumsectopened-${totalSubjectRow}`);
                        let total1s2sServSubjectInput = document.getElementById(`Total1s2sForecastServSubject-${totalSubjectRow}`);

                        let forecastSemester3Td = document.getElementById("forecastSemester3");

                        let calculateTotal1s2sServSubject = function() {
                            let ssubj1stnumsectopenedValue = parseFloat(ssubj1stnumsectopenedInput.value) || 0;
                            let ssubj2ndnumsectopenedValue = parseFloat(ssubj2ndnumsectopenedInput.value) || 0;

                            let total1s2sServSubject = ssubj1stnumsectopenedValue + ssubj2ndnumsectopenedValue * 0.02;
                            total1s2sServSubject = Math.ceil(total1s2sServSubject);
                            total1s2sServSubjectInput.value = total1s2sServSubject;

                            updateTotalForecastServiceSubject();
                        };

                        ssubj1stnumsectopenedInput.addEventListener("input", calculateTotal1s2sServSubject);
                        ssubj2ndnumsectopenedInput.addEventListener("input", calculateTotal1s2sServSubject);

                        function clearTotal1s2sServSubject() {
                            let ssubj1stnumsectopenedValue = parseFloat(ssubj1stnumsectopenedInput.value) || 0;
                            let ssubj2ndnumsectopenedValue = parseFloat(ssubj2ndnumsectopenedInput.value) || 0;
                            let forecastSemester3Value = forecastSemester3Td.textContent;

                            if ((ssubj1stnumsectopenedValue === 0 && forecastSemester3Value === "1st Semester") ||
                                (ssubj2ndnumsectopenedValue === 0 && forecastSemester3Value === "2nd Semester")) {
                                total1s2sServSubjectInput.value = "0";
                            } else if (forecastSemester3Value === "1st Semester" && ssubj2ndnumsectopenedValue === 0) {
                                total1s2sServSubjectInput.value = ssubj1stnumsectopenedValue;
                            } else if (forecastSemester3Value === "2nd Semester" && ssubj1stnumsectopenedValue === 0) {
                                total1s2sServSubjectInput.value = ssubj2ndnumsectopenedValue;
                            }
                        }

                        // Call the function initially
                        clearTotal1s2sServSubject();

                        // Add an event listener to the inputs if they change
                        ssubj1stnumsectopenedInput.addEventListener("input", clearTotal1s2sServSubject);
                        ssubj2ndnumsectopenedInput.addEventListener("input", clearTotal1s2sServSubject);
                        
                    });

            
                    $(document).on('click', '.remove-subj', function(e) {
                        e.preventDefault();
                        let row_item = $(this).closest('tr');
                        row_item.remove();
                        totalSubjectRow--;
                        updateTotalForecastServiceSubject();
                    });
            
                    // ajax request to insert form
                    $("#mforecastform").submit(function(e) {
                        e.preventDefault();
                        $("#save").val('Adding...');
            
                        $.ajax({
                            url: '/forecast/save/{forecast_num_id}',
                            method: 'post',
                            data: $(this).serialize(),
                            success: function(response) {
                                $("#addsubj").val('Add');
                                $("#mforecastform")[0].reset();
                                $(".appended-row").remove();
                            }
                        });
                    });

                    $(".faculty-member-type").change(function() {
                        let facultyMemberType = $(this).attr('faculty-member-type');
                        $("#numaddfacmemberSelectedType").val(facultyMemberType);
                        if (facultyMemberType == "Permanent-Full-time") {
                            $("#numaddfacmember").val($("#Jspermfull").val());
                        } else if (facultyMemberType == "Permanent-Part-time") {
                            $("#numaddfacmember").val($("#Jspermpart").val());
                        } else if (facultyMemberType == "Contractual-Full-time") {
                            $("#numaddfacmember").val($("#Jscontracfull").val());
                        } else {
                            $("#numaddfacmember").val($("#Jscontracpart").val());
                        }
                    });

                    $(".numberFacultySelector").change(function() {
                        let facultyMemberType = null;
                        $('.faculty-member-type').each(function(i, v){
                            if (this.checked) {
                                facultyMemberType = this.attributes["faculty-member-type"].value;
                                $("#numaddfacmemberSelectedType").val(facultyMemberType);
                            }
                        });
                        if (facultyMemberType == "Permanent-Full-time") {
                            $("#numaddfacmember").val($(this).val());
                        } else if (facultyMemberType == "Permanent-Part-time") {
                            $("#numaddfacmember").val($(this).val());
                        } else if (facultyMemberType == "Contractual-Full-time") {
                            $("#numaddfacmember").val($(this).val());
                        } else {
                            $("#numaddfacmember").val($(this).val());
                        }
                    });

                });
            </script>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Get references to the select element and target td elements
                    const semesterSelect = document.getElementById("semester");
                    const forecastSemesterTd = document.getElementById("forecastSemester");
                    const forecastSemesterTd2 = document.getElementById("forecastSemester2");
                    const forecastSemesterTd3 = document.getElementById("forecastSemester3");
                    const forecastSemesterTd4 = document.getElementById("forecastSemester4");
                    const forecastSemesterInput = document.getElementById("forecastSemesterInput"); // Hidden input field

                    // Add an event listener to the select element
                    semesterSelect.addEventListener("change", updateSemester);

                    // Function to update the content of the target td elements and input field
                    function updateSemester() {
                        const selectedOption = semesterSelect.value;
                        if (selectedOption === "1st Semester") {
                            forecastSemesterTd.textContent = "2nd Semester";
                            forecastSemesterTd2.textContent = "2nd Semester";
                            forecastSemesterTd3.textContent = "2nd Semester";
                            forecastSemesterTd4.textContent = "2nd Semester";
                        } else if (selectedOption === "2nd Semester") {
                            forecastSemesterTd.textContent = "1st Semester";
                            forecastSemesterTd2.textContent = "1st Semester";
                            forecastSemesterTd3.textContent = "1st Semester";
                            forecastSemesterTd4.textContent = "1st Semester";
                        }

                        forecastSemesterInput.value = forecastSemesterTd.textContent;
                    }
                });
            </script>

           <!--FORECAST TOTAL SERVICE SUBJ -->
            {{-- <script>
                var ssubj1stnumsectopenedInput = document.getElementById("ssubj1stnumsectopened");
                var ssubj2ndnumsectopenedInput = document.getElementById("ssubj2ndnumsectopened");

                // Total Student Forecast 1st Year 1st and 2nd Sem
                var total1s2sServSubjectInput = document.getElementById("Total1s2sForecastServSubject");

                var calculateTotal1s2sServSubject = function() {
                    var ssubj1stnumsectopenedValue = parseFloat(ssubj1stnumsectopenedInput.value) || 0;
                    var ssubj2ndnumsectopenedValue = parseFloat(ssubj2ndnumsectopenedInput.value) || 0;

                    var TotalServSubject = ssubj1stnumsectopenedValue + ssubj2ndnumsectopenedValue * 0.02;
                    TotalServSubject = Math.ceil(TotalServSubject); 
                    total1s2sServSubjectInput.value = TotalServSubject;

                    updateTotalForecastServiceSubject();
                };

                ssubj1stnumsectopenedInput.addEventListener("input", calculateTotal1s2sServSubject);
                ssubj1stnumsectopenedInput.addEventListener("input", calculateTotal1s2sServSubject);
            </script> --}}

            {{-- <script>
                var ssubj1stnumsectopenedInput = document.getElementById("ssubj1stnumsectopened");
                var ssubj2ndnumsectopenedInput = document.getElementById("ssubj2ndnumsectopened");

                // Total Student Forecast 1st Year 1st and 2nd Sem
                var total1s2sServSubjectInput = document.getElementById("Total1s2sForecastServSubject");

                var calculateTotal1s2sServSubject = function() {
                    var ssubj1stnumsectopenedValue = parseFloat(ssubj1stnumsectopenedInput.value) || 0;
                    var ssubj2ndnumsectopenedValue = parseFloat(ssubj2ndnumsectopenedInput.value) || 0;

                    // Check if ssubj1stnumsectopenedValue is greater than 0
                    if (ssubj1stnumsectopenedValue > 0) {
                        // Include ssubj1stnumsectopenedValue in the calculation
                        var TotalServSubject = ssubj1stnumsectopenedValue + ssubj2ndnumsectopenedValue * 0.02;
                    } else {
                        // Exclude ssubj1stnumsectopenedValue from the calculation
                        var TotalServSubject = ssubj2ndnumsectopenedValue * 0.02;
                    }

                    TotalServSubject = Math.ceil(TotalServSubject);
                    total1s2sServSubjectInput.value = TotalServSubject;

                    updateTotalForecastServiceSubject();
                };

                ssubj1stnumsectopenedInput.addEventListener("input", calculateTotal1s2sServSubject);
                ssubj2ndnumsectopenedInput.addEventListener("input", calculateTotal1s2sServSubject);
            </script> --}}

            
            <!-- GRAND TOTAL -->
            <div class="light-grey-grandtotal shadow">
                <h2> <b> <br>Grand Total (Professional/Major Subjects + Service Subjects) </b></h2>
                <div class="table-grand-total">
                    <table class="grand-total">
                        <tbody>
                            <tr>
                                <td></td> <!--TRY SAME VALUE -->
                                <td class="blue-header" id="td5"></td>
                                <td class="blue-header" id="td6"></td>
                                <td class="blue-header"><b>Forecast</b></td>
                            </tr>
                            <tr>
                                <td class="blue-header" rowspan="2"><b>Number of Sections</b></td>
                                <td><b>1st Semester</b></td>
                                <td><b>2nd Semester</b></td>
                                <td id="forecastSemester4"></td>

                            </tr>
                            <tr>
                                <td><input class="emc-inputtext" id="grandt1st" name="grandt1st" min="0" type="number" required readonly></td>
                                <td><input class="emc-inputtext" id="grand2nd" name="grand2nd" min="0" type="number" required readonly></td>
                                <td class="totalrow"><input class="emc-inputtext" id="forecastgrandtotal" name="forecastgrandtotal" readonly></td>
                            </tr>
                        </tbody>
                    </table> <br>
                </div>
            </div>

            

            {{-- <script>
                // Using JavaScript
                var selectElement = document.getElementById('aydropdown1s');
                var thElement1 = document.getElementById('aymajorsubj1s');
                var thElement2 = document.getElementById('ayservsubj1s');
                var thElement3 = document.getElementById('aygrandtotal1s');

                selectElement.addEventListener('change', function() {
                    thElement1.innerHTML = selectElement.value;
                    thElement2.innerHTML = selectElement.value;
                    thElement3.innerHTML = selectElement.value;
                });

                // Using jQuery
                $('#aydropdown1s').on('change', function() {
                    $('#aymajorsubj1s, #ayservsubj1s, #aygrandtotal1s').html('' + $(this).val());
                });


                // Using JavaScript
                var selectElement = document.getElementById('aydropdown2s');
                var thElement1 = document.getElementById('aymajorsubj2s');
                var thElement2 = document.getElementById('ayservsubj2s');
                var thElement2 = document.getElementById('aygrandtotal2s');

                selectElement.addEventListener('change', function() {
                    thElement1.innerHTML = selectElement.value;
                    thElement2.innerHTML = selectElement.value;
                    thElement3.innerHTML = selectElement.value;
                });

                // Using jQuery
                $('#aydropdown2s').on('change', function() {
                    $('#aymajorsubj2s, #ayservsubj2s, #aygrandtotal2s').html('' + $(this).val());
                });
            </script> --}}

            <div class="light-grey-signature shadow">
                <label for="signature-1" style="margin-top: 20px; margin-left: 20px;">Note: Attach your signature</label>
                <div class="grid-con-chairperson-dean">
                    <div class="chairperson-signature">
                        <div id="no-signature-box-1" style="border: 1px solid #6D6868; width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                            <img id="no-signature-preview-1" style="max-width: 100%; max-height: 100%; display: block;">
                            <img id="signature-preview-1" style="max-width: 100%; max-height: 80%; display: none; margin: 10px auto 0;">
                            <p id="chairpersonName" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">{{ $loggedInUser->name }}</p>
                        </div>
                    
                        <div id="signature-box-1" style="border: 1px solid #6D6868; width: 85%; height: 120px; margin-top: 10px; display: none;">
                            <div style="position: relative; width: 100%; height: 100%;">
                                <img id="signature-preview-img-1" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; max-width: 80%; max-height: 80%;" />
                                <p id="signature-name-1" style="position: absolute; bottom: 5px; left: 5px; font-size: 12px;"></p>
                            </div>
                        </div>
                    
                        <div class="text-chairperson-signature" style="margin-left: 27%; margin-top: 10px; text-decoration: underline;">
                            SECTION HEAD/CHAIRPERSON
                        </div>
                        <br>
                        <div style="display: flex; align-items: center;">
                            <input type="file" id="chairsignature" name="chairsignature" accept="image/*" onchange="previewSignature()" style="margin-right: 5px;" />
                            <a id="delete-signature-1" onclick="deleteSignature()" style="display: none;"><i class="material-icons" style="margin-top: 15%; margin-left: -30%;">&#xE5CD;</i></a>
                        </div>
                    </div>

                    <div class="dean-signature">
                        <div id="no-signature-box-2" style="border: 1px solid #6D6868; width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                            <img id="no-signature-preview-2" style="max-width: 100%; max-height: 100%; display: block;">
                            <img id="signature-preview-2" style="max-width: 100%; max-height: 80%; display: none; margin: 10px auto 0;">
                            <p id="no-signature-text-2" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                                @if ($loggedInUser->college === $deanCollege)
                                    {{ $deanUser->name }} <!-- Display dean's name if the colleges match -->
                                @endif
                            </p>
                        </div>
                    
                        <div id="signature-box-2" style="border: 1px solid #6D6868; width: 85%; height: 120px; margin-top: 10px; display: none;">
                            <div style="position: relative; width: 100%; height: 100%;">
                                <img id="signature-preview-img-2" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; max-width: 80%; max-height: 80%;" />
                                <p id="signature-name-2" style="position: absolute; bottom: 5px; left: 5px; font-size: 12px;"></p>
                            </div>
                        </div>
                    
                        <div class="text-chairperson-signature" style="margin-left: 34%; margin-top: 10px; text-decoration: underline;">
                            DIRECTOR/DEAN
                        </div>
                        <br>
                        <div style="display: flex; align-items: center;">
                            <input type="file" id="deansignature" name="deansignature" accept="image/*" onchange="previewSignature2()" style="margin-right: 5px;" />
                            <a id="delete-signature-2" onclick="deleteSignature2()" style="display: none;"><i class="material-icons" style="margin-top: 15%; margin-left: -30%;">&#xE5CD;</i></a>
                        </div>
                    </div><br>                  
                </div>

                <br>
                <button type="submit" id="save" class="btn btn-eval-save shadow-none" name="save">Save</button>
                <br>

                <script>
                    // JS FOR ATTACH SIGNATURE
                    function previewSignature() {
                        var signaturePreview = document.getElementById('signature-preview-1');
                        var signatureName = document.getElementById('signature-name-1');
                        var deleteSignatureBtn = document.getElementById('delete-signature-1');
                        var signatureBox = document.getElementById('signature-box-1');
                        var noSignatureBox = document.getElementById('no-signature-box-1');
                
                        noSignatureBox.style.background = '#fff'; // Set background to white
                        signaturePreview.style.display = 'block'; // Show the image
                        signaturePreview.src = URL.createObjectURL(event.target.files[0]); // Set the source of the image
                        signatureName.textContent = event.target.files[0].name; // Set the file name
                        deleteSignatureBtn.style.display = 'block'; // Show the delete button
                
                        document.getElementById('no-signature-preview-1').style.display = 'none';
                        document.getElementById('signature-preview-img-1').style.display = 'block';
                        }
                
                    function previewSignature2() {
                        var signaturePreview = document.getElementById('signature-preview-2');
                        var signatureName = document.getElementById('signature-name-2');
                        var deleteSignatureBtn = document.getElementById('delete-signature-2');
                        var signatureBox = document.getElementById('signature-box-2');
                        var noSignatureBox = document.getElementById('no-signature-box-2');
                
                        noSignatureBox.style.background = '#fff'; // Set background to white
                        signaturePreview.style.display = 'block'; // Show the image
                        signaturePreview.src = URL.createObjectURL(event.target.files[0]); // Set the source of the image
                        signatureName.textContent = event.target.files[0].name; // Set the file name
                        deleteSignatureBtn.style.display = 'block'; // Show the delete button
                
                        document.getElementById('no-signature-preview-2').style.display = 'none';
                        document.getElementById('signature-preview-img-2').style.display = 'block';
                    }
                
                    function deleteSignature() {
                        event.preventDefault();
                        var signaturePreview = document.getElementById('signature-preview-1');
                        var signatureName = document.getElementById('signature-name-1');
                        var deleteSignatureBtn = document.getElementById('delete-signature-1');
                        var signatureBox = document.getElementById('signature-box-1');
                        var signatureInput = document.getElementById('chairsignature');
                
                        signaturePreview.src = '';
                        signatureName.textContent = '';
                        deleteSignatureBtn.style.display = 'none';
                        signatureBox.style.display = 'none';
                        // signatureInput.value = '';

                        // Reset the file input value to clear the selected file
                        signatureInput.value = '';

                        // Replace the file input with a new one
                        var newInput = signatureInput.cloneNode(true);
                        signatureInput.parentNode.replaceChild(newInput, signatureInput);

                        // Restyle the new input if necessary (optional)
                        newInput.style.marginRight = '5px';
                
                        document.getElementById('no-signature-preview-1').style.display = 'block';
                        document.getElementById('signature-preview-img-1').style.display = 'none';
                    }
                
                    function deleteSignature2() {
                        event.preventDefault();
                        var signaturePreview = document.getElementById('signature-preview-2');
                        var signatureName = document.getElementById('signature-name-2');
                        var deleteSignatureBtn = document.getElementById('delete-signature-2');
                        var signatureBox = document.getElementById('signature-box-2');
                        var signatureInput = document.getElementById('deansignature');
                
                        signaturePreview.src = '';
                        signatureName.textContent = '';
                        deleteSignatureBtn.style.display = 'none';
                        signatureBox.style.display = 'none';
                        // signatureInput.value = '';

                        // Reset the file input value to clear the selected file
                        signatureInput.value = '';

                        // Replace the file input with a new one
                        var newInput = signatureInput.cloneNode(true);
                        signatureInput.parentNode.replaceChild(newInput, signatureInput);

                        // Restyle the new input if necessary (optional)
                        newInput.style.marginRight = '5px';
                
                        document.getElementById('no-signature-preview-2').style.display = 'block';
                        document.getElementById('signature-preview-img-2').style.display = 'none';
                    }
                
                    function displayDeleteButton() {
                        const signatureBox = document.getElementById("signature-box-1");
                        const deleteButton = signatureBox.querySelector("#delete-signature-1");
                        deleteButton.style.display = "block";
                    }
                
                    function displayDeleteButton2() {
                        const signatureBox = document.getElementById("signature-box-2");
                        const deleteButton = signatureBox.querySelector("#delete-signature-2");
                        deleteButton.style.display = "block";
                    } 
                </script>

                <script>
                    // Function to enable/disable the chairperson and dean input fields
                    function enableDisableInputFields() {
                        var chairsignatureInput = document.getElementById("chairsignature");
                        var deansignatureInput = document.getElementById("deansignature");
                        var loggedInUserPosition = "{{$loggedInUserPosition}}"; // Assuming you've passed the position to the view

                        // Check if the logged-in user is a chairperson or dean (case-sensitive)
                        if (loggedInUserPosition === "Chairperson") {
                            // Enable the chairperson input field
                            chairsignatureInput.disabled = false;
                            // Disable the dean input field
                            deansignatureInput.disabled = true;
                        } else if (loggedInUserPosition === "Dean") {
                            // Enable the dean input field
                            deansignatureInput.disabled = false;
                            // Disable the chairperson input field
                            chairsignatureInput.disabled = true;
                        }
                    }

                    // Call the function when the page loads
                    window.onload = function () {
                        enableDisableInputFields();

                        // You may also need to call the function whenever the user's position changes.
                        // For example, if there's a dropdown or button that allows the user to change their position.
                    };
                </script>   
            </div>
            <br><br>
        </div>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            function fetchProfessionalMajorSubjects() {
                let selectedAy = $("#ay").val();
                let selectedSemester = $("#semester").val();

                $("#studentpop1y2s").val(null);
                $("#studentpop2y2s").val(null);
                $("#studentpop3y2s").val(null);
                $("#studentpop4y2s").val(null);
                $("#studentpop5y2s").val(null);
                $("#Total2sstudent").val(null);

                $("#numsectopened1y2s").val(null);
                $("#numsectopened2y2s").val(null);
                $("#numsectopened3y2s").val(null);
                $("#numsectopened4y2s").val(null);
                $("#numsectopened5y2s").val(null);
                $("#Total2ssection").val(null);

                $("#studentpop1y1s").val(null);
                $("#studentpop2y1s").val(null);
                $("#studentpop3y1s").val(null);
                $("#studentpop4y1s").val(null);
                $("#studentpop5y1s").val(null);
                $("#Total1sstudent").val(null);

                $("#numsectopened1y1s").val(null);
                $("#numsectopened2y1s").val(null);
                $("#numsectopened3y1s").val(null);
                $("#numsectopened4y1s").val(null);
                $("#numsectopened5y1s").val(null);
                $("#Total1ssection").val(null);


                if (selectedAy && selectedSemester) {
                    $.ajax({
                        url: `/api/forecasting/professionalMajorSubjects/${selectedAy}/${selectedSemester}`,
                        method: 'get',
                        success: function(response) {
                            console.log(response);
                            if (selectedSemester == "1st Semester") {
                                $("#studentpop1y2s").val(response.studentpop1y2s);
                                $("#studentpop2y2s").val(response.studentpop2y2s);
                                $("#studentpop3y2s").val(response.studentpop3y2s);
                                $("#studentpop4y2s").val(response.studentpop4y2s);
                                $("#studentpop5y2s").val(response.studentpop5y2s);
                                $("#Total2sstudent").val(response.Total2sstudent);

                                $("#numsectopened1y2s").val(response.numsectopened1y2s);
                                $("#numsectopened2y2s").val(response.numsectopened2y2s);
                                $("#numsectopened3y2s").val(response.numsectopened3y2s);
                                $("#numsectopened4y2s").val(response.numsectopened4y2s);
                                $("#numsectopened5y2s").val(response.numsectopened5y2s);
                                $("#Total2ssection").val(response.Total2ssection);
                            } else {
                                $("#studentpop1y1s").val(response.studentpop1y1s);
                                $("#studentpop2y1s").val(response.studentpop2y1s);
                                $("#studentpop3y1s").val(response.studentpop3y1s);
                                $("#studentpop4y1s").val(response.studentpop4y1s);
                                $("#studentpop5y1s").val(response.studentpop5y1s);
                                $("#Total1sstudent").val(response.Total1sstudent);

                                
                                $("#numsectopened1y1s").val(response.numsectopened1y1s);
                                $("#numsectopened2y1s").val(response.numsectopened2y1s);
                                $("#numsectopened3y1s").val(response.numsectopened3y1s);
                                $("#numsectopened4y1s").val(response.numsectopened4y1s);
                                $("#numsectopened5y1s").val(response.numsectopened5y1s);
                                $("#Total1ssection").val(response.Total1ssection);
                            }
                        }
                    });
                }
            }

            $("#ay").change(function() {
                fetchProfessionalMajorSubjects();
            });

            $("#semester").change(function() {
                fetchProfessionalMajorSubjects();
            });
        });
    </script>

  </body>
</html>