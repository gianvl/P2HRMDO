@extends('layouts.app')
 
@section('body')

<form action="{{ route('requestingdashboard.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

        <!-- BACK TO DASHBOARD AND PRINT BUTTON -->
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
        <a class="text-showmrform-backtodashboard" id="back" href="{{route('requestingdashboard.index')}}">Go back to Dashboard</a>
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

        <!-- JS FOR DROPDOWN -->
        <script type="text/javascript">
            function enableDropdowns() {
                var dropdown1 = document.getElementById("dropdown1");
                var dropdown2 = document.getElementById("dropdown2");
                var dropdown4 = document.getElementById("dropdown4");

                if (dropdown1.value === "") {
                    dropdown2.disabled = true;
                    hideInput2();
                    hideDropdown3();
                    dropdown2.value = "";
                    dropdown4.disabled = true; // disable dropdown4
                    hideFileInput(); // hide file input if shown
                    clearFileInput(); // clear file input if shown
                } else {
                    dropdown2.disabled = false;
                    dropdown4.disabled = false;
                }
            }

            function showInputOrDropdown() {
                var dropdown2 = document.getElementById("dropdown2");
                var input2 = document.getElementById("textInput2");
                var dropdown3 = document.getElementById("dropdown3");
                var input3 = document.getElementById("textInput3");

                if (dropdown2.value === "New" || dropdown2.value === "Additional") {
                    showInput2();
                    hideDropdown3();
                    input3.value = "";
                    dropdown3.removeAttribute("required"); // remove the required attribute
                    input2.setAttribute("required", "required"); // add the required attribute
                } else if (dropdown2.value === "Replacement") {
                    showDropdown3();
                    hideInput2();
                    input2.value = "";
                    dropdown3.setAttribute("required", "required"); // add the required attribute
                    input2.removeAttribute("required"); // remove the required attribute
                } else {
                    hideInput2();
                    hideDropdown3();
                    input2.value = "";
                    input3.value = "";
                    dropdown3.removeAttribute("required"); // remove the required attribute
                    input2.removeAttribute("required"); // remove the required attribute
                }
            }

            function showTextOrInput() {
                var dropdown3 = document.getElementById("dropdown3");
                var input3 = document.getElementById("textInput3");

                if (dropdown3.value === "Others") {
                    showInput3();
                    input3.setAttribute("required", "required"); // add the required attribute
                } else {
                    hideInput3();
                    input3.removeAttribute("required"); // remove the required attribute
                }
            }

            function showInput2() {
                var input2 = document.getElementById("textInput2");
                input2.style.display = "block";
            }

            function hideInput2() {
                var input2 = document.getElementById("textInput2");
                input2.style.display = "none";
                input2.value = "";
            }

            function showDropdown3() {
                var dropdown3 = document.getElementById("dropdown3");
                dropdown3.style.display = "block";
            }

            function hideDropdown3() {
                var dropdown3 = document.getElementById("dropdown3");
                dropdown3.style.display = "none";
                dropdown3.value = "";
                hideInput3();
            }

            function showInput3() {
                var input3 = document.getElementById("textInput3");
                input3.style.display = "block";
            }

            function hideInput3() {
                var input3 = document.getElementById("textInput3");
                input3.style.display = "none";
                input3.value = "";
            }

            function handleDropdowns() {
                var dropdown1 = document.getElementById("dropdown1");
                var dropdown2 = document.getElementById("dropdown2");
                var dropdown3 = document.getElementById("dropdown3");
                var dropdown4 = document.getElementById("dropdown4");

                dropdown2.disabled = true;
                dropdown3.disabled = true;
                dropdown4.disabled = true;

                if (dropdown1.value) {
                    dropdown2.disabled = false;
                }
            }

            function handleDropdown4Change() {
                var dropdown4 = document.getElementById("dropdown4");
                var fileInput = document.getElementById("fileInput");
                document.getElementById("fileInputDiv").style.display = (dropdown4.value === "Not Budgeted") ? "block" : "none";

                if (dropdown4.value === "Not Budgeted" && !dropdown4.disabled) {
                    fileInput.disabled = false;
                } else {
                    fileInput.disabled = true;
                }
            }

            function handleFileInputChange() {
                var fileInput = document.getElementById("fileInput");
                var clearFileButton = document.getElementById("clearFileButton");
                
                if (fileInput.files.length > 0) {
                    clearFileButton.style.display = "block";
                } else {
                    clearFileButton.style.display = "none";
                }
                
                // check file size
                if (fileInput.files[0].size > 1 * 1024 * 1024) {
                    alert("File size is too large. Maximum file size allowed is 1MB.");
                    fileInput.value = null;
                    clearFileButton.style.display = "none";
                }
            }

            function handleClearFileButtonClick() {
                var fileInput = document.getElementById("fileInput");
                var clearFileButton = document.getElementById("clearFileButton");
                
                fileInput.value = null;
                clearFileButton.style.display = "none";
            }

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

        <!-- TITLE RECRUITMENT AND PLACEMENT -->
        <div class="grid-container-element-content shadow">
            <div class="grid-con-title">
                <div class="text-title">
                    Recruitment and Placement
                </div>
            </div>
        </div>

        <!-- FACULTY PERFORMANCE EVALUATION STATUS -->
        <div class="grid-con-faculty-perf-eval-stat shadow">
            <div class="grid-container-element-content">
                <div class="text-faculty-perf-eval-stat">
                    Faculty Performance Evaluation Status
                </div>
            </div>

            <!-- OVERALL STATUS INDICATION-->
            <table class="req-mrform-table-status">
                <tr>
                    <td class="box-status-red" colspan="2"></td>
                    <td class="text-status-red" colspan="4">Not Suitable for Rehirement (0% - 49%)</td>
                    <td class="box-status-green" colspan="2"></td>
                    <td class="text-status-green" colspan="4">Suitable for Rehirement (50% - 100%)</td>
                    <td class="box-status-yellow" colspan="2"></td>
                    <td class="text-status-yellow" colspan="4">Subject for deliberation</td>
                </tr>
            </table>

           <!-- FACULTY MEMBERS AND EMPLOYMENT STATUS TABLE -->
            <table class="table-faculty-members">
                <tbody>
                    <tr>
                        <td class="blue-header"><b>Faculty Members</b></td>
                        <td class="blue-header headerempstatus"><b>Employee Status</b></td>
                        <td class="blue-header headerempstatus"><b>Overall Status</b></td>
                        <td class="blue-header"><b>Faculty Members</b></td>
                        <td class="blue-header headerempstatus"><b>Employee Status</b></td>
                        <td class="blue-header headerempstatus"><b>Overall Status</b></td>
                    </tr>
                    @for ($ctr = 0; $ctr < count($evalPages); $ctr++)
                        @if ($ctr % 2 == 0) <!-- Start a new row for every 3 faculty members -->
                            </tr><tr>
                        @endif

                        <!-- Debugging output to display the current $ctr value -->
    
                        @php
                            $statusClass = '';
                            $backgroundColor = '';

                            $overallStatus = $evalPages[$ctr]["overallstatus"];
                            $overallStatusValue = filter_var($overallStatus, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

                            if (is_numeric($overallStatusValue)) {
                                $overallStatusValue = floatval($overallStatusValue);

                                if ($overallStatusValue >= 50.0 && $overallStatusValue <= 100.0) {
                                    $statusClass = 'status-green';
                                    $backgroundColor = 'green';
                                } elseif ($overallStatusValue >= 0.0 && $overallStatusValue <= 49.0) {
                                    $statusClass = 'status-red';
                                    $backgroundColor = 'red';
                                }
                            } else {
                                $statusClass = 'status-yellow';
                                $backgroundColor = 'yellow';
                            }
                        @endphp
                        <td>
                            {{ $evalPages[$ctr]["first_name"] . ' ' . $evalPages[$ctr]["last_name"] }}
                        </td>
                        <td>
                            {{ $evalPages[$ctr]["empstatus"] }} <!-- Add this line to display Employee Status -->
                        </td>
                        <td class="{{ $statusClass }}" style="background-color: {{ $backgroundColor }}">
                            {{ $overallStatus }}</td>
                    @endfor
                </tbody>
            </table>
        </div>


        <!-- REQUISITION FORM-->
        <div class="grid-con-req-form shadow">
            <div class="grid-con-req-form-1s">
                <div class="text-mr-form">
                    Manpower Requisition Form
                </div>

                <div class="ayColumn" style="margin-top: 20px;">
                    <div class="text-req-dept" style="width: 100%;">
                        <label for="ay" style="margin-left: 15px;">Academic Year:</label>
                        <select id="ay" name="ay" style="width: 150px; height: 30px;" required>
                            <option disabled selected value="" class="optiondisabled">Select</option>
                        </select>
                    </div>     
                </div>

                <div class="semesterColumn" style="margin-top: 20px;">
                    <div class="text-req-dept" style="width: 100%;">
                        <label for="ay1" style="margin-left: 10px;">Semester:</label>
                        <select class="dropdown-sem" id="semester" name="semester" style="width: 150px; height: 30px;">
                            <option value="" disabled selected>Select</option>
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>
                        </select>
                    </div>
                </div>

                <div class="numempreqColumn" style="margin-top: 20px;">
                    <div class="text-req-dept" style="width: 100%;">
                        <label for="num_emp_required" style="margin-right: 20px;">No. of Teachers Required:</label>
                        <input type="number" style="width: 20%; font-size: 16px;" min="0" name="num_emp_required" required>
                    </div>
                </div>

                <table class="table-mr-form">
                    <tbody>
                        <tr>
                            <td class="text-mr-form-number">MR Form Number:</td>
                            <td class="data-mr-form-number"><input type="number" style="width: 3em;" name="mrNum" readonly hidden><span style="margin-right: 48px;"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr class="line-mrform">

            <div class="grid-con-req-form-2s">
                <div class="grid-con-fourth-section">
                    <label for="employment_status" style="margin-bottom: 20px;">EMPLOYMENT STATUS:</label>
                    <select name="employment_status" id="employment_status" style="height: 30px; margin-bottom: 20px;" required>
                        <option selected disabled value="">Select</option>
                        {{-- <option value="Permanent Full-time">Permanent Full-time</option>
                        <option value="Permanent Part-time">Permanent Part-time</option> --}}
                        <option value="Contractual Full-time">Contractual Full-time</option>
                        <option value="Contractual Part-time">Contractual Part-time</option>
                    </select>

                    <div class="text-req-dept" style="margin-bottom: 20px;">
                        REQUISITIONING DEPARTMENT/UNIT/COLLEGE:
                    </div>
                
                    <div style="width: 100%; display: flex; justify-content: flex-start;">
                        <div id="college" style="display: inline-block;"> <!-- Adjust the width as needed -->
                            @if ($positionFormMapping)
                                {{ $positionFormMapping->college }}
                                {!! $positionFormMapping->forms_college_column !!}
                            @endif
                        </div>

                        <div style="width: 1%; display: inline-block; margin-right: 10px; margin-left: 10px;">
                            -
                        </div>
                
                        <div id="department" style="display: inline-block;"> <!-- Adjust the width and margin as needed -->
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
                    </div>

                    <!-- TEXT POSITION REQUIRED -->
                    <div class="text-req-dept">
                        POSITION REQUIRED: (Choose that is applicable)
                    </div>

                    <!-- DROPDOWN TEACHING/NON-TEACHING -->
                    <div class="grid-con-section" style="margin-bottom: 20px;">
                        <select name="position" id="dropdown1" onchange="enableDropdowns()" style="width: 100%; height: 30px;" required>
                            <option selected disabled value="">Select</option>
                            <option value="Teaching">Teaching</option>
                            <option value="Non-Teaching">Non-Teaching</option>
                        </select>
                    </div>

                    <div class="text-req-dept">
                        <label for="dropdown2">New/Additional/Replacement:</label>
                    </div>
                    <div class="grid-con-section" style="margin-bottom: 20px;">
                        <select name="category" id="dropdown2" onchange="showInputOrDropdown()" style="width: 100%; height: 30px;" disabled required>
                            <option selected disabled value="">Select</option>
                            <option value="New">New</option>
                            <option value="Additional">Additional</option>
                            <option value="Replacement">Replacement</option>
                        </select>
                    </div>

                    <div class="text-req-dept">
                        <label for="textInput2">Reason for such request (if new/additional):</label>
                    </div>
                    <div class="grid-con-section" style="margin-bottom: 20px;">
                        <input name="category_textbox" type="text" id="textInput2" style="display: none; width: 100%; height: 30px;">
                    </div>
                    
                    <div class="text-req-dept">
                        <label for="dropdown3" >Reason for Replacement:</label>
                    </div>

                    <div class="grid-con-section" style="margin-bottom: 20px;">
                        <select name="replacement_dropdown" id="dropdown3" onchange="showTextOrInput()" style="display: none; width: 100%; height: 30px;">
                            <option selected disabled value="">Select</option>
                            <option value="Transfer">Transfer</option>
                            <option value="Resigned">Resigned</option>
                            <option value="Promotion">Promotion</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <div class="text-req-dept">
                        <label for="textInput3">Reason for Replacement (Others):</label>
                    </div>
                    <div class="grid-con-section" style="margin-bottom: 20px;">
                        <input name="replacement_others_textbox" type="text" id="textInput3" style="display: none; width: 100%; height: 30px;">
                    </div>

                    <div class="text-req-dept">
                        <label for="dropdown4">Budgeted/Not Budgeted:</label>
                    </div>

                    <div class="grid-con-section" style="margin-bottom: 20px;">
                        <select name="budget" id="dropdown4" onchange="handleDropdown4Change()" style="width: 100%; height: 30px;" disabled required>
                            <option selected disabled value="">Select</option>
                            <option value="Budgeted">Budgeted</option>
                            <option value="Not Budgeted">Not Budgeted</option>
                        </select>
                    </div>

                    <div class="dropdown4" id="fileInputDiv" style="display:none; margin-bottom: 20px;">
                        <input type="file" class="form-control-file" id="fileInput" name="fileInput" accept="image/*,.pdf" onchange="handleFileInputChange()">
                    </div>
                    <div class="grid-con-section">
                        <button type="button" class="btn btn-secondary mt-2" id="clearFileButton" style="display:none;" onclick="handleClearFileButtonClick()"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                
                <div>
                    <!-- EXISTING MANPOWER COMPLEMENT -->
                    <div class="text-exist-manpower">
                        EXISTING MANPOWER COMPLEMENT
                    </div>
                    
                    <div class="grid-con-exist-manpower">
                        <div class="first-column" style="margin-bottom: 10px;">
                            <label for="Regular" style="font-size: 14px;">REGULAR:</label>
                            <input name="regular" id="Regular" type="number" min="0" style="margin-left: 92px; width: 35%; height: 25px; font-size: 16px;">
                        </div>
                        <div class="second-column" style="margin-bottom: 10px;">
                            <label for="Probationary" style="font-size: 14px;">PROBATIONARY:</label>
                            <input name ="probationary" id="Probationary" type="number" min="0" style="margin-left: 52px; width: 35%; height: 25px; font-size: 16px;">
                        </div>
                        <div class="third-column" style="margin-bottom: 10px;">
                            <label for="Contractual" style="font-size: 14px;">CONTRACTUAL:</label>
                            <input name="contractual" id="Contractual" type="number" min="0" style="margin-left: 55px; width: 35%; height: 25px; font-size: 16px;">
                        </div>
                        {{-- <div class="fourth-column" style="margin-bottom: 10px;">
                            <label for="studentAssistant" style="font-size: 14px;">STUDENT ASSISTANT:</label>
                            <input name="studassistant" id="StudentAssistant" type="number" min="0" style="margin-left: 20px; width: 35%; height: 25px; font-size: 16px;">
                        </div> --}}
                        <div class="fifth-column">
                            <label for="Total" style="font-size: 12px;">TOTAL:</label>
                            <input name="total" id="Total" type="number" style="margin-left: 123px; width: 35%; height: 25px; font-size: 16px;" readonly>
                        </div>
                    </div> 
                </div>
                
                <div class="text-req-dept">
                    <label for="textInput8">Specify Job Expertise Needed:</label>
                  </div>
                <div class="grid-con-section" style="margin-bottom: 20px; margin-left: -555px; margin-right: 440px;">
                    <textarea name="expertise_textbox" id="textInput8" style="width: 95%; height: auto; resize: vertical;"></textarea>
                </div>
            </div>  

            <script>
                // Get the textarea element
                const textarea = document.getElementById('textInput8');
              
                // Function to adjust the textarea height based on its content
                function adjustTextareaHeight() {
                  textarea.style.height = 'auto';
                  textarea.style.height = textarea.scrollHeight + 'px';
                }
              
                // Attach an input event listener to the textarea to trigger height adjustment
                textarea.addEventListener('input', adjustTextareaHeight);
              
                // Adjust the textarea height initially (in case there is content already)
                adjustTextareaHeight();
            </script>

            <hr class="line-third-mrform">
            
            <br>
            <!-- ATTACH SIGNATURE -->
            <div class="text-requestedby">
                REQUESTED BY:
            </div>
            <br>
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
                
                    <label for="signature-1" style="margin-top: 10px;">Note: Attach your signature</label>
                    <div style="display: flex; align-items: center;">
                        <input type="file" id="chairsignature" name="chairsignature" accept="image/*" onchange="previewSignature()" style="margin-right: 5px;"/>
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
                
                    <div id="signature-box-2" style="border: 1px solid #6D6868; width: 85%; height: 120px; margin-top: 10px; margin-right: 10px; display: none;">
                        <div style="position: relative; width: 100%; height: 100%;">
                            <img id="signature-preview-img-2" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; max-width: 80%; max-height: 80%;" />
                            <p id="signature-name-2" style="position: absolute; bottom: 5px; left: 5px; font-size: 12px;"></p>
                        </div>
                    </div>
                
                    <div class="text-chairperson-signature" style="margin-left: 34.5%; margin-top: 10px; text-decoration: underline;">
                        DIRECTOR/DEAN
                    </div>
                
                    <label for="signature-2" style="margin-top: 10px;">Note: Attach your signature</label>
                    <div style="display: flex; align-items: center;">
                        <input type="file" id="deansignature" name="deansignature" accept="image/*" onchange="previewSignature2()" style="margin-right: 5px;"/>
                        <a id="delete-signature-2" onclick="deleteSignature2()" style="display: none;"><i class="material-icons" style="margin-top: 15%; margin-left: -30%;">&#xE5CD;</i></a>
                    </div>
                </div>                  
            </div>

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
            
            <script>
                var regularInput = document.getElementById("Regular");
                var probationaryInput = document.getElementById("Probationary");
                var contractualInput = document.getElementById("Contractual");
                // var studentAssistantInput = document.getElementById("StudentAssistant");
                var totalInput = document.getElementById("Total");
            
                var calculateTotal = function() {
                    var regularValue = parseFloat(regularInput.value) || 0;
                    var probationaryValue = parseFloat(probationaryInput.value) || 0;
                    var contractualValue = parseFloat(contractualInput.value) || 0;
                    // var studentAssistantValue = parseFloat(studentAssistantInput.value) || 0;
            
                    var total = regularValue + probationaryValue + contractualValue ;
                    totalInput.value = total;
                };
            
                regularInput.addEventListener("input", calculateTotal);
                probationaryInput.addEventListener("input", calculateTotal);
                contractualInput.addEventListener("input", calculateTotal);
                // studentAssistantInput.addEventListener("input", calculateTotal);
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
            
            <button type="submit" id="save" class="btn btn-send-req shadow-none">Save Request</button> 
            <br>
        </div>
    </form>
@endsection
