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
</head>

<style>
.navbar-header{
	background-color: #395583;
	position: fixed;
	top:0;
	width: 100%;
	height: 50px;
	z-index: 999;
}

.container-fluid{
	margin: 0%;
	height:40px;
}

.adulogo{
	width: 150px;
	height: 150px;
	margin-top: -3px;
	margin-left: -15px;
}

.navbar-profile{
	margin-top: -110px;
}

.navbar-profile .dropdown-menu{
	position: absolute;
	top: 100%;
	right: auto;
	left: 30px;
	font-family: 'Times New Roman';
	z-index: 100;
}

.navbar-text{
	color: white;
	font-size: 15px;
	font-family: 'Times New Roman';
	position: absolute;
	top: 50%;
	position:fixed;
	transform: translate(-50%, -50%);
	top: 50%;
	left: 50%;
}
.dashboardoptions{
	font-family: 'Times New Roman';
	font-size: 18px;
}

.nav-link img {
	border-radius: 50%;
	width: 36px;
	height: 36px;
	margin: -8px 0;
	float: right;
	margin-right: -5px;
}

.badge-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    margin-left: 34%;
}

.user-action{
	color: #ffffff;
	font-family: 'Times New Roman';
	font-size: 16px;
}

.user-action:hover{
	color: #ffffff;
	font-family: 'Times New Roman';
	font-size: 16px;
}

body {
    font-family: 'Times New Roman';
}

.dropdownbox-num_id{
    float:right;
    margin-right: 35px;
    margin-top: 25px;
    margin-bottom: 10px;
    text-align: center;
    opacity: 0;
}

/*TITLE RECRUITMENT AND PLACEMENT*/
.mforecastform-grid-container { 
    width: 96%; 
    margin-left: 30px;
    margin-right: 30px;
    margin-top: 25px;
    border-radius: 10px;
} 

.mforecastform-grid-con-title {
    display: grid; 
    grid-template-columns: 1fr 1fr;
    width: 100%; 
    background-color: #395583;
    height: 50px;
    border-radius: 10px;
}

.mforecastform-text-title {
    color: #fff;
    font-weight: bold;
    font-size: x-large;
    margin-top: 7.5px;
    margin-left: 15px;
}

.mforecastform-text-title-approved {
    color: #fff;
    font-weight: bold;
    font-size: x-large;
    margin-top: 7.5px;
    margin-left: 83%;
}

.mforecastform-grid-text-nxtpage {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    margin-right: 10px;
}

.mforecastform-text-nxtpage {
    color: #FFFFFF;
    font-size: 15px;
    text-align: center;
    text-decoration: none;
    margin-right: 4px;
}

.mforecastform-text-nxtpage:hover {
    color: black;
}

.mforecastform-img-nxt {
    height: 25px;
    margin-left: 5px;
    margin-right: 5px;
}


.dark-grey-background{
    margin-left: 30px; 
    margin-right: 30px;
    margin-top: 20px;
    margin-bottom: 30px;
    border-radius: 10px;
    background-color: #f8f8f8;
    height: fit-content;
    width: 96%;
    padding-bottom: 30px;
}

h1 { /*Manpower Forecast Form*/
    font-family: 'Times New Roman';
    font-size: 28px;
    line-height: 15px;
    text-align: center;
    /** margin-right: 755px;**/
    margin-left: 250px;
}

h2 { /*For title inside divs*/
    font-family: 'Times New Roman';
    font-size: 20px;
    line-height: 20px;
    text-align: left;
    margin-left: 15px;
}


form {
    margin: 0;
}


.table-fmanpower-form{
    text-align: center;
    width: 97%;
    margin-top: 10px;
    margin-left: 20px;
    border: none;
    padding: 0%;
    border-collapse: collapse;
}

.table-fmanpower-form td, .table-fmanpower-form th {
    height: 20px;
    margin:0%;
    border: none;
    padding:0%;
}

.dropsec-title{
    width: 20px;
    text-align: left;
    
}
.dropsec-title1{
    width: 70px;
    text-align: left;
    
}
.dropsec-title2{
    width: 100px;
    text-align: left;
}
.dropsec-title3{
    width: 190px;
    text-align: left;
}
.dropsec-title4{
    width: 60px;
    text-align: right;
}

.dropsec-contents-ay, .dropwdown-select{
    width: 140px;
    text-align: left;

}

.dropwdown-select-colleges, .dropsec-contents-colleges{
    width: 140px;
    padding: 0%;
    text-align: left;
}

.optiondisabled{
    color: #595959;
    opacity: 0.6;
}

.dropwdown-select-department, .dropsec-contents-dep{
    width: 200px;
    text-align: left;
}

.dropdownbox-teach, .dropsec-contents-numteacreq{
    width:80px;
    text-align: left;

}

.dropwdown-select-sem, .dropsec-contents-sem {
    width: 110px;
    height:25px;

}

.dropsec-contents-sem {
        text-align: right;
}  


/*EXISTING MANPOWER COMPLEMENT*/

.light-grey-existingmanpower{
    margin-left: 20px; 
    margin-right: 30px;
    margin-top: 20px;
    border-radius: 10px;
    background-color: #FFFFFF;
    height: fit-content;
    width: 97%;
}

.grid-con-existingmanpower{
    border-radius: 10px;
}

.forecasting-EMC{
    border: none;
    border-collapse: collapse;
    text-align: center;
    width: 97%;
    margin-top: 10px;
    margin-left: 17px;
    padding: 0%;
}

.forecasting-EMC td, .forecasting-EMC th {
    border: none;
    border-collapse: collapse;
    padding: 0%;
    font-size: 15px;
}

.forecasting-EMC td, .forecasting-EMC th {
    padding: 3px;
    width: 30px;
    height: 25px;
    font-size: 15px;
    text-align: left;
}

.totalbtn{
    border-width: 0.5px;
    border-color: #395583;
    background-color: #f8f8f8;
    color: #395583;   
    width: 100px;
    font-weight: 700;
}

.totalbtnmajorsubj{
    border: none;
    background-color: #f8f8f8;
    color: #395583;   
    width: 100%;
    font-weight: 700;
}

.totalbtnservsubj{
    border: none;
    background-color: #f8f8f8;
    color: #395583;   
    width: 100%;
    font-weight: 700;
}

.totalrow{
    background-color: #f8f8f8;
}

.addbtn {
    border: 0.5px solid #395583;
    background-color: #f8f8f8;
    color: #395583;   
    width: 100%;
    font-weight: 700;
    text-align: center;
}


.forecasting-EMC .emc-titlecol{
    width: 20%;
}

.forecasting-EMC .emc-total{
    width: 5%;
    text-align: right;
}

.forecasting-EMC .emc-inputtxt {
    width: 20%;
    text-align: left;
    margin-left: 10px;

}

.txtboxemc{
    width:200px;
    margin-right: 10px;
    margin-left: 0px;
}

/*NAME OF FACULTY MEMBERS TO BE REPLACED*/

.light-grey-facultymembers{
    margin-left: 20px; 
    margin-right: 20px;
    margin-top: 20px;
    border-radius: 10px;
    background-color: #FFFFFF;
    height: fit-content;
    width: 97%;
}

.tablefr-overall-status{
    border: 1px solid #595959;
    border-collapse: collapse;
    text-align: center;
    width: 97%;
    margin-left: 20px;
    padding: 0%;
    
}

.tablefr-overall-status th, .tablefr-overall-status td {
    border: 1px solid #595959;
    border-collapse: collapse;
    font-size: 15px;
    padding: 3px;
    height: 25px;
    position: relative;
    }

.text-con-fr-first-section{
    width: 25%;
    background-color: #E4EBF7;
    font-weight: 700;

}

.text-con-fr-second-section{
    width: 20%;
    font-weight: 700;
    background-color: #E4EBF7;
}

.text-con-fr-third-section{
    width: 30%;
    font-weight: 700;
    background-color: #E4EBF7;
}

.action-buttons{
    width: 9%;
}

.reasonforhiring, .namefacreplace, .reasonreplace{
    height: 100%;
    width: 100%;
    border: none;
    text-align: center;
}

.addmem{
    border: none;
    background-color: #395583;
    color: #ffffff;   
    width: 95%;
    padding: 0%;
    font-weight: 550;
    text-align: center;
    display: inline-block;
}

.addsubj {
    border: none;
    background-color: #395583;
    color: #ffffff;   
    width: 95%;
    padding: 0%;
    font-weight: 550;
    text-align: center;
    display: inline-block;
    height: 40px;
}

.addmem:Hover, .addsubj:hover{
    background-color: #E4EBF7;
    color: #395583;
}

.remove-subj:hover, .remove_namefacreplacebtn:hover{
    background-color: #f3d9de;
    color: #bb3030;
}

.remove-subj, .remove_namefacreplacebtn {
    border: none;
    background-color: #bb3030;
    color: ffffff;
    width: 95%;
    padding: 0%;
    font-weight: 550;
    text-align: center;
    display: inline-block;

}

/*NUMBER OF ADDITIONAL FACULTY MEMBERS*/ /*JOB SPECIFICATION*/
.light-grey-jobspecification{
    margin-left: 20px; 
    margin-right: 20px;
    margin-top: 20px;
    border-radius: 10px;
    background-color: #FFFFFF;
    height: fit-content;
    width: 97%;
}

.table-num-add-fac{
    border: none;
    border-collapse: collapse;
    text-align: center;
    width: 97%;
    margin-top: 10px;
    margin-left: 17px;
    padding: 0%;
}

.table-num-add-fac td{
    border: none;
    padding: 2px;
}

/*A.*/
.light-grey-majorsubjects{
    margin-left: 20px; 
    margin-right: 30px;
    margin-top: 20px;
    border-radius: 10px;
    background-color: #FFFFFF;
    height: fit-content;
    width: 97%;
}

.major-subjects{
    border: 1px solid #595959;
    border-collapse: collapse;
    text-align: center;
    width: 97%;
    margin-top: 10px;
    margin-left: 20px;
    padding: 0%;
}

.major-subjects,  .major-subjects td, .major-subjects th {
    border: 1px solid #595959;
    border-collapse: collapse;
    padding: 0%;
    font-size: 15px;
}
.major-subjects td, .major-subjects th {
    padding: 0%;
    width: 30px;
    height: 25px;
    font-size: 15px;
}

.mforecast-A{
    width: 95%;

}

/*B.*/
.emc-inputtext::placeholder{
    width: 100%;
    border: none;
    text-align: center;
    opacity: 0.5;
}


.emc-inputtext{
    width: 100%;
    border: none;
    text-align: center;

}
.light-grey-servicesubjects{
    margin-left: 20px; 
    margin-right: 30px;
    margin-top: 20px;
    border-radius: 10px;
    background-color: #FFFFFF;
    height: fit-content;
    width: 97%;
}

.service-subjects {
    border: 1px solid #595959;
    border-collapse: collapse;
    text-align: center;
    width: 97%;
    margin-top: 10px;
    margin-left: 20px;
    padding: 0%;
}
.service-subjects td, .service-subjects th {
    padding: 3px;
    height: 25px;
    font-size: 15px;
}

.service-subjects th {
    background-color: #E4EBF7 ;
}

.servicesubjsrow{
    width:40%;
}
.semsrow{
    width: 30%;
}
.numbervariable{
    width: 13%;
}

/*GRAND TOTAL*/
.light-grey-grandtotal{
    margin-left: 20px; 
    margin-right: 30px;
    margin-top: 20px;
    border-radius: 10px;
    background-color: #FFFFFF;
    height: fit-content;
    width: 97%;
}

.grand-total {
    border: 1px solid #595959;
    border-collapse: collapse;
    text-align: center;
    width: 97%;
    margin-top: 10px;
    margin-left: 20px;
    padding: 0%;
}

.grand-total , .grand-total td, .grand-total th {
    border: 1px solid #595959;
    border-collapse: collapse;
}
.grand-total td, .grand-total th {
    padding: 3px;
    width: 30px;
    height: 25px;
    font-size: 15px;
}

.btn-eval-save{
    color: #ffffff;
    background-color: #395583;
    border-color: #395583;
    border-radius: 5px;
    width: 300px;
    margin-left: 73.5%;
    text-align: center;
    display: block;
    margin: 0 auto;
}

.btn-eval-save:hover{
    background-color:#ffff;
    border-color: #395583;
    border-radius: 5px;
    color: #395583;
    display: block;
    margin: 0 auto;
}



/*EMPLOYMENT STATUS*/
.grid-con-employment-stat{
    display: grid; 
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr; 
    width: 100%; 
    margin-left: 30px;
    margin-right: 20px;
    margin-top: 30px;
    font-size: 15px;
}


.grid-con-text-jobspecif{
    display: flex;
    justify-content: center;
    font-weight: bold;
    font-size: 20px;
}

.table-jobspecification {
    display: flex;
    justify-content: center;
    text-align: right;
    margin-top: 10px;
    border-collapse: separate;
    border-spacing: 0 15px;
    border: none;
}

.table-jobspecification td:nth-child(1) {
    text-align: right;
    width: 50%;
    padding-left: 60px;
    border: none;
}

.table-jobspecification td:nth-child(2) {
    padding-left: 40px;
    border: none;
}

/*ATTACH SIGNATURE*/
.light-grey-signature{
    margin-left: 20px; 
    margin-right: 20px;
    margin-top: 30px;
    border-radius: 10px;
    background-color: #FFFFFF;
    height: fit-content;
    width: 97%;
    padding-bottom: 20px;
}

.grid-con-chairperson-dean{
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    width: 100%; 
    margin-left: 20px;
    margin-right: 20px;
    margin-top: -10px;
}

.dean-signature{
    margin-left: -20px;
}

.grid-con-approval{
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    width: 100%; 
    margin-left: 20px;
    margin-right: 20px;
    margin-top: -10px;
}

.vpa-signature{
    margin-left: -20px;
}

.blue-header{
    background-color: #E4EBF7;
}

.btn-deleteforecast{
    color: #fff;
    background-color: #f03535;
    border-color: #f03535;
    height: 30px;
    border-radius: 0%;
    width: 80%;
    
}

.btn-deleteforecast:hover{
    background-color:#ffffff;
    border-color: #f03535;
    color: #f03535;
}

input[type="radio"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 15px; /* Set the width to make the radio buttons larger */
    height: 15px; /* Set the height to make the radio buttons larger */
    border: 1px solid #000; /* Add a border to create a custom appearance */
    border-radius: 50%; /* Make it circular */
    vertical-align: middle;
}

/* Style for the selected (checked) radio buttons */
input[type="radio"]:checked {
    background-color: black; /* Set the background color to black */
}

/* Center the options in the dropdown */
.dropwdown-select {
    text-align: center;
}

/* Center the selected option when displayed */
.dropwdown-select option {
    text-align: center;
}

.dropwdown-select-sem{
    text-align: center;
}

.dropwdown-select-sem option{
    text-align: center;
}

/*Approval - Forecast Form Attach Signature*/

.mforecastform-grid-container { 
    display: grid; 
    grid-template-columns: 1fr;
    width: 96%; 
    margin-left: 30px;
    margin-right: 30px;
    margin-top: 20px;
    border-radius: 10px;
} 

.mforecastform-grid-con-title{
    background-color: #395583;
    height: 50px;
    border-radius: 10px;
}

/* Disapproved */
.status-red { 
    background-color: #EECCCA !important;
    color: black;
}

/* Completed */
.status-green {
    background-color: #C9DBBA !important;
    color: black;
}

/* Pending */
.status-yellow {
    background-color: #f1e6c1 !important;
    color: black;
}

/* Waiting for Approval */
.status-orange { 
    background-color: #eed7ca !important;
    color: black;
}

/* To be sent for Approval */
.status-blue {
    background-color: #f9dca5 !important;
    color: black;
}

/* Approved */
.status-violet {
    background-color: #b7f9b7b0 !important;
    color: #000000;
}

.search-container {
	display: flex;
	align-items: center;
    float: right;
	margin-bottom: 1%;
    font-size: 18px;
    margin-right: 78px;
    width: 200px;
}

.search-container .search-icon {
	margin-left: -30px;
	align-items: center;

}

.grid-container-print-backtodashboard { 
    display: grid; 
    grid-template-columns: 1fr 1fr;
    width: 96%; 
    margin-left: 30px;
    margin-right: 30px;
    margin-top: 60px;
    border-radius: 10px;
}
 
.mrform-print {
    display: flex;
    align-items: center; /* Align items horizontally */
    float: right;
    margin-right: 10px;
}

.mrform-print:hover{
    text-decoration: none;
}

.mrform-print i {
    margin-right: 5px; /* Adjust the spacing between the icon and text */
}

/*GO BACK TO DASHBOARD*/
.text-showmrform-backtodashboard {
    display: inline-block; /* Change display to inline-block */
    color: #395583;
    font-size: 15px;
    padding: 0 5px; /* Add padding to create a clickable area around the text */
    text-decoration: none; /* Remove underline by default */
}

.text-showmrform-backtodashboard:hover {
    color: black;
    text-decoration: none;
}

</style>

<body>

    <nav class="navbar navbar-header ">
        <div class="container-fluid" font-style="#395583">
            <div class="adulogo">
                <a href="{{ route('processingdashboard.index') }}">
                    <img src="{{url('/images/adulogowhite.png')}}" class="img-fluid">
                </a>
            </div>
            <ul class="navbar-nav navbar-profile">
                <div class="nav-item dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action" id="navname">{{ $loggedInUser->name }}<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" class="avatar" alt="Avatar" style="margin-left:10px;"> <b class="caret"></b></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('showProcessingProfile') }}" class="dropdown-item"><i class="fa fa-user-o"></i>Profile</a>
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-logout dropdown-item"><i class="fa fa-user-o"></i>Logout</button>
                        </form>
                    </div>
                </div>
                {{-- <div class="badge-container">
                    <span class="badge badge-danger" style="font-size: 15px; padding: 8px 10px; margin-right: 30px;">
                        <i class="fa fa-bell"></i> <!-- Notification icon -->
                        {{ \App\Models\ManpowerProcessing::where('approval_status', "Pending")->count() }}
                    </span>
                </div> --}}
            </ul>
        </div>
    </nav>
    
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

    <div>
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block text-center">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
        @endif
    </div>

    <!-- BACK TO DASHBOARD AND PRINT DOCUMENT -->
    <style>
    @media print {
        .navbar{
            display:block !important;
        }
        #navname,
        #printButton,
        #back,
        #save,
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
        <a class="text-showmrform-backtodashboard" id="back" href="{{route('processingdashboard.index')}}">Go back to Dashboard</a>
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

    <!-- TITLE FORM -->
    <div class="mforecastform-grid-container shadow">
        <div class="mforecastform-grid-con-title">
            <div class="mforecastform-text-title">
                Status      
            </div>
            <div class="mforecastform-text-title-approved">
                Approved
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
        <div class="light-grey-existingmanpower shadow">
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
                    
                    <div class="text-chairperson-signature" style="margin-left: 26%; margin-top: 10px; text-decoration: underline;">
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
            </div>

            <hr class="line-fourth-mrform">

            <br>
            <div class="grid-con-approval">
                <div class="hrmd-director-signature">
                    @if($forecastSection1->directorsignature)
                        <div id="signature-box-3" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                            <img id="signature-preview-3" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $forecastSection1->directorsignature) }}" alt="Chairperson Signature" />
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
                    @if($forecastSection1->vpasignature)
                        <div id="signature-box-4" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                            <img id="signature-preview-4" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $forecastSection1->vpasignature) }}" alt="Dean Signature" />
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

                    <div class="text-dean-signature" style="margin-left: 32%; margin-top: 10px; text-decoration: underline;">
                        VP ADMINISTRATION
                    </div>
                </div>  
                <br>                  
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
        </div>   
        <br><br> 
    </div>


<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>