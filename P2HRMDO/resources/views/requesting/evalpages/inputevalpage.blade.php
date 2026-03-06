@extends('layouts.app')

@section('body')
    <form id="editperformanceEvaluationForm" action="{{route('editperformanceEvaluation.store')}}" method="POST">
        @csrf

        <div class="grid-container-print-backtodashboard">
            <div class="grid-container" style="margin-top: 10px; margin-left: 5px;">
                <a class="text-showmrform-backtodashboard" id="back" href="{{route('requestingdashboard.index')}}">Go back to Dashboard</a>
            </div>
        </div>
        <!--COLLEGES OF SCIENCE SECTION -->
        <div class="inputevalpage-grid-container">
            <div class="inputevalpage-grid-con-colleges shadow" href="">
                <div class="inputevalpage-img-college-logo"> 
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
                <div class="inputevalpage-text-align-colleges">
                    <h1 style="margin-left: -52%;"><b>{{ $loggedInUser->college }}</b></h1>
                    <h3 style="margin-left: 2px;">{{ $loggedInUser->department }}</h3>
                </div>
            </div>

            <div class="grid-con-dropdown-select-input">
                <div class="text-align-dropdown-select">
                   <h4> Select Professor:</h4>
                </div>
                <div class="dropwdown-professor"> 
                        <!--MAKE SELECTED PROFESSOR A FOREIGN KEY TO THE INPUTS IN THE TABLE BELOW -->
                        <!-- THE CONTENT OF THIS TABLE SHOULD BE CONNECTED TO THE DATABASE OF LIST OF PROFESSORS PER DEPARTMENT -->
                        <select id="dropwdown-professor" name="employee_id" style="width: 200px; height: 25px; border-color: #315EA0;" required>
                            <option disabled selected value="" class="optiondisabled"></option>
                            @foreach($professors as $professor) 
                            <option value="{{ $professor->id }}">{{ $professor->first_name }} {{ $professor->last_name }}</option>
                            @endforeach
                        </select>
                       
                </div>
                <div class="text-align-dropdown-select">
                    <h4>Academic Year:</h4>
                </div>
                <div class="dropwdown-ay">
                    <!-- ACADEMIC YEAR WILL BE GENERATED BASED ON THE CURRENT YEAR -->
                    <select id="ay" name="ay" style="width: 200px; height: 25px; border-color: #315EA0;" required>
                        <option disabled selected value="" class="optiondisabled"></option>
                    </select>
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
            </div>
        </div>
        <br>
        <div class="grid-con-input-eval-sec shadow" href="">
            <div class="img-prof-eval-sec" >
                <img src="{{url('/images/profilepic.png')}}" id="prof-image" alt="Profile Image" style="margin-left: 15px;" class="rounded-circle" width="65px" height="65px">
            </div>
            <div class="text-align-eval-sec">
                <!-- CONTENT SHOULD ALSO COME FROM DATABASE LIST OF PROFFESORS PER DEPARTMENT-->
                <h2><b id="prof-name" style="margin-left: -15px;"></b></h2>
                <p id="prof-spec"></p>
                <p id="prof-emp-no" style="margin-top: -20px;"></p>
            </div>
            <script>
                // Using JavaScript
                var selectElement = document.getElementById('ay');
                var thElement = document.getElementById('ay-selected');
                selectElement.addEventListener('change', function() {
                  thElement.innerHTML = selectElement.value;
                });
              
                // Using jQuery
                $('#ay').on('change', function() {
                  $('#ay-selected').html('<br> <b>' + $(this).val());
                });
            </script>
              
            <!--TABLEE-->
            <div>
                <table class="table">
                    <thead class="thead-inputevalpage-sec">
                        <thead class="thead-inputevalpage-sec">
                            <th  scope="col" colspan="10"> 
                                Employee Performance Evaluation
                            </th>
                          </thead>
                          
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="2" class="blue-header" id="ay-selected"><br>A.Y</td>
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
                        <tr>
                            <td class="text-size">
                                <select id="semesterInput" name="semester" class="semester" required>
                                    <!--DROPDOWN FUNCTION -->
                                    <option disabled selected value="" class="optiondisabled"> </option>
                                    <option value="1st Semester">1st Semester</option>
                                    <option value="2nd Semester">2nd Semester</option>
                                </select>
                            </td>
                            <td>
                                <select id="awolna" name="awolna" class="awolna" required>
                                    <!--DROPDOWN FUNCTION -->
                                    <option disabled selected value="" class="optiondisabled"> </option>
                                    <option value="N/A">N/A</option>
                                    <option value="AWOL">AWOL</option>
                                </select>

                            </td>
                            <td><input id="absencesInput" name="absences" class="absences" type="number" size="10" min="0" max="10" step="1" placeholder="Type here" required></td>
                            <td><input id="studentInput" name="student" class="student" type="number" size="10" min="0" max="5" step="0.01" placeholder="Type here" required></td>
                            <td><input id="peerInput" name="peer" class="peer" type="number" size="10" min="0" max="5" step="0.01" placeholder="Type here" required></td>
                            <td><input id="deanInput" name="dean" class="dean" type="number" size="10" min="0" max="5" step="0.01" placeholder="Type here" required></td>
                            <td><input id="chairpersonInput" name="chairperson" class="chairperson" type="number" size="10" min="0" max="5" step="0.01" placeholder="Type here" required></td>
                            <td colspan="2">
                                <input 
                                    id="prof-emp-status" name="empstatus" class="empstatus" type="text" value="" 
                                    style="font-size: 16px; margin-top: 5px; width: 100%; border: 0; text-align: center;"
                                    readonly
                                >
                            </td>
                            <td class="overallstatustd" name="overallstatusContainer">
                                <input 
                                    id="overallstatus" name="overallstatus" class="overallstatus" type="text" value="" 
                                    style="border: 0; text-align: center; background-color: transparent; word-wrap: break-word;"
                                    readonly
                                >
                            </td>

                            <script>
                                // Get references to the input elements and the overallstatus cell
                                const absencesInput = document.querySelector('.absences');
                                const studentInput = document.querySelector('.student');
                                const peerInput = document.querySelector('.peer');
                                const deanInput = document.querySelector('.dean');
                                const chairpersonInput = document.querySelector('.chairperson');
                                const overallstatusCell = document.querySelector('[name="overallstatusContainer"]');
                                const awolnaSelect = document.querySelector('.awolna');
                            
                                // Add an input event listener to all input elements
                                [absencesInput, studentInput, peerInput, deanInput, chairpersonInput].forEach(input => {
                                    input.addEventListener('input', validateInputAndCalculateTotalPercentage);
                                });

                                awolnaSelect.addEventListener('change', handleAwolSelect);

                                function handleAwolSelect() {
                                    if (awolnaSelect.value === 'AWOL') {
                                        // Set the values of specified fields to 0
                                        absencesInput.value = 0;
                                        studentInput.value = 0;
                                        peerInput.value = 0;
                                        deanInput.value = 0;
                                        chairpersonInput.value = 0;

                                        $('#absencesInput').attr('readonly', true);
                                        $('#studentInput').attr('readonly', true);
                                        $('#peerInput').attr('readonly', true);
                                        $('#deanInput').attr('readonly', true);
                                        $('#chairpersonInput').attr('readonly', true);

                                        $("#overallstatus").val('0%');
                                        overallstatusCell.style.backgroundColor = '#EECCCA';

                                        // You can also store these values in the database here.
                                    } else if (awolnaSelect.value === 'N/A') {
                                        // Clear all field values
                                        absencesInput.value = '';
                                        studentInput.value = '';
                                        peerInput.value = '';
                                        deanInput.value = '';
                                        chairpersonInput.value = '';

                                        $('#absencesInput').attr('readonly', false);
                                        $('#studentInput').attr('readonly', false);
                                        $('#peerInput').attr('readonly', false);
                                        $('#deanInput').attr('readonly', false);
                                        $('#chairpersonInput').attr('readonly', false);

                                        $("#overallstatus").val('');
                                        overallstatusCell.style.backgroundColor = '';
                                    }
                                }
                                
                                function validateInputAndCalculateTotalPercentage() {
                                    // Validate input for absences field and allow only whole numbers in the range of 0 to 10
                                    if (this === absencesInput) {
                                        this.value = Math.min(Math.max(parseInt(this.value) || 0, 0), 10);
                                    }
                                    // Validate input for other fields and allow values with up to 2 decimal places in the range of 0 to 5
                                    else {
                                        this.value = this.value.replace(/[^0-9.]/g, '');
                                        this.value = Math.min(parseFloat(this.value) || 0, 5).toFixed(2);
                                    }
                            
                                    // Get the values from input elements
                                    const absencesValue = parseInt(absencesInput.value) || 0;
                                    const studentValue = parseFloat(studentInput.value) || 0;
                                    const peerValue = parseFloat(peerInput.value) || 0;
                                    const deanValue = parseFloat(deanInput.value) || 0;
                                    const chairpersonValue = parseFloat(chairpersonInput.value) || 0;
                            
                                    // Calculate the total percentage
                                    const totalPercentage = ((studentValue / 5) * 25) + ((chairpersonValue / 5) * 25) + ((peerValue / 5) * 25) + ((deanValue / 5) * 25);
                            
                                    // Check if at least one field has a value >= 4.00 and at least one field has a value <= 2.50
                                    const hasHighValue = studentValue >= 4.00 || chairpersonValue >= 4.00 || deanValue >= 4.00 || peerValue >= 4.00;
                                    const hasLowValue = studentValue <= 2.50 || chairpersonValue <= 2.50 || deanValue <= 2.50 || peerValue <= 2.50;
                            
                                    // Calculate the deduction due to absences
                                    const absencePenalty = absencesValue > 5 ? (absencesValue - 5) * 5 : 0;
                                    const totalWithPenalty = totalPercentage - absencePenalty;
                            
                                    // Check if absences are 8 or more
                                    if (absencesValue >= 8) {
                                        if (studentValue <= 3.00 && chairpersonValue <= 3.00 && peerValue <= 3.00 && deanValue <= 3.00) {
                                            // If all values are <= 3, deduct an additional 5% without marking as "Subject for deliberation"
                                            const absenceAdditionalPenalty = absencesValue > 5 ? (absencesValue - 5) * 5 : 0;
                                            const totalWithAdditionalPenalty = totalPercentage - absenceAdditionalPenalty;
                                            if (totalWithAdditionalPenalty >= 0) {
                                                $("#overallstatus").val(`${totalWithAdditionalPenalty.toFixed(2)}%`);
                                            } else {
                                                $("#overallstatus").val('0.00%'); // Ensure it doesn't go below 0%
                                            }
                                            overallstatusCell.style.backgroundColor = '#EECCCA'; // Yellow background for the penalty
                                        } else {
                                            // If any value is > 3, mark as "Subject for deliberation"
                                            $("#overallstatus").val('Subject for deliberation');
                                            overallstatusCell.style.backgroundColor = '#F1EB9C'; // Yellow background for "Subject for deliberation"
                                        }
                                    } else {
                                        // Ensure the total percentage is not below 0
                                        const finalPercentage = Math.max(totalWithPenalty, 0);
                            
                                        if (hasHighValue && hasLowValue) {
                                            $("#overallstatus").val('Subject for deliberation'); // Display the message
                                            overallstatusCell.style.backgroundColor = '#F1EB9C';
                                        } else {
                                            // Update the overallstatus cell with the final percentage
                                            $("#overallstatus").val(`${finalPercentage.toFixed(2)}%`);
                            
                                            if (finalPercentage >= 0 && finalPercentage <= 49.99) {
                                                overallstatusCell.style.backgroundColor = '#EECCCA'; // Set the background color to red for 0-50%
                                            } else {
                                                overallstatusCell.style.backgroundColor = '#C9DBBA'; // Set the background color to green for 51-100%
                                            }
                                        }
                                    }
                                }
                            </script>                                                                                                                                                                
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <button id="editperformanceEvaluationSubmit" id="save" class="btn btn-inputevalpage-save shadow-none" name="save">Save</button>
            <!--WHEN SAVED DISPLAY DATA FROM THE TABLE TO TABLE IN "req_saveevalpage" -->
            <br><br>
        </div>
    </form>

    <script>
        function redirectToPage() {
            var selectedEmployeeId = $('#dropwdown-professor').val();
            window.location.href = '/editperformanceEvaluation/save/{id}' + selectedEmployeeId ;
        }
    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '/api/professor/' + $('#dropwdown-professor').val(),
                success: function(response) {
                    console.log(response);

                    if (response && response.image) {
                        const imageUrl = `/storage/images/${response.image}`;
                        $("#prof-image").attr("src", imageUrl);
                    } else {
                        // Set a default image or handle the case when response.image is undefined
                        $("#prof-image").attr("src", '/images/profilepic.png');
                    }

                    // Update other elements only if response is valid
                    if (response) {
                        $("#prof-name").html(` ${response.first_name} ${response.last_name}`);
                        $("#prof-spec").html(response.specialization)
                        $("#prof-emp-no").html(response.emp_no)
                        $("#prof-emp-status").val(response.employment_status)
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
    
            $('#dropwdown-professor').change(function () {
                $.ajax({
                    type: 'GET',
                    url: '/api/professor/' + $('#dropwdown-professor').val(),
                    success: function(response) {
                        console.log(response);

                        if (response && response.image) {
                            const imageUrl = `/storage/images/${response.image}`;
                            $("#prof-image").attr("src", imageUrl);
                        } else {
                            // Set a default image or handle the case when response.image is undefined
                            $("#prof-image").attr("src", '/images/profilepic.png');
                        }

                        // Update other elements only if response is valid
                        if (response) {
                            $("#prof-name").html(` ${response.first_name} ${response.last_name}`);
                            $("#prof-spec").html(response.specialization)
                            $("#prof-emp-no").html(response.emp_no)
                            $("#prof-emp-status").val(response.employment_status)
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            })
            
            $('#editperformanceEvaluationForm').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: '/api/evaluation/check/' + $('#dropwdown-professor').val() + '/' + $('#ay').val() + '/' + $('#semesterInput').val(),
                    success: function(response) {
                        console.log(response);
                        if (response.count <= 0) {

                            var formData = {
                                employee_id: $("#dropwdown-professor").val(),
                                ay: $("#ay").val(),
                                semester: $("#semesterInput").val(),
                                awolna: $("#awolna").val(),
                                absences: $("#absencesInput").val(),
                                student: $("#studentInput").val(),
                                peer: $("#peerInput").val(),
                                dean: $("#deanInput").val(),
                                chairperson: $("#chairpersonInput").val(),
                                empstatus: $("#prof-emp-status").val(),
                                overallstatus: $("#overallstatus").val(),
                            };

                            $.ajax({
                                type: 'POST',
                                url: '/api/evaluation/post',
                                data: formData,
                                dataType: "json",
                                encode: true,
                                success: function(response) {
                                    console.log(response);
                                    alert("Evaluation succesfully saved.");
                                    window.location.href = `/editperformanceEvaluation/save/${response.id}`;
                                },
                                error: function(err) {
                                    console.log(err);
                                }
                            });
                        } else {
                            alert("Error: School year and semester for the selected professor already exists.");
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
        });

        function redirectToPage() {
            var selectedOptionValue = $('#dropwdown-professor').val();
            window.location.href = '/another-page?selected_option=' + selectedOptionValue;
        }
    </script>
    
@endsection