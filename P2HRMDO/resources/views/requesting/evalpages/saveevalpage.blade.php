@extends('layouts.app')

@section('body')

    <div class="grid-container-print-backtodashboard">
        <div class="grid-container" style="margin-top: 10px; margin-left: 5px;">
            <a class="text-showmrform-backtodashboard" id="back" href="{{route('requestingdashboard.index')}}">Go back to Dashboard</a>
        </div>
    </div>

    <!--COLLEGES OF SCIENCE SECTION -->
    <div class="inputevalpage-grid-container">
            <div class="inputevalpage-grid-con-colleges shadow" href="">
                <div class="inputevalpage-img-college-logo">
                    {{-- <img src="{{url('/images/BSlogo.png')}}" class="rounded-circle" width="65px" height="65px" href="req_evalpage copy.html"> --}}
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
                    <h3 style="margin-left: 3px;">{{ $loggedInUser->department }}</h3>
                </div>
            </div>

            <div class="grid-con-dropdown-select">
                <div class="text-align-dropdown-select">
                   <h5> Select Professor:</h5>
                </div>
                <div class="dropwdown-professors">
                        <!--MAKE SELECTED PROFESSOR A FOREIGN KEY TO THE INPUTS IN THE TABLE BELOW -->
                        <!-- THE CONTENT OF THIS TABLE SHOULD BE CONNECTED TO THE DATABASE OF LIST OF PROFESSORS PER DEPARTMENT -->
                        {{-- <select id="dropwdown-professor" name="employee_id" style="width: 200px; height: 25px; border-color: #315EA0;" disabled> --}}
                        @foreach($employee_id as $employee)  
                            <option style="float:right;" value="{{ $evalpages->employee_id }}"> {{ $employee->prefix}} {{ $employee->first_name }} {{ $employee->last_name }}</option>
                        @endforeach
                        </select>
                </div>
                <div class="text-align-dropdown-select">
                    <h5>Academic Year:</h5>
                </div>
                <div class="dropwdown-professor">
                        <!-- ACADEMIC YEAR SHOULD DISPLAY FIXED DEPENDING ON THE CURRENT YEAR -->
                        <!-- ALSO READS IN THE DATABASE
                        <select name="ay" value="{{ $evalpages->ay }}" style="width: 200px; height: 25px; border-color: #315EA0;">
                        <option value="2020-2021">2020-2021</option>
                        <option value="2021-2022">2021-2022</option>
                        </select> -->
                        <input type="text" name="text" style="display: none" readonly>
                        <span style="float: right;">{{ $evalpages->ay }}</span>
                </div>

                <script>
                    document.getElementById('print-btn').addEventListener('click', function(event) {
                        event.preventDefault();// prevent the default link behavior
                        window.print(); // trigger the browser's print function
                    });
                </script>
                <!-- END PRINT DOCUMENT -->

            </div>
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
            <div class="grid-container-print-backtodashboard-saveevalpage">
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
            
        </div>
        <div class="grid-con-save-eval-sec shadow" href="">
        @foreach($employee_id as $employee) 
            <div class="img-prof-eval-sec" >
                <img id="prof-image" src="{{ asset('storage/images/' . $employee->image) }}" style="margin-left: 15px;" class="rounded-circle" width="65px" height="65px" href="req_evalpage copy.html">
            </div>
            <div class="text-align-eval-sec">
                <!-- CONTENT SHOULD ALSO COME FROM DATABASE LIST OF PROFFESORS PER DEPARTMENT-->
                <h2><b id="prof-name" style="margin-left: -15px;">{{ $employee->prefix}} {{ $employee->first_name }} {{ $employee->last_name }}</b></h2>
                <p id="prof-spec">{{ $employee->specialization }}</p>
                <p id="prof-emp-no" style="margin-top: -20px;">{{ $employee->emp_no}}</p>
                @endforeach

            </div>  
            
        <!--TABLEE-->
        <div>
            <table class="table">
                <thead class="thead-inputevalpage-sec">
                    <th scope="col" colspan="10"  >
                        Employee Performance Evaluation
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2" class="blue-header" value="{{$evalpages->ay}}" id="ay-selected" ><br>  {{$evalpages->ay}}</td>
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
                        <td> <input type="text" class="semester" name="semester" value="{{$evalpages->semester}}" readonly size="2"></td>
                        <td>
                            <input type="text" class="awolna" name="awolna" value="{{$evalpages->awolna}}" readonly>
                        </td>
                        <td><input readonly name="absences" class="absences" value="{{ $evalpages->absences }}" type="text" size="5"></td>
                        <td><input readonly name="student" class="student" value="{{ $evalpages->student }}" type="text" size="2"></td>
                        <td><input readonly name="peer" class="peer" value="{{ $evalpages->peer }}" type="text" size="2"></td>
                        <td><input readonly name="dean" class="dean" value="{{ $evalpages->dean }}" type="text" size="2"></td>
                        <td><input readonly name="chairperson" class="chairperson" value="{{ $evalpages->chairperson }}" type="text" size="2"></td>
                        <td colspan="2" name="empstatus" class="empstatus">{{ $evalpages->empstatus }}</td>
                        <td name="overallstatus" style="width: 500px;">{{ $evalpages->overallstatus }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <a class="btn btn-backDashboard shadow-none" id="back" href="{{route('editperformanceEvaluation.index')}}">Go back to Evaluation Page</a>
        <br><br>
        <!--WHEN SAVED DISPLAY DATA FROM THE TABLE TO TABLE IN "req_saveevalpage" -->
    </div>

@endsection

@push('scripts')
<script>
      $(document).ready(function() {
        $('#dropwdown-professor').change(function () {
            $.ajax({
                type: 'GET',
                url: '/api/professor/' + $('#dropwdown-professor').val(),
                success: function(response) {
                    console.log(response);
                    $("#prof-image").attr("src", response.image);
                    $("#prof-name").html(`${response.prefix} ${response.first_name} ${response.last_name}`);
                    $("#prof-spec").html(response.specialization)
                    $("#prof-emp-no").html(response.emp_no)
                    $("#prof-emp-status").html(response.employment_status)
                },
                error: function(err) {
                    console.log(err);
                }
            });
        })
    });
</script>
@endpush

