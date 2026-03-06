@extends('layouts.app')
 
@section('body')

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

    <!-- TITLE RECRUITMENT AND PLACEMENT -->
    <div class="grid-container-element-content shadow">
        <div class="grid-con-title">
            <div class="text-title">
                Recruitment and Placement
            </div>
        </div>
    </div>

    <!-- REQUISITION FORM-->
    <div class="grid-con-req-form shadow">
        <div class="grid-con-req-form-1s">
            <div class="text-mr-form">
                Manpower Requisition Form
            </div>

            <div class="ayColumn" style="margin-top: 20px;">
                <div class="text-req-dept" style="width: 100%;">
                    <label for="ay" style="margin-left: 15px; margin-right: 10px;">Academic Year:</label>
                    <span style="color: black;">{{ $mrform->ay }}</span>
                </div>     
            </div>

            <div class="semesterColumn" style="margin-top: 20px;">
                <div class="text-req-dept" style="width: 100%;">
                    <label for="ay1" style="margin-left: 10px; margin-right: 10px;">Semester:</label>
                    <span style="color: black;">{{ $mrform->semester }}</span>
                </div>
            </div>

            <div class="numempreqColumn" style="margin-top: 20px;">
                <div class="text-req-dept" style="width: 100%;">
                    <label for="num_emp_required" style="margin-right: 20px;">No. of Employees Required:</label>
                    <span style="color: black;">{{ $mrform->num_emp_required }}</span>
                </div>
            </div>

            <table class="table-mr-form">
                <tbody>
                    <tr>
                        <td class="text-mr-form-number">MR Form Number:</td>
                        <td class="data-mr-form-number" style="color: black;">{{ $mrform->mrNum }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr class="line-mrform">

        <div class="grid-con-req-form-2s">
            <div class="grid-con-fourth-section">
                <label for="employment_status" style="margin-bottom: 20px;">EMPLOYMENT STATUS:</label>
                <span style="color: black;">{{ $mrform->employment_status }}</span>

                <div class="text-req-dept" style="margin-bottom: 20px;">
                    REQUISITIONING DEPARTMENT/UNIT/COLLEGE:
                </div>
            
                <div style="width: 100%; display: flex; justify-content: flex-start;">
                    <div id="college" style="display: inline-block;"> <!-- Adjust the width as needed -->
                        <span style="color: black;">{{ $mrform->college }}</span>
                    </div>

                    <div style="width: 1%; display: inline-block; margin-right: 10px; margin-left: 10px;">
                        -
                    </div>
            
                    <div id="department" style="display: inline-block;"> <!-- Adjust the width and margin as needed -->
                        <span style="color: black;">{{ $mrform->department }}</span>
                    </div> 
                </div>

                <!-- TEXT POSITION REQUIRED -->
                <div class="text-req-dept">
                    POSITION REQUIRED: (Choose that is applicable)
                </div>

                <!-- DROPDOWN TEACHING/NON-TEACHING -->
                <div class="grid-con-section" style="margin-bottom: 20px;">
                    <span style="color: black;">{{ $mrform->position }}</span>
                </div>

                <div class="text-req-dept">
                    <label for="dropdown2">New/Additional/Replacement:</label>
                </div>
                <div class="grid-con-section" style="margin-bottom: 20px;">
                    <span style="color: black;">{{ $mrform->category }}</span>
                </div>

                <div class="text-req-dept">
                    <label for="textInput2">Reason for such request (if new/additional):</label>
                </div>
                <div class="grid-con-section" style="margin-bottom: 20px;">
                    <span style="color: black;">{{ $mrform->category_textbox }}</span>
                </div>
                
                <div class="text-req-dept">
                    <label for="dropdown3" >Reason for Replacement:</label>
                </div>

                <div class="grid-con-section" style="margin-bottom: 20px;">
                    <span style="color: black;">{{ $mrform->replacement_dropdown }}</span>
                </div>

                <div class="text-req-dept">
                    <label for="textInput3">Reason for Replacement (Others):</label>
                </div>
                <div class="grid-con-section" style="margin-bottom: 20px;">
                    <span style="color: black;">{{ $mrform->replacement_others_textbox }}</span>
                </div>

                <div class="text-req-dept">
                    <label for="dropdown4">Budgeted/Not Budgeted:</label>
                </div>

                <div class="grid-con-section" style="margin-bottom: 20px;">
                    <span style="color: black;">{{ $mrform->budget }}</span>
                </div>

                <!-- Display uploaded file -->
                @if(isset($mrform->fileInput))
                    <p>Current File:</p>   
                    @php
                        $extension = pathinfo($mrform->fileInput, PATHINFO_EXTENSION);
                    @endphp
                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) <!-- Check if it's an image -->
                        <img src="{{ asset('storage/' . $mrform->fileInput) }}" alt="Uploaded Image" style="max-width: 100%; max-height: 200px;">
                    @else
                        <a href="{{ asset('storage/' . $mrform->fileInput) }}" target="_blank">View PDF</a>
                    @endif
                @endif

                <div class="dropdown4" id="fileInputDiv" style="display:none; margin-bottom: 20px;">
                    <input type="file" class="form-control-file" id="fileInput" name="fileInput" accept="image/*,.pdf" onchange="handleFileInputChange()" disabled>
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
                        <span style="color: black; margin-left: 5px; font-size: 15px;">{{ $mrform->regular }}</span>
                    </div>
                    <div class="second-column" style="margin-bottom: 10px;">
                        <label for="Probationary" style="font-size: 14px;">PROBATIONARY:</label>
                        <span style="color: black; margin-left: 5px; font-size: 15px">{{ $mrform->probationary }}</span>
                    </div>
                    <div class="third-column" style="margin-bottom: 10px;">
                        <label for="Contractual" style="font-size: 14px;">CONTRACTUAL:</label>
                        <span style="color: black; margin-left: 5px; font-size: 15px">{{ $mrform->contractual }}</span>
                    </div>
                    {{-- <div class="fourth-column" style="margin-bottom: 10px;">
                        <label for="studentAssistant" style="font-size: 14px;">STUDENT ASSISTANT:</label>
                        <span style="color: black; margin-left: 5px; font-size: 15px">{{ $mrform->studassistant }}</span>
                    </div> --}}
                    <div class="fifth-column">
                        <label for="Total" style="font-size: 12px;">TOTAL:</label>
                        <span style="color: black; margin-left: 5px; font-size: 15px">{{ $mrform->total }}</span>
                    </div>
                </div> 
            </div>

            <div class="text-req-dept">
                <label for="textInput8">Specify Job Expertise Needed:</label>
              </div>
            <div class="grid-con-section" style="margin-bottom: 20px; margin-left: -555px; margin-right: 440px;">
                <span>{{ $mrform->expertise_textbox }}</span>
            </div>
        </div>  

        <hr class="line-third-mrform">
        
        <br>

        <!-- ATTACH SIGNATURE -->
        <div class="text-requestedby">
            REQUESTED BY:
        </div>
        <br>
        <div class="grid-con-chairperson-dean">
            <div class="chairperson-signature">
                @if($mrform->chairsignature)
                    <div id="signature-box-1" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                        <img id="signature-preview-1" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $mrform->chairsignature) }}" alt="Chairperson Signature" />
                        <p id="no-signature-text-1" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">{{ $loggedInUser->name }}</p>
                    </div>
                @else
                    <div id="signature-box-1" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                        <p id="no-signature-text-1" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">{{ $loggedInUser->name }}</p>
                    </div>
                @endif
                
                <div class="text-chairperson-signature" style="margin-left: 27%; margin-top: 10px; text-decoration: underline;">
                    SECTION HEAD/CHAIRPERSON
                </div>
            </div>
            
            <div class="dean-signature">
                @if($mrform->deansignature)
                    <div id="signature-box-2" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                        <img id="signature-preview-2" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $mrform->deansignature) }}" alt="Dean Signature" />
                        <p id="no-signature-text-2" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                            @if ($loggedInUser->college === $deanCollege)
                                {{ $deanUser->name }} <!-- Display dean's name if the colleges match -->
                            @endif
                        </p>
                    </div>
                @else
                    <div id="signature-box-2" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                        <p id="no-signature-text-2" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                            @if ($loggedInUser->college === $deanCollege)
                                {{ $deanUser->name }} <!-- Display dean's name if the colleges match -->
                            @endif
                        </p>
                    </div>
                @endif

                <div class="text-dean-signature" style="margin-left: 34.5%; margin-top: 10px; text-decoration: underline;">
                    DIRECTOR/DEAN
                </div>
            </div>
            <br>
        </div>
    </div>

    <script>
        // HIDES THE TEXTBOX FOR REASON FOR SUCH REQUEST AND REASON FOR REPLACEMENT OTHERS IF IT IS NULL
        window.onload = function() {
            var textBox = document.getElementById("textInput2");
            if (textBox.value == "") {
                textBox.style.display = "none";
            } else {
                textBox.style.display = "block";
            }
    
            var textBox2 = document.getElementById("textInput3");
            if (textBox2.value == "") {
                textBox2.style.display = "none";
            } else {
                textBox2.style.display = "block";
            }
            
    
            var dropdown3 = document.getElementById("dropdown3");
            if (dropdown3.value == "") {
                dropdown3.style.display = "none";
            } else {
                dropdown3.style.display = "block";
            }
        }     
    </script>
    
@endsection
