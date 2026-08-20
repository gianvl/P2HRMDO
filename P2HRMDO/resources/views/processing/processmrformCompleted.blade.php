<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="{{url('/images/ADULOGO.png')}}">  
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HRMDO Manpower Requisition and Forecasting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
.body{
	font-family: 'Times New Roman';
}

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

.text-inputmrform-dashboard{
    display: flex;
    color: #395583;
    font-size: 18px;
    margin-top: 1%;
    text-align: center;
    justify-content: center;
}

.text-inputmrform-dashboard:hover{
    color: black;
    text-decoration: none;
}

.text-editmrform-dashboard{
    display: flex;
    color: #395583;
    font-size: 18px;
    margin-top: 1%;
    text-align: center;
    justify-content: center;
}

.text-editmrform-dashboard:hover{
    color: black;
    text-decoration: none;
}

/*TITLE RECRUITMENT AND PLACEMENT*/
.grid-container-element-content { 
    display: grid; 
    grid-template-columns: 1fr;
    width: 96%; 
    margin-left: 30px;
    margin-right: 30px;
    margin-top: 20px;
    border-radius: 10px;
} 

.grid-con-title{
    background-color: #395583;
    height: 50px;
    border-radius: 10px;
}

.text-title{
    color: #fff;
    font-weight: bold;
    font-size: x-large;
    margin-top: 7.5px;
    margin-left: 15px;
}

/*REQUISITION FORM*/
.grid-con-req-form{
    margin-left: 30px; 
    margin-right: 30px;
    margin-top: 20px;
    margin-bottom: 30px;
    border-radius: 10px;
    background-color: #f8f8f8;
    height: fit-content;
    width: 96%;
    padding-bottom: 20px;
}

.grid-con-req-form-1s{
    display: grid; 
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr; 
    justify-content: center;
    text-align: center;
    margin-bottom: 10px;;
}

.grid-con-req-form-2s{
    display: grid; 
    grid-template-columns: 1.5fr 0.62fr; 
    margin-left: 15px;;
    padding: 10px;
    gap: 50px;
    justify-content: center;
}

/*FIRST SECTION*/
.grid-con-first-section{
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    width: 97%; 
    margin-left: 20px;
    margin-right: 20px;
    margin-top: 25px;
}

.text-mr-form{
    margin-top: 20px;
    font-weight: bold;
    color: #292828;
    font-size: 20px;
}

.table-mr-form{
    border: none;
    width: 80%;
    margin-top: 15px;
}

.text-mr-form-number{
    border: none;
    width: 100%;
    color: #6D6868;
}

.data-mr-form-number{
    border: none;
    width: 100%;
    color: #6D6868;
}

/*LINE*/
.line-mrform{
    height: 2px;
    background: #707070;
    width: 97%;
    margin-left: 20px;
    margin-top: 0px;
}

/*DROPDOWN COLLEGES*/
.grid-con-second-section{
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    width: 97%; 
    margin-left: 20px;
    margin-right: 20px;
}

.text-req-dept{
    color: #707070;
    font-size: 16px;
}

.table-num-emp-req{
    border: none;
    width: 100%;
    margin-top: -10px;
}

.text-num-emp-req{
    border: none;
    width: 100%;
    text-align: right;
    font-size: 15px;
    color: #6D6868;
}

.data-num-emp-req{
    border: none;
}

.dropwdown-req-dept{
    margin-left: 20px;
}

/*TEXT POSITION REQUIRED*/
.text-position-req{
    margin-top: 10px;
    margin-left: 20px;
    color: #707070;
    font-size: 15px;
}

/*DROPDOWN TEACHING/NON-TEACHING*/
.grid-con-fourth-section{
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    margin-bottom: -20px;;
    width: 100%; 
    color: #6D6868;
}

/*DROPDOWN REPLACEMENT*/
.grid-con-fifth-section{
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    width: 97%; 
    margin-left: 20px;
    margin-right: 20px;
    color: #6D6868;
}

/*DROPDOWN BUDGETED/NOT BUDGETED*/
.grid-con-sixth-section{
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    width: 97%; 
    margin-left: 20px;
    margin-right: 20px;
    color: #6D6868;
}

/*LINE*/
.line-second-mrform{
    height: 2px;
    background: #707070;
    width: 97%;
    margin-left: 20px;
    margin-top: 20px;
}

/*SECOND SECTION*/
.text-exist-manpower{
    color: #707070;
    font-size: 15px;
    margin-bottom: 20px;
}

.grid-con-exist-manpower{
    display: grid; 
    grid-template-columns: 1fr; 
    width: 100%; 
    color: #6D6868;
    font-size: 10px;
}
/*LINE*/
.line-third-mrform{
    height: 2px;
    background: #707070;
    width: 97%;
    margin-left: 20px;
    margin-top: 10px;
}

/*THIRD SECTION*/
.text-requestedby{
    margin-left: 20px;
    margin-top: -10px;
    color: #707070;
    font-size: 15px;
}

.grid-con-chairperson-dean{
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    width: 100%; 
    margin-left: 20px;
    margin-right: 20px;
    margin-top: 10px;
    color: #6D6868;
}

.dean-signature{
    margin-left: -20px;
}

/*LINE*/
.line-fourth-mrform{
    height: 2px;
    background: #707070;
    width: 97%;
    margin-left: 20px;
    margin-top: 20px;
}

/*FOURTH SECTION*/
.text-recommending-approval{
    margin-left: 20px;
    margin-top: -10px;
    color: #707070;
    font-size: 15px;
}
  
.grid-con-approval{
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    width: 100%; 
    margin-left: 20px;
    margin-right: 20px;
    margin-top: 10px;
    color: #6D6868;
}

.vpa-signature{
    margin-left: -20px;
}

/*SEND AND UPDATE REQ*/
.btn-send-req{
    margin-top: 50px;
    margin-bottom: 30px;
    color: #ffffff;
    background-color: #395583;
    border-color: #395583;
    width: 20%;
    font-size: 20px;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

.btn-send-req:hover{
    background-color:#ffffff;
    border-color: #395583;
    color: #395583;
}

.btn-update-req{
    color: #ffffff;
    background-color: #395583;
    border-color: #395583;
    width: 15%;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 50px;
    margin-bottom: 50px;
}

.btn-update-req:hover{
    background-color:#ffffff;
    border-color: #395583;
    color: #395583;
}

/*TO BE FILLED UP BY HR*/
.grid-con-hr{
    margin-left: 30px; 
    margin-right: 30px;
    margin-top: 80px;
    margin-bottom: 30px;
    border-radius: 10px;
    background-color: #f8f8f8;
    height: fit-content;
    width: 96%;
}


.grid-con-tobefilledup{
    display: grid; 
    grid-template-columns: 1fr; 
    width: 100%;
}

.text-tobefilledup{
    margin-left: 20px;
    margin-top:  20px;
    color: #707070;
    font-size: 15px;
}

.table-tobefilledup, .td-tobefilledup {
    text-align: left;
    color: #707070;
    border: none;
}

.table-tobefilledup{
    width: 90%;
    margin-top: 10px;
}

.text-tobefilledup{
    margin-top: 30px;
    font-weight: bold;
    color: #707070;
    font-size: 16px;
}
.table-tobefilledup{
    margin-left: 80px;
    margin-top: 30px;
    margin-bottom: 20px;
    font-size: 18px;
}


.btn-printfr{
    color: #ffffff;
    background-color: #395583;
    border-color: #395583;
    border-radius: 5px;
    width: 300px;
    margin-left: 77.8%;
    text-align: center;
}

.no-hover:hover, .no-hover:active, .no-hover:focus, .no-hover:active:focus {
    color: #212529;
}

.grid-container-submit { 
    display: flex;
    width: 96%; 
    border-radius: 10px;
    justify-content: center;
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

@if(session('alert'))
    <div class="alert alert-warning">
        {{ session('alert') }}
    </div>
@endif

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

<!-- BACK TO DASHBOARD AND PRINT DOCUMENT -->
<style>
    @media print {
        .navbar{
            display:block !important;
        }
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

<div class="grid-container-element-content shadow">
    <div class="grid-con-title">
        <div class="text-title">
            Status
            @if ($processingForms->approval_status == 'Unread' || $processingForms->approval_status == 'Pending')
                <form id="completed-modal" action="{{ route('completed', $processingForms) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')

                    <button type="submit" class="btn btn-completed btn-primary{{ $processingForms->approval_status === 'Completed' ? ' hide' : '' }}" style="float:right; margin-right:1%; margin-left:1%;">Completed</button>
                    
                    <div class="modal fade" id="update-complete" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal-label" style="color: black; font-weight: bold;">Update Form Status</h4>
                                </div>
                                <div class="modal-body">
                                    <p style="font-size: 20px; margin-top: 10px; color: black; text-align: center; font-weight: normal;">Update form status to Completed?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default no-hover" data-dismiss="modal" id="complete-cancel-btn">Cancel</button>
                                    <button type="submit" class="btn btn-danger" id="btn-confirm-completed">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>         
                </form>
                
                <form id="pending-modal" action="{{ route('pending', $processingForms) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-pending btn-danger{{ $processingForms->approval_status === 'Completed' ? ' hide' : '' }}" style="float:right;">Pending</button>
                    <div class="modal fade" id="update-pending" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal-label" style="color: black; font-weight: bold;">Update Form Status</h4>
                                </div>
                                <div class="modal-body">
                                    <p style="font-size: 20px; margin-top: 10px; color: black; text-align: center; font-weight: normal;">Update form status to Pending?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default no-hover" data-dismiss="modal" id="pending-cancel-btn">Cancel</button>
                                    <button type="submit" class="btn btn-danger" id="btn-confirm-pending">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <a style="float: right; margin-right: 2%">{{ $processingForms->approval_status }}</a>
            @endif

            <script>
                $(document).ready(function() {
                    $('.btn-completed').click(function(e) {
                        e.preventDefault();
                        $('#update-complete').modal('show');
                    });
            
                    $('#btn-confirm-completed').click(function() {
                        $('#completed-modal').submit();
                    });

                    $('#complete-cancel-btn').click(function() {
                        $('#update-complete').modal('hide');
                    });
            
                    $('.btn-pending').click(function(e) {
                        e.preventDefault();
                        $('#update-pending').modal('show');
                    });

                    $('#btn-confirm-pending').click(function() {
                        $('#pending-modal').submit();
                    });

                    $('#pending-cancel-btn').click(function() {
                        $('#update-pending').modal('hide');
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
                <span style="color: black;">{{ $processingForms->ay }}</span>
            </div>     
        </div>

        <div class="semesterColumn" style="margin-top: 20px;">
            <div class="text-req-dept" style="width: 100%;">
                <label for="ay1" style="margin-left: 10px; margin-right: 10px;">Semester:</label>
                <span style="color: black;">{{ $processingForms->semester }}</span>
            </div>
        </div>

        <div class="numempreqColumn" style="margin-top: 20px;">
            <div class="text-req-dept" style="width: 100%;">
                <label for="num_emp_required" style="margin-right: 20px;">No. of Employees Required:</label>
                <span style="color: black;">{{ $processingForms->num_emp_required }}</span>
            </div>
        </div>

        <table class="table-mr-form">
            <tbody>
                <tr>
                    <td class="text-mr-form-number">MR Form Number:</td>
                    <td class="data-mr-form-number" style="color: black;">{{ $processingForms->mrNum }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr class="line-mrform">

    <div class="grid-con-req-form-2s">
        <div class="grid-con-fourth-section">
            <label for="employment_status" style="margin-bottom: 20px;">EMPLOYMENT STATUS:</label>
            <span style="color: black;">{{ $processingForms->employment_status }}</span>

            <div class="text-req-dept" style="margin-bottom: 20px;">
                REQUISITIONING DEPARTMENT/UNIT/COLLEGE:
            </div>
        
            <div style="width: 100%; display: flex; justify-content: flex-start;">
                <div id="college" style="display: inline-block;"> <!-- Adjust the width as needed -->
                    <span style="color: black;">{{ $processingForms->college }}</span>
                </div>

                <div style="width: 1%; display: inline-block; margin-right: 10px; margin-left: 10px;">
                    -
                </div>
        
                <div id="department" style="display: inline-block;"> <!-- Adjust the width and margin as needed -->
                    <span style="color: black;">{{ $processingForms->department }}</span>
                </div> 
            </div>

            <!-- TEXT POSITION REQUIRED -->
            <div class="text-req-dept">
                POSITION REQUIRED: (Choose that is applicable)
            </div>

            <!-- DROPDOWN TEACHING/NON-TEACHING -->
            <div class="grid-con-section" style="margin-bottom: 20px;">
                <span style="color: black;">{{ $processingForms->position }}</span>
            </div>

            <div class="text-req-dept">
                <label for="dropdown2">New/Additional/Replacement:</label>
            </div>
            <div class="grid-con-section" style="margin-bottom: 20px;">
                <span style="color: black;">{{ $processingForms->category }}</span>
            </div>

            <div class="text-req-dept">
                <label for="textInput2">Reason for such request (if new/additional):</label>
            </div>
            <div class="grid-con-section" style="margin-bottom: 20px;">
                <span style="color: black;">{{ $processingForms->category_textbox }}</span>
            </div>
            
            <div class="text-req-dept">
                <label for="dropdown3" >Reason for Replacement:</label>
            </div>

            <div class="grid-con-section" style="margin-bottom: 20px;">
                <span style="color: black;">{{ $processingForms->replacement_dropdown }}</span>
            </div>

            <div class="text-req-dept">
                <label for="textInput3">Reason for Replacement (Others):</label>
            </div>
            <div class="grid-con-section" style="margin-bottom: 20px;">
                <span style="color: black;">{{ $processingForms->replacement_others_textbox }}</span>
            </div>

            <div class="text-req-dept">
                <label for="dropdown4">Budgeted/Not Budgeted:</label>
            </div>

            <div class="grid-con-section" style="margin-bottom: 20px;">
                <span style="color: black;">{{ $processingForms->budget }}</span>
            </div>

            <!-- Display uploaded file -->
            @if(isset($processingForms->fileInput))
                <p>Current File:</p>   
                @php
                    $extension = pathinfo($processingForms->fileInput, PATHINFO_EXTENSION);
                @endphp
                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) <!-- Check if it's an image -->
                    <img src="{{ asset('storage/' . $processingForms->fileInput) }}" alt="Uploaded Image" style="max-width: 100%; max-height: 200px;">
                @else
                    <a href="{{ asset('storage/' . $processingForms->fileInput) }}" target="_blank">View PDF</a>
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
                    <span style="color: black; margin-left: 5px; font-size: 15px;">{{ $processingForms->regular }}</span>
                </div>
                <div class="second-column" style="margin-bottom: 10px;">
                    <label for="Probationary" style="font-size: 14px;">PROBATIONARY:</label>
                    <span style="color: black; margin-left: 5px; font-size: 15px">{{ $processingForms->probationary }}</span>
                </div>
                <div class="third-column" style="margin-bottom: 10px;">
                    <label for="Contractual" style="font-size: 14px;">CONTRACTUAL:</label>
                    <span style="color: black; margin-left: 5px; font-size: 15px">{{ $processingForms->contractual }}</span>
                </div>
                <div class="fourth-column" style="margin-bottom: 10px;">
                    <label for="studentAssistant" style="font-size: 14px;">STUDENT ASSISTANT:</label>
                    <span style="color: black; margin-left: 5px; font-size: 15px">{{ $processingForms->studassistant }}</span>
                </div>
                <div class="fifth-column">
                    <label for="Total" style="font-size: 12px;">TOTAL:</label>
                    <span style="color: black; margin-left: 5px; font-size: 15px">{{ $processingForms->total }}</span>
                </div>
            </div> 
        </div>

        <div class="text-req-dept">
            <label for="textInput8">Specify Job Expertise Needed:</label>
          </div>
        <div class="grid-con-section" style="margin-bottom: 20px; margin-left: -555px; margin-right: 440px;">
            <span>{{ $processingForms->expertise_textbox }}</span>
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
            @if($processingForms->chairsignature)
                <div id="signature-box-1" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                    <img id="signature-preview-1" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $processingForms->chairsignature) }}" alt="Chairperson Signature" />
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
            @if($processingForms->deansignature)
                <div id="signature-box-2" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                    <img id="signature-preview-2" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $processingForms->deansignature) }}" alt="Dean Signature" />
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

            <div class="text-dean-signature" style="margin-left: 35%; margin-top: 10px; text-decoration: underline;">
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
            @if($processingForms->directorsignature)
                <div id="signature-box-3" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                    <img id="signature-preview-3" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $processingForms->directorsignature) }}" alt="Chairperson Signature" />
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
            
            <div class="text-chairperson-signature" style="margin-left: 34%; margin-top: 10px; text-decoration: underline;">
                HRMD DIRECTOR
            </div>
        </div>
        
        <div class="vpa-signature">
            @if($processingForms->vpasignature)
                <div id="signature-box-4" style="width: 85%; height: 120px; margin-top: 10px; text-align: center; position: relative;">
                    <img id="signature-preview-4" style="max-width: 100%; max-height: 80%; margin: 10px auto 0;" src="{{ asset('storage/' . $processingForms->vpasignature) }}" alt="Dean Signature" />
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

            <div class="text-dean-signature" style="margin-left: 33%; margin-top: 10px; text-decoration: underline;">
                VP ADMINISTRATION
            </div>
        </div>  
        <br>                  
    </div>
</div>

<div class="grid-con-hr shadow">
    <div class="grid-con-tobefilledup">
        <div class="text-tobefilledup">
            To be filled out by RECRUITMENT:
        </div>

        <table class="table-tobefilledup">
            <tbody>
                <tr>
                    <td class="td-tobefilledup" >Received by:</td>
                    <td class="td-tobefilledup" >Rank:</td>
                    <td class="td-tobefilledup" >Date:</td>
                </tr>
                <tr>
                    <td class="td-tobefilledup" style="color: black">{{ $processingForms->receivedBy }}</td>
                    <td class="td-tobefilledup" style="color: black">{{ $processingForms->rank }}</td>
                    <td class="td-tobefilledup" style="color: black">{{ $processingForms->datereceived }}</td>
                </tr>
                <tr>
                    <td class="td-tobefilledup">Name of Hiree:</td>
                    <td class="td-tobefilledup">Hiring Date:</td>
                    <td class="td-tobefilledup">Hiring Rate:</td>
                </tr>
                @foreach ($processingForms->manpowerProcessingHiree as $hiree)
                <tr>
                    <td class="td-tobefilledup" style="color: black;">{{ $hiree->hireeName }}</td>
                    <td class="td-tobefilledup" style="color: black;">{{ $hiree->hireeDate }}</td>
                    <td class="td-tobefilledup" style="color: black;">{{ $hiree->hireeRate }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> <br>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> --}}

</body>
</html>
