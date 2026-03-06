@extends('layouts.app')
 
@section('body')

<!-- BACK TO DASHBOARD AND PRINT DOCUMENT -->

    <div>
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block text-center">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
        @endif
    </div>

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

    <script type="text/javascript">

        function handleFileInputChange() {
            var fileInput = document.getElementById("fileInput");
            var clearFileButton = document.getElementById("clearFileButton");
            
            if (fileInput.files.length > 0) {
                clearFileButton.style.display = "block";
            } else {
                clearFileButton.style.display = "none";
            }
            
            // check file size
            if (fileInput.files[0].size > 5 * 1024 * 1024) {
                alert("File size is too large. Maximum file size allowed is 5MB.");
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
            var signatureInput = document.getElementById('signature-3');

            signaturePreview.src = '';
            signatureName.textContent = '';
            deleteSignatureBtn.style.display = 'none';
            signatureBox.style.display = 'none';
            signatureInput.value = '';

            document.getElementById('no-signature-preview-3').style.display = 'block';
            document.getElementById('signature-preview-img-3').style.display = 'none';
        }

        function deleteSignature4() {
            var signaturePreview = document.getElementById('signature-preview-4');
            var signatureName = document.getElementById('signature-name-4');
            var deleteSignatureBtn = document.getElementById('delete-signature-4');
            var signatureBox = document.getElementById('signature-box-4');
            var signatureInput = document.getElementById('signature-4');

            signaturePreview.src = '';
            signatureName.textContent = '';
            deleteSignatureBtn.style.display = 'none';
            signatureBox.style.display = 'none';
            signatureInput.value = '';

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

    <div class="grid-container-element-content shadow">
        <div class="grid-con-title">
            <div class="text-title">
                Status
                <form id="approve-modal" action="{{ route('approve', $pendingForms) }}" method="POST" enctype="multipart/form-data" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-approveform btn-primary" style="float:right; margin-right:1%; margin-left:1%;">Approve</button>
                    <div class="modal fade" id="update-approve" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal-label" style="color: black; font-weight: bold;">Approve Form</h4>
                                </div>
                                <div class="modal-body">
                                    <p style="font-size: 20px; margin-top: 10px; color: black; text-align: center; font-weight: normal;">Are you sure you want to approve this form?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default no-hover" data-dismiss="modal" id="approve-cancel-btn">Cancel</button>
                                    <button type="submit" class="btn btn-danger" id="btn-confirm-approve">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
                <form id="disapprove-modal" action="{{ route('disapprove', $pendingForms) }}" method="POST" enctype="multipart/form-data" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-disapproveform btn-danger" style="float:right;">Disapprove</button>
                    <div class="modal fade" id="update-disapprove" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal-label" style="color: black; font-weight: bold;">Disapprove Form</h4>
                                </div>
                                <div class="modal-body">
                                    <p style="font-size: 20px; margin-top: 10px; color: black; text-align: center; font-weight: normal;">Are you sure you want to disapprove this form?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default no-hover" data-dismiss="modal" id="disapprove-cancel-btn">Cancel</button>
                                    <button type="submit" class="btn btn-danger" id="btn-confirm-disapprove">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <script>
                    $(document).ready(function() {
                        $('.btn-approveform').click(function(e) {
                            e.preventDefault();
                            $('#update-approve').modal('show');
                        });
                
                        $('#btn-confirm-approve').click(function() {
                            $('#approve-modal').submit();
                        });

                        $('#approve-cancel-btn').click(function() {
                            $('#update-approve').modal('hide');
                        });
                
                        $('.btn-disapproveform').click(function(e) {
                            e.preventDefault();
                            $('#update-disapprove').modal('show');
                        });

                        $('#btn-confirm-disapprove').click(function() {
                            $('#disapprove-modal').submit();
                        });

                        $('#disapprove-cancel-btn').click(function() {
                            $('#update-disapprove').modal('hide');
                        });
                    });
                </script> 
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
                    <span style="color: black;">{{ $pendingForms->ay }}</span>
                </div>     
            </div>

            <div class="semesterColumn" style="margin-top: 20px;">
                <div class="text-req-dept" style="width: 100%;">
                    <label for="ay1" style="margin-left: 10px; margin-right: 10px;">Semester:</label>
                    <span style="color: black;">{{ $pendingForms->semester }}</span>
                </div>
            </div>

            <div class="numempreqColumn" style="margin-top: 20px;">
                <div class="text-req-dept" style="width: 100%;">
                    <label for="num_emp_required" style="margin-right: 20px;">No. of Employees Required:</label>
                    <span style="color: black;">{{ $pendingForms->num_emp_required }}</span>
                </div>
            </div>

            <table class="table-mr-form">
                <tbody>
                    <tr>
                        <td class="text-mr-form-number">MR Form Number:</td>
                        <td class="data-mr-form-number" style="color: black;">{{ $pendingForms->mrNum }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr class="line-mrform">

        <div class="grid-con-req-form-2s">
            <div class="grid-con-fourth-section">
                <label for="employment_status" style="margin-bottom: 20px;">EMPLOYMENT STATUS:</label>
                <span style="color: black;">{{ $pendingForms->employment_status }}</span>

                <div class="text-req-dept" style="margin-bottom: 20px;">
                    REQUISITIONING DEPARTMENT/UNIT/COLLEGE:
                </div>
            
                <div style="width: 100%; display: flex; justify-content: flex-start;">
                    <div id="college" style="display: inline-block;"> <!-- Adjust the width as needed -->
                        <span style="color: black;">{{ $pendingForms->college }}</span>
                    </div>

                    <div style="width: 1%; display: inline-block; margin-right: 10px; margin-left: 10px;">
                        -
                    </div>
            
                    <div id="department" style="display: inline-block;"> <!-- Adjust the width and margin as needed -->
                        <span style="color: black;">{{ $pendingForms->department }}</span>
                    </div> 
                </div>

                <!-- TEXT POSITION REQUIRED -->
                <div class="text-req-dept">
                    POSITION REQUIRED: (Choose that is applicable)
                </div>

                <!-- DROPDOWN TEACHING/NON-TEACHING -->
                <div class="grid-con-section" style="margin-bottom: 20px;">
                    <span style="color: black;">{{ $pendingForms->position }}</span>
                </div>

                <div class="text-req-dept">
                    <label for="dropdown2">New/Additional/Replacement:</label>
                </div>
                <div class="grid-con-section" style="margin-bottom: 20px;">
                    <span style="color: black;">{{ $pendingForms->category }}</span>
                </div>

                <div class="text-req-dept">
                    <label for="textInput2">Reason for such request (if new/additional):</label>
                </div>
                <div class="grid-con-section" style="margin-bottom: 20px;">
                    <span style="color: black;">{{ $pendingForms->category_textbox }}</span>
                </div>
                
                <div class="text-req-dept">
                    <label for="dropdown3" >Reason for Replacement:</label>
                </div>

                <div class="grid-con-section" style="margin-bottom: 20px;">
                    <span style="color: black;">{{ $pendingForms->replacement_dropdown }}</span>
                </div>

                <div class="text-req-dept">
                    <label for="textInput3">Reason for Replacement (Others):</label>
                </div>
                <div class="grid-con-section" style="margin-bottom: 20px;">
                    <span style="color: black;">{{ $pendingForms->replacement_others_textbox }}</span>
                </div>

                <div class="text-req-dept">
                    <label for="dropdown4">Budgeted/Not Budgeted:</label>
                </div>

                <div class="grid-con-section" style="margin-bottom: 20px;">
                    <span style="color: black;">{{ $pendingForms->budget }}</span>
                </div>

                <!-- Display uploaded file -->
                @if(isset($pendingForms->fileInput))
                    <p>Current File:</p>   
                    @php
                        $extension = pathinfo($pendingForms->fileInput, PATHINFO_EXTENSION);
                    @endphp
                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) <!-- Check if it's an image -->
                        <img src="{{ asset('storage/' . $pendingForms->fileInput) }}" alt="Uploaded Image" style="max-width: 100%; max-height: 200px;">
                    @else
                        <a href="{{ asset('storage/' . $pendingForms->fileInput) }}" target="_blank">View PDF</a>
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
                        <span style="color: black; margin-left: 5px; font-size: 15px;">{{ $pendingForms->regular }}</span>
                    </div>
                    <div class="second-column" style="margin-bottom: 10px;">
                        <label for="Probationary" style="font-size: 14px;">PROBATIONARY:</label>
                        <span style="color: black; margin-left: 5px; font-size: 15px">{{ $pendingForms->probationary }}</span>
                    </div>
                    <div class="third-column" style="margin-bottom: 10px;">
                        <label for="Contractual" style="font-size: 14px;">CONTRACTUAL:</label>
                        <span style="color: black; margin-left: 5px; font-size: 15px">{{ $pendingForms->contractual }}</span>
                    </div>
                    <div class="fourth-column" style="margin-bottom: 10px;">
                        <label for="studentAssistant" style="font-size: 14px;">STUDENT ASSISTANT:</label>
                        <span style="color: black; margin-left: 5px; font-size: 15px">{{ $pendingForms->studassistant }}</span>
                    </div>
                    <div class="fifth-column">
                        <label for="Total" style="font-size: 12px;">TOTAL:</label>
                        <span style="color: black; margin-left: 5px; font-size: 15px">{{ $pendingForms->total }}</span>
                    </div>
                </div> 
            </div>

            <div class="text-req-dept">
                <label for="textInput8">Specify Job Expertise Needed:</label>
              </div>
            <div class="grid-con-section" style="margin-bottom: 20px; margin-left: -555px; margin-right: 440px;">
                <span>{{ $pendingForms->expertise_textbox }}</span>
            </div>
        </div>  

        <hr class="line-third-mrform">

        <!-- ATTACH SIGNATURE -->
        <div class="text-requestedby">
            REQUESTED BY:
        </div>
        <br>
        <div class="grid-con-chairperson-dean">
            <div class="chairperson-signature">
                @if($pendingForms->chairsignature)
                    <div id="signature-box-1" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                        <img id="signature-preview-1" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $pendingForms->chairsignature) }}" alt="Chairperson Signature" />
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
                
                <div class="text-chairperson-signature" style="margin-left: 26%; margin-top: 10px; text-decoration: underline;">
                    SECTION HEAD/CHAIRPERSON
                </div>
            </div>
            
            <div class="dean-signature">
                @if($pendingForms->deansignature)
                    <div id="signature-box-2" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                        <img id="signature-preview-2" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $pendingForms->deansignature) }}" alt="Dean Signature" />
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

                <div class="text-dean-signature" style="margin-left: 34.5%; margin-top: 10px; text-decoration: underline;">
                    DIRECTOR/DEAN
                </div>
            </div>  
        </div>

        <hr class="line-fourth-mrform">

        <div class="text-recommending-approval">
            RECOMMENDING APPROVAL:
        </div>
        <br>
        <div class="grid-con-approval">
            <div class="hrmd-director-signature">
                @if($pendingForms->directorsignature)
                    <div id="signature-box-3" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                        <img id="signature-preview-3" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $pendingForms->directorsignature) }}" alt="Chairperson Signature" />
                        <p id="no-signature-text-3" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                            {{ $hrmdoDirectorName ?? 'No HRMDO Director Found.' }}
                        </p>
                    </div>
                @else
                    <div id="signature-box-3" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                        <p id="no-signature-text-3" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                            {{ $hrmdoDirectorName ?? 'No HRMDO Director Found.' }}
                        </p>
                    </div>
                @endif
                
                <div class="text-chairperson-signature" style="margin-left: 33%; margin-top: 10px; text-decoration: underline;">
                    HRMDO DIRECTOR
                </div>
            </div>
            
            <div class="vpa-signature">
                @if($pendingForms->vpasignature)
                    <div id="signature-box-4" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                        <img id="signature-preview-4" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $pendingForms->vpasignature) }}" alt="Dean Signature" />
                        <p id="no-signature-text-4" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                            {{ $vpaName ?? 'No VPA Found.' }}
                        </p>
                    </div>
                @else
                    <div id="signature-box-4" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                        <p id="no-signature-text-4" style="color: #6D6868; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); max-width: 90%; text-overflow: ellipsis; white-space: nowrap;">
                            {{ $vpaName ?? 'No VPA Found.' }}
                        </p>
                    </div>
                @endif

                <div class="text-dean-signature" style="margin-left: 32.5%; margin-top: 10px; text-decoration: underline;">
                    VP ADMINISTRATION
                </div>
            </div>  
            <br>                  
        </div>
    </div>

@endsection
