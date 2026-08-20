<!doctype html>
<html lang="en">
  <head>
	<link rel="stylesheet" href="{{ asset('css/tokens.css') }}">
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{url('/images/ADULOGO.png')}}">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HRMDO Manpower Requisition and Forecasting System</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/req_printevaldatareport.css') }}"/>
    
  </head>
  <body>
       <!-- GOBACK AND DROPDOWN -->
       <div class="grid-con-eval-data-report-column" href="">
        <div class="goback">
            <img src="{{url('/images/back.png')}}" class="img-fluid img-goback">
            <a class="text-goback" href="req_mainpage.html">Go back to Evaluation Report Page</a>
        </div>
        <div class="dropdown-ay">
            <form action="#">
                <label for="ay-from">Academic Year:</label>
                <select name="ay-from" style="width:100px; height: 25px;">
                    <option value="2020-2021">2020-2021</option>
                    <option value="2021-2022">2021-2022</option>
                </select>

                <label for="ay-to">to</label>
                <select name="ay-to" style="width: 100px; height: 25px;">
                    <option value="2020-2021">2020-2021</option>
                    <option value="2021-2022">2021-2022</option>
                </select>
            </form>
        </div>
    </div>

    <!-- BASTA UNG CONTENT BEFORE MAG TABLE -->
    <div class="grid-con-eval-data-report shadow" href="">
        <div class="grid-con-eval-data-report-column">
            <div class="img-logo-eval-data" >
                <img src="{{url('/images/adulogoblue.png')}}" width="200px" height="45px">
            </div> 
            <div class="text-align-emp-data-report">
               <b>Employee Evaluation Data Report</b>
            </div>
            <div class="text-align-emp-data-display-left">
               Name: <b>employeename</b><br>
               Department: <b>employeedept</b>
            </div>
            <div class="text-align-emp-data-display-right">
               Employee Number: <b>employeenum</b><br>
               A.Y: <b> currentAY</b>
            </div>
        </div>
        <!-- OVERALL STATUS INDICATION -->
        <div class="grid-con-status">
            <table class="printevaldatareport-table-status">
                <tr>
                    <td class="box-status-red"colspan="2"></td>
                <td class="text-status-red" colspan="4">Not Suitable for Rehirement (0%-49%)</td>
                <td class="box-status-green" colspan="2"></td>
                <td class="text-status-green" colspan="4">Suitable for Rehirement (50%-100%)</td>
                <td class="box-status-yellow"colspan="2"></td>
                <td class="text-status-yellow" colspan="4">Subject for deliberation</td>
                </tr>
            </table>
        </div>
        <!-- SIGNATURE SECTION -->
        <div class="grid-con-signature-column">
            <div class="chairperson-signature">
                SECTION HEAD/CHAIRPERSON'S SIGNATURE
            </div>
            <div class="dean-signature">
                DIRECTOR/DEAN'S SIGNATURE
            </div>
            <div class="chairperson-approvedby">
                Approved by:
            </div>
            <div class="dean-approvedby">
                Approved by:
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  </body>
</html>
 