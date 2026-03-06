@extends('layouts.app')
 
@section('body')

<form id="approve-modal" action="{{ route('approvaldashboard.updateForecastForm', $forecastSection1->forecast_num_id) }}" method="POST" enctype="multipart/form-data" style="display:inline;">
    @csrf
    @method('PUT')

    <!-- BACK TO DASHBOARD AND PRINT DOCUMENT -->
    <style>
    @media print {
        .navbar{
            display:block !important;
        }
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
        <a class="text-showmrform-backtodashboard" id="back" href="{{route('approvaldashboard.index')}}">Go back to Dashboard</a>
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

        function previewSignature3() {
            var signaturePreview = document.getElementById('signature-preview-3');
            var signatureName = document.getElementById('signature-name-3');
            var deleteSignatureBtn = document.getElementById('delete-signature-3');
            var signatureBox = document.getElementById('signature-box-3');
            var noSignatureBox = document.getElementById('no-signature-box-3');

            noSignatureBox.style.background = '#fff'; // Set background to white
            signaturePreview.style.display = 'block'; // Show the image
            signaturePreview.src = URL.createObjectURL(event.target.files[0]); // Set the source of the image
            signatureName.textContent = event.target.files[0].name; // Set the file name
            deleteSignatureBtn.style.display = 'block'; // Show the delete button

            document.getElementById('no-signature-preview-3').style.display = 'none';
            document.getElementById('signature-preview-img-3').style.display = 'block';
        }

        function previewSignature4() {
            var signaturePreview = document.getElementById('signature-preview-4');
            var signatureName = document.getElementById('signature-name-4');
            var deleteSignatureBtn = document.getElementById('delete-signature-4');
            var signatureBox = document.getElementById('signature-box-4');
            var noSignatureBox = document.getElementById('no-signature-box-4');

            noSignatureBox.style.background = '#fff'; // Set background to white
            signaturePreview.style.display = 'block'; // Show the image
            signaturePreview.src = URL.createObjectURL(event.target.files[0]); // Set the source of the image
            signatureName.textContent = event.target.files[0].name; // Set the file name
            deleteSignatureBtn.style.display = 'block'; // Show the delete button

            document.getElementById('no-signature-preview-4').style.display = 'none';
            document.getElementById('signature-preview-img-4').style.display = 'block';
        }

        function deleteSignature() {
            var signaturePreview = document.getElementById('signature-preview-1');
            var signatureName = document.getElementById('signature-name-1');
            var deleteSignatureBtn = document.getElementById('delete-signature-1');
            var signatureBox = document.getElementById('signature-box-1');
            var signatureInput = document.getElementById('signature-1');

            signaturePreview.src = '';
            signatureName.textContent = '';
            deleteSignatureBtn.style.display = 'none';
            signatureBox.style.display = 'none';
            signatureInput.value = '';

            document.getElementById('no-signature-preview-1').style.display = 'block';
            document.getElementById('signature-preview-img-1').style.display = 'none';
        }

        function deleteSignature2() {
            var signaturePreview = document.getElementById('signature-preview-2');
            var signatureName = document.getElementById('signature-name-2');
            var deleteSignatureBtn = document.getElementById('delete-signature-2');
            var signatureBox = document.getElementById('signature-box-2');
            var signatureInput = document.getElementById('signature-2');

            signaturePreview.src = '';
            signatureName.textContent = '';
            deleteSignatureBtn.style.display = 'none';
            signatureBox.style.display = 'none';
            signatureInput.value = '';

            document.getElementById('no-signature-preview-2').style.display = 'block';
            document.getElementById('signature-preview-img-2').style.display = 'none';
        }

        function deleteSignature3() {
            var signaturePreview = document.getElementById('signature-preview-3');
            var signatureName = document.getElementById('signature-name-3');
            var deleteSignatureBtn = document.getElementById('delete-signature-3');
            var signatureBox = document.getElementById('signature-box-3');
            var signatureInput = document.getElementById('directorsignature');

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

            document.getElementById('no-signature-preview-3').style.display = 'block';
            document.getElementById('signature-preview-img-3').style.display = 'none';
        }

        function deleteSignature4() {
            var signaturePreview = document.getElementById('signature-preview-4');
            var signatureName = document.getElementById('signature-name-4');
            var deleteSignatureBtn = document.getElementById('delete-signature-4');
            var signatureBox = document.getElementById('signature-box-4');
            var signatureInput = document.getElementById('vpasignature');

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

            document.getElementById('no-signature-preview-4').style.display = 'block';
            document.getElementById('signature-preview-img-4').style.display = 'none';
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

        function displayDeleteButton3() {
            const signatureBox = document.getElementById("signature-box-3");
            const deleteButton = signatureBox.querySelector("#delete-signature-3");
            deleteButton.style.display = "block";
        }

        function displayDeleteButton4() {
            const signatureBox = document.getElementById("signature-box-4");
            const deleteButton = signatureBox.querySelector("#delete-signature-4");
            deleteButton.style.display = "block";
        }

    </script>

    <!-- TITLE FORM -->
    <div class="mforecastform-grid-container shadow">
        <div class="mforecastform-grid-con-title">
            <div class="mforecastform-text-title">
                Form    
            </div>
            <div class="mforecastform-text-title">
                @if ($forecastSection1->approval_status == 'Waiting for Approval')
                    <button type="submit" class="btn btn-approveform btn-primary" id="save" style="float:right; margin-right:1%; margin-left: 1%;">Save Attached Signature</button>
                @else
                    <a style="float: right; margin-right: 2%">{{ $forecastSection1->approval_status }}</a>
                @endif
            </div>
        </div>
    </div>
    <!-- MAIN CONTENT -->    
    <div class="dark-grey-background shadow">
        <input type="number" class="dropdownbox-num_id" value="{{ $forecastSection1->forecast_num_id }}" readonly name="forecast_num_id">
            <h1><b> <br> <br>Manpower Forecast Form <br><br></b></h1> 
        
        <!--DROPDOWN DEPARTMENT-->
        <div class="dropdownsection">
            <table class="table-fmanpower-form">
                <tbody>
                    <tr> <!--PAG CLICK COLLEGE DEPENDS YUNG LAMAN NG DEPARTMENT-->
                        <td class="dropsec-title"> College:</td>
                        <td class="dropsec-contents-colleges"> 
                            <div style="width: 100%;">
                                <input type="number" style="width: 97%; display: none;" min="0" name="num_emp_required" readonly>
                                <span>{{ $forecastSection1->college  }}</span>
                            </div>
                          <!--  <input type="text" class="dropwdown-select-colleges" style="width: 97%; display: none;" value="{{ $forecastSection1->college }}" id="college" name="college" readonly>
                        <select class="dropwdown-select-colleges" id="colleges" readonly  name="colleges" onchange="updateDepartments()">
                                <option disabled selected value="" class="optiondisabled">Select</option>
                                <option value="science">Science</option>
                                <option value="architecture">Architecture</option>
                                <option value="engineering">Engineering</option>
                            </select> -->
                        </td>
                        <td class="dropsec-title1"> Department:</td>
                        <td class="dropsec-contents-dep"> 
                            <div style="width: 100%;">
                                <input type="number" style="width: 97%; display: none;" min="0" name="num_emp_required" readonly>
                                <span>{{ $forecastSection1->department  }}</span>
                            </div>
                            {{-- <input type="text" class="dropwdown-select-department" value="{{ $forecastSection1->department }}" id="department" name="department"  readonly>
                          <select class="dropwdown-select-department" readonly  id="departments" name="departments"> 
                                <option disabled selected value="" class="optiondisabled">Select</option>  
                            </select> --}}
                        </td>

                        <script>
                            function updateDepartments() {
                                var collegeDropdown = document.getElementById("colleges");
                                var departmentDropdown = document.getElementById("departments");
                                var selectedCollege = collegeDropdown.value;

                                // Clear existing options
                                departmentDropdown.innerHTML = '<option disabled selected value="">Select</option>';

                                // Add department options based on the selected college
                                if (selectedCollege === "science") {
                                    departmentDropdown.innerHTML += '<option value="COS_informationTechnology">Information Technology</option>';
                                    departmentDropdown.innerHTML += '<option value="COS_informationSystem">Information System</option>';
                                    departmentDropdown.innerHTML += '<option value="COS_computerScience">Computer Science</option>';
                                } else if (selectedCollege === "architecture") {
                                    departmentDropdown.innerHTML += '<option value="architecture_department1">Architecture Department 1</option>';
                                } else if (selectedCollege === "engineering") {
                                    departmentDropdown.innerHTML += '<option value="engineering_department1">Engineering Department 1</option>';
                                    departmentDropdown.innerHTML += '<option value="engineering_department2">Engineering Department 2</option>';
                                    departmentDropdown.innerHTML += '<option value="engineering_department3">Engineering Department 3</option>';
                                }
                            }
                        </script> <!--END OF PAG CLICK COLLEGE DEPENDS YUNG LAMAN NG DEPARTMENT-->

                        <td class="dropsec-title2"> Academic Year:</td>
                        <td class="dropsec-contents-ay"> 
                            <div style="width: 100%;">
                                <input type="number" style="width: 97%; display: none;" min="0" name="num_emp_required" readonly>
                                <span>{{ $forecastSection1->ay  }}</span>
                            </div>
                           <!--  <input type="text" class="dropwdown-select" value="{{ $forecastSection1->ay }}" id="ay" name="ay"  readonly>
                               <select class="dropwdown-select" readonly  id="ay" name="ay">
                                    <option disabled selected value="" class="optiondisabled">Select</option>
                                    <option value="2020-2021">2020-2021</option>
                                    <option value="2021-2022">2021-2022</option>
                                    <option value="2022-2023">2022-2023</option>
                                    <option value="2023-2024">2023-2024</option>
                                </select> -->
                        </td>

                        {{-- <td class="dropsec-title3">Number of Teachers Required:</td>
                        <td class="dropsec-contents-numteacreq" >
                            <input type="number" class="dropdownbox-teach" min="1" value="{{ $forecastSection1->noTeachRequ }}" readonly  id="noTeachRequ" name="noTeachRequ">
                        </td> --}}

                        <td class="dropsec-title4"> Semester:</td>
                        <td class="dropsec-contents-sem">
                            <div style="width: 100%;">
                                <input type="number" style="width: 97%; display: none;" min="0" name="num_emp_required" readonly>
                                <span>{{ $forecastSection1->semester  }}</span>
                            </div>
                            <!-- <input type="text" class="dropwdown-select-sem" value="{{ $forecastSection1->semester }}" id="semester" name="semester"  readonly>
                               <select class="dropwdown-select-sem" value="{{ $forecastSection1->semester }}" readonly  id="semester" name="semester">
                                    <option disabled selected value="">Select</option>
                                    <option value="1stsemester">1st Semester</option>
                                    <option value="2ndsemester">2nd Semester</option>
                                </select>-->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
                
        <!--EXISTING MANPOWER COMPLEMENT-->
        <div class="light-grey-existingmanpower shadow" style="padding: 10px;">
            <h2><b> <br> Existing Manpower Complement</b></h2>
            <table class="forecasting-EMC">
                <tbody>
                <tr>
                    <td class="emc-titlecol">No. of Full-time Permanent:</td>
                    <td class="emc-inputtxt"><span>{{ $forecastSection2->fulltimeperm  }}</span></td>
                    <td class="emc-titlecol">No. of Part-time Permanent:</td>
                    <td class="emc-inputtxt"><span>{{ $forecastSection2->parttimeperm  }}</span></td>
                    <td class="emc-total"><button class="totalbtn" name="totalbutton" disabled ><b>Total</b></button></td>
                    <td class="emc-inputtxt"><span></span></td>
                </tr>
                <tr>
                    <td class="emc-titlecol">No. of Full-time Contractual:</td>
                    <td class="emc-inputtxt"><span>{{ $forecastSection2->fulltimecontrac  }}</span></td>
                    <td class="emc-titlecol">No. of Part-time Contractual:</td>
                    <td class="emc-inputtxt"><span>{{ $forecastSection2->parttimecontrac  }}</span></td>
                    <td class="emc-total"><button class="totalbtn" name="totalbutton"disabled ><b>Total</b></button></td>
                    <td class="emc-inputtxt"><span></span></td>
                </tr>
                </tbody>
            </table>
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

            calculateTotalPerm();
            calculateTotalCon();
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
                        </tr>
                        @foreach ($forecastSection3 as $i => $row)
                            {{-- @if (is_array($row) && $row['forecast_num_id'] == $forecast_num_id) --}}
                                <tr class="original-row">
                                    <td>
                                        <input type="text" class="namefacreplace" value="{{ $row['namefacreplace'] }}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="reasonreplace" value="{{ $row['reasonreplace'] }}" readonly>
                                    </td>
                                    <td>
                                        <input class="reasonforhiring" name="reasonforhiring[]" required type="text" value="{{ $row['reasonforhiring'] }}" readonly>
                                    </td>
                                </tr>
                            {{-- @endif --}}
                        @endforeach
                    </tbody>
                </table>
                <br>
            </div>
        </div>
        
        {{-- <script>
            var forecast_num_id = @json($forecastSection1->pluck('forecast_num_id'));
            var namefacreplace = @json($forecastSection3->pluck('namefacreplace'));
            var reasonreplace = @json($forecastSection3->pluck('reasonreplace'));
            var reasonforhiring = @json($forecastSection3->pluck('reasonforhiring'));
            var freplacement_id = @json($forecastSection3->pluck('forecast_num_id'));
        
            // Wait for the document to be ready
            $(document).ready(function() {
                // Get the table element
                var table = $('.tablefr-overall-status tbody');
        
                // Loop through the forecast_num_id array of $forecastSection1
                for (var i = 0; i < forecast_num_id.length; i++) {
                    // Get the index of the element with matching forecast_num_id in the $forecastSection3 table
                    var index = freplacement_id.indexOf(forecast_num_id[i]);
                    if (index !== -1) { // Check if the element exists
                        var row = $('<tr>');
                        var nameCell = $('<td>').html($('<input>').attr({
                            type: 'text',
                            class: 'namefacreplace',
                            value: namefacreplace[index],
                            readonly: true,
                        }));
                        var reasonReplaceCell = $('<td>').html($('<input>').attr({
                            type: 'text',
                            class: 'reasonreplace',
                            value: reasonreplace[index],
                            readonly: true,
                        }));
                        var reasonHiringCell = $('<td>').html($('<input>').attr({
                            type: 'text',
                            class: 'reasonforhiring',
                            name: 'reasonforhiring[]',
                            required: true,
                            value: reasonforhiring[index],
                        }));
        
                        // Add the cells to the row
                        row.append(nameCell);
                        row.append(reasonReplaceCell);
                        row.append(reasonHiringCell);
        
                        // Add the row to the table
                        table.append(row);
                    }
                }
            });
        </script> --}}
        <!--END OF ADD BUTTON!! -->
        <div class="light-grey-jobspecification shadow">
            <br>
            <table class="table-num-add-fac">
                <tbody>
                    <tr>
                        <td colspan="4">
                            <div class="grid-con-num-add-fac-member" >
                                <label for="numaddfacmember"style="text-align:left"><b>Number of Additional Faculty Members for this S.Y.: </b></label>
                                <span><span>{{ $forecastSection4->numaddfacmember }}</span> </span>
                                {{-- <input id="Numaddfacmember" name="numaddfacmember" type="number" value="{{ <span>{{ $forecastSection2->total }}</span> }}" readonly  style="width: 5em; margin-left: 10px;"> --}}
                            </div>
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <div class="employment-stat-first-column">
                                <label for="Jspermfull">Permanent Full-time:</label>
                                <span>{{ $forecastSection4->jspermfull }}</span>
                                {{-- <input id="Jspermfull" name="jspermfull" type="number" value="{{ $forecastSection4->jspermfull }}" readonly  style="width: 5em; margin-left: 10px;"> --}}
                            </div>
                        </td>
                        <td>
                            <div class="employment-stat-second-column">
                                <label for="Jspermpart">Permanent Part-time:</label>
                                <span>{{ $forecastSection4->jspermpart }}</span>
                                {{-- <input id="Jspermpart" name="jspermpart" type="number" value="{{ $forecastSection4->jspermpart }}" readonly  style="width: 5em; margin-left: 10px;"> --}}
                            </div>
                        </td>
                        <td>
                            <div class="employment-stat-third-column">
                                <label for="Jscontracfull">Contractual Full-time:</label>
                                <span>{{ $forecastSection4->jscontracfull }}</span>
                                {{-- <input id="Jscontracfull" name="jscontracfull" type="number" value="{{ $forecastSection4->jscontracfull }}" readonly  style="width: 5em; margin-left: 10px;"> --}}
                            </div>
                        </td>
                        <td>
                            <div class="employment-stat-fourth-column">
                                <label for="Jscontracpart">Contractual Part-time:</label>
                                <span>{{ $forecastSection4->jscontracpart }}</span>
                                {{-- <input id="Jscontracpart" name="jscontracpart" type="number" value="{{ $forecastSection4->jscontracpart }}" readonly  style="width: 5em; margin-left: 10px;"> --}}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
                <script>
                    var JspermfullInput = document.getElementById("Jspermfull");
                    var JspermpartInput = document.getElementById("Jspermpart");
                    var JscontracfullInput = document.getElementById("Jscontracfull");
                    var JscontracpartInput = document.getElementById("Jscontracpart");
                    var totaljsInput = document.getElementById("Numaddfacmember");
                
                    var calculateTotaljs = function() {
                        var JspermfullValue = parseFloat(JspermfullInput.value) || 0;
                        var JspermpartValue = parseFloat(JspermpartInput.value) || 0;
                        var JscontracfullValue = parseFloat(JscontracfullInput.value) || 0;
                        var JscontracpartValue = parseFloat(JscontracpartInput.value) || 0;
        
                        var total = JspermfullValue + JspermpartValue + JscontracfullValue +JscontracpartValue;
                        totaljsInput.value = total;
                    };
                
                    JspermfullInput.addEventListener("input", calculateTotaljs);
                    JspermpartInput.addEventListener("input", calculateTotaljs);
                    JscontracfullInput.addEventListener("input", calculateTotaljs);
                    JscontracpartInput.addEventListener("input", calculateTotaljs);
                    calculateTotaljs();
                </script>

                {{-- <style>
                    .grid-con-text-jobspecif{
                        align-content: left;
                    }
                </style> --}}

            <table class="table-jobspecification">
                <div class="grid-con-text-jobspecif">
                    <h2> <b> <br>Job Specification</h2> </b>
                </div>
                <tbody>
                    <tr>
                        <td>Bachelor's Degree:</td>
                        <td>
                            <span>{{ $forecastSection5->jsbachelor }}</span>
                            {{-- <input type="text" id="jsbachelor" name="jsbachelor" value="{{ $forecastSection5->jsbachelor }}" readonly  style="width: 500px; height: 25px;"> --}}
                        </td>
                    </tr>
                    <tr>
                        <td>Master's Degree:</td>
                        <td> 
                            <span>{{ $forecastSection5->jsmasters }}</span>
                            {{-- <input type="text" id="jsmasters" name="jsmasters" value="{{ $forecastSection5->jsmasters }}" readonly  style="width: 500px; height: 25px;"> --}}
                        </td>
                    </tr>
                    <tr>
                        <td>Allied Programs: (Other courses/program that can  considered)</td>
                        <td>
                            <span style=" align-content: left;">{{ $forecastSection5->jsalliedprog }}</span>
                            {{-- <input type="text" id="jsalliedprog" name="jsalliedprog" value="{{ $forecastSection5->jsalliedprog }}" readonly  style="width: 500px; height: 25px;"> --}}
                        </td>
                    </tr>
                    <tr>
                        <td>Years of teaching experience:</td>
                        <td>
                            <span>{{ $forecastSection5->yrsofteachexp }}</span>
                            {{-- <input type="text" id="yrsofteachexp" name="yrsofteachexp" value="{{ $forecastSection5->yrsofteachexp }}" readonly  style="width: 500px; height: 25px;"> --}}
                        </td>
                    </tr>
                    <tr>
                        <td>Technical Skills:</td>
                        <td>
                            <span>{{ $forecastSection5->technicalskills }}</span>
                            {{-- <input type="text" id="technicalskills" name="technicalskills" value="{{ $forecastSection5->technicalskills }}" readonly  style="width: 500px; height: 25px;"> --}}
                        </td>
                    </tr>
                    <tr>
                        <td>Interpersonal Skills:</td>
                        <td>
                            <span>{{ $forecastSection5->interpersonalskills }}</span>
                            {{-- <input type="text" id="interpersonalskills" name="interpersonalskills" value="{{ $forecastSection5->interpersonalskills }}" readonly  style="width: 500px; height: 25px;"> --}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div>
        <!-- A. FOR PROFESSIONAL/MAJOR SUBJECTS -->
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
                            <td class="blue-header"><b>{{"$forecastSection6->aydropdown1s"}}</b></td>
                            <td class="blue-header"><b>{{"$forecastSection6->aydropdown2s"}}</b></td>
                            <td class="blue-header">{{"$forecastSection6->forecastSemester"}}</td>
                            <td class="blue-header"><b>{{"$forecastSection6->aydropdown1s"}}</b></td>
                            <td class="blue-header"><b>{{"$forecastSection6->aydropdown2s"}}</b></td>
                            <td class="blue-header">{{"$forecastSection6->forecastSemester"}}</td>
                        </tr>
                        <tr>
                            <td >1st Semester</td>
                            <td>2nd Semester</td>
                            <td>Forecast</td>
                            <td>1st Semester</td>
                            <td>2nd Semester</td>
                            <td>Forecast</td>
                        </tr>
                        <tr> <!--IM HEEEREEEEE-->
                            <td>1st Year</td>
                            <td><input class="emc-inputtext" id="studentpop1y1s" name="studentpop1y1s" value="{{ $forecastSection6->studentpop1y1s }}" readonly   min="0" type="number" placeholder="Type here"></td>
                            <td><input class="emc-inputtext"  id="studentpop1y2s" name="studentpop1y2s" value="{{ $forecastSection6->studentpop1y2s }}" readonly   min="0"type="number" placeholder="Type here"></td>
                            <td class="totalrow"><input class="emc-inputtext" id="Total1y1s2sstudent" name="Total1y1s2sstudent" value="{{ $forecastSection6->Total1y1s2sstudent }}"readonly></td>
                            <td><input class="emc-inputtext" id="numsectopened1y1s" name="numsectopened1y1s" value="{{ $forecastSection6->numsectopened1y1s }}" readonly   min="0"type="number" placeholder="Type here"></td>
                            <td><input class="emc-inputtext" id="numsectopened1y2s" name="numsectopened1y2s" value="{{ $forecastSection6->numsectopened1y2s }}" readonly   min="0"type="number" placeholder="Type here"></td>
                            <td class="totalrow"><input class="emc-inputtext" id="Total1y1s2ssection" name="Total1y1s2ssection" value="{{ $forecastSection6->Total1y1s2ssection }}" readonly></td>
                        </tr>
                        <tr>
                            <td>2nd Year</td>
                            <td><input class="emc-inputtext" id="studentpop2y1s" name="studentpop2y1s" value="{{ $forecastSection6->studentpop2y1s }}" readonly   type="number" min="0"placeholder="Type here"></td>
                            <td><input class="emc-inputtext"  id="studentpop2y2s" name="studentpop2y2s" value="{{ $forecastSection6->studentpop2y2s }}" readonly   type="number" min="0"placeholder="Type here"></td>
                            <td class="totalrow"><input class="emc-inputtext" id="Total2y1s2sstudent" name="Total2y1s2sstudent" value="{{ $forecastSection6->Total2y1s2sstudent }}" readonly></td>
                            <td><input class="emc-inputtext" id="numsectopened2y1s" name="numsectopened2y1s" value="{{ $forecastSection6->numsectopened2y1s }}" readonly   min="0"type="number" placeholder="Type here"></td>
                            <td><input class="emc-inputtext" id="numsectopened2y2s" name="numsectopened2y2s" value="{{ $forecastSection6->numsectopened2y2s }}" readonly   min="0"type="number" placeholder="Type here"></td>
                            <td class="totalrow"><input class="emc-inputtext" id="Total2y1s2ssection" name="Total2y1s2ssection" value="{{ $forecastSection6->Total2y1s2ssection }}" readonly></td>
                        </tr>
                        <tr>
                            <td>3rd Year</td>
                            <td><input class="emc-inputtext" id="studentpop3y1s" name="studentpop3y1s" value="{{ $forecastSection6->studentpop3y1s }}" readonly  type="number" min="0"placeholder="Type here"></td>
                            <td><input class="emc-inputtext"  id="studentpop3y2s" name="studentpop3y2s" value="{{ $forecastSection6->studentpop3y2s }}" readonly  type="number" min="0"placeholder="Type here"></td>
                            <td class="totalrow"><input class="emc-inputtext" id="Total3y1s2sstudent" name="Total3y1s2sstudent" value="{{ $forecastSection6->Total3y1s2sstudent }}" readonly></td>
                            <td><input class="emc-inputtext" id="numsectopened3y1s" name="numsectopened3y1s" value="{{ $forecastSection6->numsectopened3y1s }}" readonly  type="number" min="0"placeholder="Type here"></td>
                            <td><input class="emc-inputtext" id="numsectopened3y2s" name="numsectopened3y2s" value="{{ $forecastSection6->numsectopened3y2s }}" readonly  type="number" min="0"placeholder="Type here"></td>
                            <td class="totalrow"><input class="emc-inputtext" id="Total3y1s2ssection" name="Total3y1s2ssection" value="{{ $forecastSection6->Total3y1s2ssection }}" readonly></td>
                        </tr>
                        <tr>
                            <td>4th Year</td>
                            <td><input class="emc-inputtext" id="studentpop4y1s" name="studentpop4y1s" value="{{ $forecastSection6->studentpop4y1s }}" readonly  type="number" min="0"placeholder="Type here"></td>
                            <td><input class="emc-inputtext"  id="studentpop4y2s" name="studentpop4y2s" value="{{ $forecastSection6->studentpop4y2s }}" readonly  type="number"min="0" placeholder="Type here"></td>
                            <td class="totalrow"><input class="emc-inputtext" id="Total4y1s2sstudent" name="Total4y1s2sstudent" value="{{ $forecastSection6->Total4y1s2sstudent }}" readonly></td>
                            <td><input class="emc-inputtext" id="numsectopened4y1s" name="numsectopened4y1s" value="{{ $forecastSection6->numsectopened4y1s }}" readonly  min="0" type="number" placeholder="Type here"></td>
                            <td><input class="emc-inputtext" id="numsectopened4y2s" name="numsectopened4y2s" value="{{ $forecastSection6->numsectopened4y2s }}" readonly  min="0"type="number" placeholder="Type here"></td>
                            <td class="totalrow"><input class="emc-inputtext" id="Total4y1s2ssection" name="Total4y1s2ssection" value="{{ $forecastSection6->Total4y1s2ssection }}" readonly></td>
                        </tr>
                        <tr>
                            <td>5th Year</td>
                            <td><input class="emc-inputtext" id="studentpop5y1s" name="studentpop5y1s" value="{{ $forecastSection6->studentpop5y1s }}" readonly  min="0"type="number" placeholder="Type here"></td>
                            <td><input class="emc-inputtext"  id="studentpop5y2s" name="studentpop5y2s" value="{{ $forecastSection6->studentpop5y2s }}" readonly  min="0" type="number" placeholder="Type here"></td>
                            <td class="totalrow"><input class="emc-inputtext" id="Total5y1s2sstudent" name="Total5y1s2sstudent" value="{{ $forecastSection6->Total5y1s2sstudent }}" readonly></td>
                            <td><input class="emc-inputtext" id="numsectopened5y1s" name="numsectopened5y1s" value="{{ $forecastSection6->numsectopened5y1s }}" readonly  min="0"type="number" placeholder="Type here"></td>
                            <td><input class="emc-inputtext" id="numsectopened5y2s" name="numsectopened5y2s" value="{{ $forecastSection6->numsectopened5y2s }}" readonly  min="0" type="number" placeholder="Type here"></td>
                            <td class="totalrow"><input class="emc-inputtext" id="Total5y1s2ssection" name="Total5y1s2ssection" value="{{ $forecastSection6->Total5y1s2ssection }}" readonly></td>
                        </tr>
                        <tr>
                            <td><button class="totalbtnmajorsubj" id="Total-A" disabled><b>Total</b></button></td>
                            <td><input class="emc-inputtext" id="Total1sstudent" name="Total1sstudent" value="{{ $forecastSection6->Total1sstudent }}" readonly></td>
                            <td><input class="emc-inputtext" id="Total2sstudent" name="Total2sstudent" value="{{ $forecastSection6->Total2sstudent }}" readonly></td>
                            <td class="totalrow"><input class="emc-inputtext" id="TotalStudentForecast" name="TotalStudentForecast" value="{{ $forecastSection6->TotalStudentForecast }}" readonly></td>
                            <td><input class="emc-inputtext" id="Total1ssection" name="Total1ssection" value="{{ $forecastSection6->Total1ssection }}" readonly></td>
                            <td><input class="emc-inputtext" id="Total2ssection" name="Total2ssection" value="{{ $forecastSection6->Total2ssection }}" readonly></td>
                            <td class="totalrow"><input class="emc-inputtext" id="TotalSectionForecast" name="TotalSectionForecast" value="{{ $forecastSection6->TotalSectionForecast }}" readonly></td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>
        </div>

        <script>
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

                var total = studentpop1y1sValue + studentpop2y1sValue + studentpop3y1sValue +studentpop4y1sValue + studentpop5y1sValue;
                total1sInput.value = total;
            };
            calculateTotal1sstud();
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

                var total = studentpop1y2sValue + studentpop2y2sValue + studentpop3y2sValue +studentpop4y2sValue + studentpop5y2sValue;
                total2sInput.value = total;
            };
        
            calculateTotal2sstud();

            studentpop1y2sInput.addEventListener("input", calculateTotal2sstud);
            studentpop2y2sInput.addEventListener("input", calculateTotal2sstud);
            studentpop3y2sInput.addEventListener("input", calculateTotal2sstud);
            studentpop4y2sInput.addEventListener("input", calculateTotal2sstud);
            studentpop5y2sInput.addEventListener("input", calculateTotal2sstud);

            //1ST SEM SUBJECTS
            var numsectopened1y1sInput = document.getElementById("numsectopened1y1s");
            var numsectopened2y1sInput = document.getElementById("numsectopened2y1s");
            var numsectopened3y1sInput = document.getElementById("numsectopened3y1s");
            var numsectopened4y1sInput = document.getElementById("numsectopened4y1s");
            var numsectopened5y1sInput = document.getElementById("numsectopened5y1s");

            var total1subjInput = document.getElementById("Total1ssection");
        
            var calculateTotal1ssection = function() {
                var numsectopened1y1sValue = parseFloat(numsectopened1y1sInput.value) || 0;
                var numsectopened2y1sValue = parseFloat(numsectopened2y1sInput.value) || 0;
                var numsectopened3y1sValue = parseFloat(numsectopened3y1sInput.value) || 0;
                var numsectopened4y1sValue = parseFloat(numsectopened4y1sInput.value) || 0;
                var numsectopened5y1sValue = parseFloat(numsectopened5y1sInput.value) || 0;

                var total = numsectopened1y1sValue + numsectopened2y1sValue + numsectopened3y1sValue +numsectopened4y1sValue + numsectopened5y1sValue;
                total1subjInput.value = total;
            };

            calculateTotal1ssection();
        
            numsectopened1y1sInput.addEventListener("input", calculateTotal1ssection);
            numsectopened2y1sInput.addEventListener("input", calculateTotal1ssection);
            numsectopened3y1sInput.addEventListener("input", calculateTotal1ssection);
            numsectopened4y1sInput.addEventListener("input", calculateTotal1ssection);
            numsectopened5y1sInput.addEventListener("input", calculateTotal1ssection);

            //2nd SEM SUBJECTS
            var numsectopened1y2sInput = document.getElementById("numsectopened1y2s");
            var numsectopened2y2sInput = document.getElementById("numsectopened2y2s");
            var numsectopened3y2sInput = document.getElementById("numsectopened3y2s");
            var numsectopened4y2sInput = document.getElementById("numsectopened4y2s");
            var numsectopened5y2sInput = document.getElementById("numsectopened5y2s");

            var total2subjInput = document.getElementById("Total2ssection");
        
            var calculateTotal2ssection = function() {
                var numsectopened1y2sValue = parseFloat(numsectopened1y2sInput.value) || 0;
                var numsectopened2y2sValue = parseFloat(numsectopened2y2sInput.value) || 0;
                var numsectopened3y2sValue = parseFloat(numsectopened3y2sInput.value) || 0;
                var numsectopened4y2sValue = parseFloat(numsectopened4y2sInput.value) || 0;
                var numsectopened5y2sValue = parseFloat(numsectopened5y2sInput.value) || 0;

                var total = numsectopened1y2sValue + numsectopened2y2sValue + numsectopened3y2sValue +numsectopened4y2sValue + numsectopened5y2sValue;
                total2subjInput.value = total;
            };

            calculateTotal2ssection();
        
            numsectopened1y2sInput.addEventListener("input", calculateTotal2ssection);
            numsectopened2y2sInput.addEventListener("input", calculateTotal2ssection);
            numsectopened3y2sInput.addEventListener("input", calculateTotal2ssection);
            numsectopened4y2sInput.addEventListener("input", calculateTotal2ssection);
            numsectopened5y2sInput.addEventListener("input", calculateTotal2ssection);
        </script>

        <div class="light-grey-servicesubjects shadow">
            <h2><b><br>B. For Service Subjects</b></h2>
            <div class="table-service-subjects">
                <table class="service-subjects">
                    <tbody>
                        <tr>
                            <td></td>
                            <td>
                                <div class="row">
                                    <div class="col" 
                                         style="
                                            padding: 0;
                                            border-color: black !important;
                                            border-left: 0 !important;
                                            border-bottom: 0 !important;
                                            border-top: 0 !important;
                                         "
                                    >
                                        Number of Sections Opened
                                    </div>
                                    
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col" 
                                         style="
                                            padding: 0;
                                            border-color: black !important;
                                            border-left: 0 !important;
                                            border-bottom: 0 !important;
                                            border-top: 0 !important;
                                         "
                                    >
                                        Forecast
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="servicesubjsrow blue-header" >Subjects</td>
                            <td 
                                class="semsrow blue-header"
                                style="
                                    padding-left: 0;
                                    padding-right: 0;
                                    padding-bottom: 0;
                                "
                            >
                                <div class="row">
                                    <div class="col border" 
                                         style="
                                            padding: 0;
                                            border-color: black !important;
                                            border-left: 0 !important;
                                            border-bottom: 0 !important;
                                            border-top: 0 !important;
                                         "
                                    >
                                        {{"$forecastSection6->aydropdown1s"}}
                                    </div>
                                    <div class="col border" 
                                        style="
                                            padding: 0;
                                            border-color: black !important;
                                            border-right: 0 !important;
                                            border-left: 0 !important;
                                            border-bottom: 0 !important;
                                            border-top: 0 !important;
                                        ">
                                        {{"$forecastSection6->aydropdown2s"}}
                                    </div>
                                </div>
                                <div 
                                    class="row"
                                    style="margin: 0;"
                                >
                                    <div 
                                        class="col border"
                                        style="
                                            padding: 0;
                                            border-color: black !important;
                                            border-left: 0 !important;
                                            border-bottom: 0 !important;
                                            border-top: 0 !important;
                                        "
                                    >
                                        1st Semester
                                    </div>
                                    <div 
                                        class="col border"
                                        style="
                                            padding: 0;
                                            border-color: black !important;
                                            border-right: 0 !important;
                                            border-left: 0 !important;
                                            border-bottom: 0 !important;
                                            border-top: 0 !important;
                                        "
                                    >
                                        2nd Semester
                                    </div>
                                </div>
                            </td>
                            <td class="semsrow blue-header">
                                <div class="row">
                                    
                                </div>
                                <div 
                                    class="row"
                                    style="margin: 0;"
                                >
                                    <div 
                                        class="col border"
                                        style="
                                            padding: 0;
                                            border-color: black !important;
                                            border-left: 0 !important;
                                            border-right: 0 !important;
                                            border-top: 0 !important;
                                            border-bottom: 0 !important;
                                        "
                                    >
                                        
                                    </div>
                                </div>
                                <div 
                                    class="row"
                                    style="margin: 0;"
                                >
                                    <div 
                                        class="col border"
                                        style="
                                            padding: 0;
                                            border-color: black !important;
                                            border-left: 0 !important;
                                            border-right: 0 !important;
                                            border-bottom: 0 !important;
                                            border-top: 0 !important;
                                        "
                                    >
                                        {{"$forecastSection6->forecastSemester"}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @foreach ($forecastSection7 as $i => $row)
                            <tr class="original-rowsubj">
                                <td><input class="emc-inputtext" id="servsubj" name="servsubj[]" type="text"value="{{ $row["servsubj"] }}"></td>
                                <td
                                    style="
                                        padding-top: 0 !important;
                                        padding-bottom: 0 !important;
                                    "
                                >
                                    <div class="row" style="height: 100%">
                                        <div class="col border-end d-flex justify-content-center align-items-center" style="border-color: #000000 !important;">
                                            {{ $row["ssubj1stnumsectopened"] }}
                                        </div>
                                        <div class="col d-flex justify-content-center align-items-center">
                                            {{ $row["ssubj2ndnumsectopened"] }}
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $row["Total1s2sForecastServSubject"] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
            </div>
        </div>
        
        <!-- GRAND TOTAL -->
        <div class="light-grey-grandtotal shadow">
            <h2> <b> <br>Grand Total (A+B) </b></h2>
            <div class="table-grand-total">
                <table class="grand-total">
                    <tbody>
                        <tr>
                            <td></td> <!--TRY SAME VALUE -->
                            <td class="blue-header"><b>{{"$forecastSection6->aydropdown1s"}}</b></td>
                            <td class="blue-header"><b>{{"$forecastSection6->aydropdown2s"}}</b></td>
                            <td class="blue-header"><b>Forecast</b></td>
                        </tr>
                        <tr>
                            <td class="blue-header" rowspan="2"><b>Number of Sections</b></td>
                            <td><b>1st Semester</b></td>
                            <td><b>2nd Semester</b></td>
                            <td><b>{{"$forecastSection6->forecastSemester"}}</b></td>
                        </tr>
                        <tr>
                            <td><input class="emc-inputtext" id="grandt1st" name="grandt1st" min="0" value="{{ $forecastSection8->grandt1st }}" readonly  type="number" placeholder="Type here"></td>
                            <td><input class="emc-inputtext" id="grand2nd" name="grand2nd" min="0" value="{{ $forecastSection8->grand2nd }}" readonly  type="number" placeholder="Type here"></td>
                            <td class="totalrow"><input class="emc-inputtext" id="forecastgrandtotal" name="forecastgrandtotal" value="{{ $forecastSection8->forecastgrandtotal }}" readonly></td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>
        </div>

        <div class="light-grey-signature shadow">
            <div class="grid-con-chairperson-dean">
                <div class="chairperson-signature">
                    @if($forecastSection1->chairsignature)
                        <div id="signature-box-1" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                            <img id="signature-preview-1" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $forecastSection1->chairsignature) }}" alt="Chairperson Signature" />
                            <p id="no-signature-text-1" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $departmentChairperson->name ?? 'No Chairperson Found' }}
                            </p>
                        </div>
                    @else
                        <div id="signature-box-1" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                            <p id="no-signature-text-1" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $departmentChairperson->name ?? 'No Chairperson Found' }}
                            </p>
                        </div>
                    @endif
                    
                    <div class="text-chairperson-signature" style="margin-left: 27%; margin-top: 10px; text-decoration: underline;">
                        SECTION HEAD/CHAIRPERSON
                    </div>
                </div>
                
                <div class="dean-signature">
                    @if($forecastSection1->deansignature)
                        <div id="signature-box-2" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                            <img id="signature-preview-2" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $forecastSection1->deansignature) }}" alt="Dean Signature" />
                            <p id="no-signature-text-2" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $collegeDean->name ?? 'No Dean Found' }}
                            </p>
                        </div>
                    @else
                        <div id="signature-box-2" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                            <p id="no-signature-text-2" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $collegeDean->name ?? 'No Dean Found' }}
                            </p>
                        </div>
                    @endif
    
                    <div class="text-dean-signature" style="margin-left: 34%; margin-top: 10px; text-decoration: underline;">
                        DIRECTOR/DEAN
                    </div>
                </div>
                <br>                 
            </div>
            
            <div class="grid-con-approval">
                <div class="director-signature">
                    <div id="no-signature-box-3" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                        <img id="no-signature-preview-3" style="max-width: 100%; max-height: 80%; display: block; margin: 10px auto 0;" src="{{ asset('storage/' . $pendingFormsForecast->directorsignature) }}" alt="Director Signature" >
                        <img id="signature-preview-3" style="max-width: 100%; max-height: 80%; display: none; margin: 10px auto 0;" >
                        <p id="no-signature-text-3" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                            {{ $hrmdoDirectorName ?? 'No HRMDO Director Found.' }}
                        </p>
                    </div>
                
                    <div id="signature-box-3" style="width: 85%; height: 120px; margin-top: 10px; display: none;">
                        <div style="position: relative; width: 100%; height: 100%;">
                            <img id="signature-preview-img-3" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; max-width: 80%; max-height: 80%;" />
                            <p id="signature-name-3" style="position: absolute; bottom: 5px; left: 5px; font-size: 12px;"></p>
                        </div>
                    </div>
                
                    <div class="text-chairperson-signature" style="margin-left: 33%; margin-top: 10px; text-decoration: underline;">
                        HRMDO DIRECTOR
                    </div>
                    @unless (in_array($pendingFormsForecast->approval_status, ['Approved', 'Disapproved', 'Pending', 'Completed']))
                        <label for="signature-1" style="margin-top: 10px;">Note: Attach your signature</label>
                        <div style="display: flex; align-items: center;">
                            <input type="file" id="directorsignature" name="directorsignature" accept="image/*" onchange="previewSignature3()" style="margin-right: 5px;"
                            @if(auth()->user()->position !== 'HRMDO Director') disabled @endif />
                            <a id="delete-signature-3" onclick="deleteSignature3()" style="display: none;"><i class="material-icons" style="margin-top: 15%; margin-left: -30%;">&#xE5CD;</i></a>
                        </div>
                    @endunless
                </div>
                
                <div class="vpa-signature">
                    <div id="no-signature-box-4" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                        <img id="no-signature-preview-4" style="max-width: 100%; max-height: 80%; display: block; margin: 10px auto 0;" src="{{ asset('storage/' . $pendingFormsForecast->vpasignature) }}" alt="Dean Signature" >
                        <img id="signature-preview-4" style="max-width: 100%; max-height: 80%; display: none; margin: 10px auto 0;">
                        <p id="no-signature-text-4" style="color: #6D6868; position: absolute; bottom: -15px; left: 51%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                            {{ $vpaName ?? 'No VPA Found.' }}
                        </p>
                    </div>
                
                    <div id="signature-box-4" style="width: 85%; height: 120px; margin-top: 10px; display: none;">
                        <div style="position: relative; width: 100%; height: 100%;">
                            <img id="signature-preview-img-4" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; max-width: 80%; max-height: 80%;" />
                            <p id="signature-name-4" style="position: absolute; bottom: 5px; left: 5px; font-size: 12px;"></p>
                        </div>
                    </div>
                
                    <div class="text-chairperson-signature" style="margin-left: 33%; margin-top: 10px; text-decoration: underline;">
                        VP ADMINISTRATION
                    </div>
                    @unless (in_array($pendingFormsForecast->approval_status, ['Approved', 'Disapproved', 'Pending', 'Completed']))
                        <label for="signature-4" style="margin-top: 10px;">Note: Attach your signature</label>
                        <div style="display: flex; align-items: center;">
                            <input type="file" id="vpasignature" name="vpasignature" accept="image/*" onchange="previewSignature4()" style="margin-right: 5px;"
                            @if(auth()->user()->position !== 'VPA') disabled @endif />
                            <a id="delete-signature-4" onclick="deleteSignature4()" style="display: none;"><i class="material-icons" style="margin-top: 15%; margin-left: -30%;">&#xE5CD;</i></a>
                        </div>
                    @endunless
                </div>  
            </div>
        </div>
    </div>
</form>

@endsection