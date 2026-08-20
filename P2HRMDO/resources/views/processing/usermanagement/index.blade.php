
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
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	</head>

  	<style>
	.body{
		font-family: var(--app-font);
	}

	.navbar-header{
		background-color: #395583;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 50px;
		z-index: 999;
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
		font-family: var(--app-font);
		z-index: 100;
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
		font-family: var(--app-font);
		font-size: 16px;
	}

	.user-action:hover{
		color: #ffffff;
		font-family: var(--app-font);
		font-size: 16px;
	}

	.navbar-text{
		color: white;
		font-size: 15px;
		font-family: var(--app-font);
		position: absolute;
		top: 50%;
		position:fixed;
		transform: translate(-50%, -50%);
		top: 50%;
		left: 50%;
	}

	.nav-link img {
		border-radius: 50%;
		width: 36px;
		height: 36px;
		margin: -8px 0;
		float: right;
		margin-right: -5px;
	}

	.sidebar {
		z-index: 999;
		top: 0;
		background: #DDE6F5;
		margin-top: 50px;
		padding-top: 30px;
		position: fixed;
		left: 0;
		width: 250px;
		height: calc(100% - 5%);
		transition: 0.5s;
		transition-property: left;
		overflow-y: auto;
	}

	.profile_info {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	.sidebar .profile_info .profile_image {
		width: 100px;
		height: 100px;
		border-radius: 100px;
		margin-bottom: 10px;
	}

	.sidebar .profile_info h4 {
		color: black;
		margin-top: -10px;
		margin-bottom: 20px;
	}

	.sidebar a {
		color: black;
		display: block;
		width: 100%;
		line-height: 60px;
		text-decoration: none;
		padding-left: 40px;
		box-sizing: border-box;
		transition: 0.5s;
		transition-property: background;
	}

	.sidebar a:hover {
		background: #395583;
	}

	.sidebar-active{
		background: #395583;
		color: #F8F8F8
	}

	.sidebar i {
		padding-right: 10px;
	}

	.content {
		width: (100% - 250px);
		margin-top: 50px;
		padding: 20px;
		margin-left: 250px;
		background: url(background.png) no-repeat;
		background-position: center;
		background-size: cover;
		height: 100vh;
		transition: 0.5s;
		position: relative;
		padding-top: 50px; /* same height as the navbar */
	}

	#check:checked~.content {
		margin-left: 60px;
	}

	#check:checked~.sidebar .profile_info {
		display: none;
	}

	#check {
		display: none;
	}

	.content .card p {
		background: #fff;
		padding: 15px;
		margin-bottom: 10px;
		font-size: 14px;
		opacity: 0.8;
	}

	.btn-adduser{
		color: #395583;
		background-color: #ffffff;
		border-color: #395583;
		width: 100%;
    }

    .btn-adduser:hover{
		background-color:#395583;
		border-color: #395583;
		color: #ffffff;
    }

	.btn-rolepermission{
		color: #fff;
		background-color: #FFC107;
		border-color: #FFC107;
		width: 100%;
		height: 30px;
		line-height: 15px;
    }

    .btn-rolepermission:hover{
		background-color:#ffffff;
		border-color: #FFC107;
		color: #FFC107;
    }

	.btn-view{
		color: #246108f1;
		background-color: #d0eec2f1;
		border-color: #246108f1;
		width: 50%;
		height: 30px;
		margin-right: 10px;
    }

    .btn-view:hover{
		background-color:#ffffff;
		border-color: #246108f1;
		color: #246108f1;
    }

	.btn-edit{
		color: #ff8c00; 
		background-color: #ffe4c4;
		border-color: #ff8c00;
		width: 60%;
		height: 30px;
		margin-right: 5px;
    }

    .btn-edit:hover{
		background-color:#ffffff;
		border-color: #ff8c00;
		color: #ff8c00;
    }

	.btn-delete{
		color: #f03535;
		background-color: #ffcece;
		border-color: #f03535;
		width: 60%;
		height: 30px;
		
    }

    .btn-delete:hover{
		background-color:#ffffff;
		border-color: #f03535;
		color: #f03535;
    }

	.modal-backdrop {
    	z-index: 1000;
	}

	.modalDelete{
		z-index: 9999;
	}

	h1{
	font-family: var(--app-font);
	font-size: 23px;
	line-height: 10px;
	}

	h3 {
		font-family: var(--app-font);
		font-size: 15px;
		text-align: center;
		line-height: 20px;
	}

	.grid-con-input-eval-sec{
		margin-left: 12.5px; 
		margin-right: 10px;
		margin-top: 20px;
		margin-bottom: 30px;
		border-radius: 10px;
		background-color: #F8F8F8;
		height: fit-content;
		width: 98%;
		padding: 20px;
		display: flex;
	}
	
	.header {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.titletext {
		margin-top: -20px;
		margin-left: 20px;
		font-size: 35px; 
		font-weight: 700; 
		font-family: var(--app-font);
	}

	.search-container {
		margin-top: -40px;
		align-items: center;
		display: flex;
		justify-content: flex-end;
		margin-right: 10px;
	}

	.umsearch{
		font-family: var(--app-font);
		font-size: 18px;
		padding: 3px;
		width: 320px; /* Adjust the margin as needed */
		border-radius: 5px;
		border-width: 1px;
		
	}
	.umsearch::placeholder{
		font-family: var(--app-font);
		font-size: 18px;
		padding-left: 3px;
		align-items: center;
	}

	.search-container .search-icon {
		position: absolute;
		margin-left: 20px;
		align-content: center;
		display: flex;
		justify-content: flex-end;
		padding: 3px;
	}

	.custom-pagination {
		text-align: center; /* Center the entire pagination */
		margin-bottom: 50px;
	}

	.pagination-list {
		list-style: none;
		display: flex;
		justify-content: center;
		align-items: center;
		margin: 0;
		padding: 0;
	}

	.pagination-item {
		margin-right: 10px;
	}

	.pagination-item:last-child {
		margin-right: 0;
	}

	.disabled-link {
		pointer-events: none; /* Disable clicking on the link */
		opacity: 0.5; /* Make the link appear disabled */
	}
	.container-fluid{
		margin: 0%;
		height:40px;
	}

	.dashboardoptions{
		font-family: var(--app-font);
		font-size: 18px;
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
						<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">{{ $loggedInUser->name }}<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" onerror="this.onerror=null; this.src='{{ asset('images/profilepic.png') }}';" class="avatar" alt="Avatar" style="margin-left:10px;"> <b class="caret"></b></a>
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
						<span class="badge badge-danger" style="font-size: 15px; padding: 8px 10px; margin-right: 5px;">
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

		<div class="sidebar">
			<div class="profile_info">
				<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" onerror="this.onerror=null; this.src='{{ asset('images/profilepic.png') }}';" alt="Profile Image" class="profile_image" id="profile-image">
				<h1>{{ $loggedInUser->name }}<br></h1>
				<h3>{{ $loggedInUser->position }} of {{ $loggedInUser->department }}</h3>
			</div>
			<a href="{{ route('processingdashboard.index') }}"><i class="fas fa-desktop"></i><span class="dashboardoptions">Dashboard</span></a>
			<a href="{{ route('forecastingdata.index') }}"><i class="fas fa-database"></i><span class="dashboardoptions">Manpower Forecast</span></a>
			<a href="{{ route('forecastingsystem.index') }}"><i class="fas fa-chart-bar"></i><span class="dashboardoptions">Forecasting Data</span></a>
			<a href="{{ route('faculty.index') }}"><i class="fas fa-users"></i><span class="dashboardoptions">List of Faculty</span></a>
			<a class="sidebar-active" href="{{ route('users.index') }}"><i class="fas fa-cogs sidebar-active"></i><span class="sidebar-active dashboardoptions">User Management</span></a>

		</div>
		<!--sidebar end-->
		<div class="content ">
			<div class="titletext">
				User Management
			</div>

			<div class="search-container">
				<input class="umsearch" type="text" id="searchInput" placeholder="Search Filter">
				<i class="material-icons search-icon">search</i>
			</div>

			<style>
				.umheadertxt{
					font-family: var(--app-font);
					font-weight: 700;
					font-size: 18px;
					
				}

				.umcontenttxt{
					font-family: var(--app-font);
					font-weight: 500;
					font-size: 18px;
				}

				.actionsum{
					width: 100%; 
				}
			</style>
            <div class="row">
                <div class="table-responsive">
					{{-- <div style=" display: flex; flex-direction: column; align-items: center; margin-bottom: 10px; margin-top: 30px;">
						<div class="container" style="width:40%;">
							<a type="button" class="btn btn-adduser shadow-none" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Add User</a>
						</div>
					</div>				 --}}

					<div class="grid-con-input-eval-sec shadow">
                    <table class="table table-hover"  id="UserTable">
                        <thead>
                        <tr>
                            <th scope="col" class="umheadertxt" style="width: 30%;">Name</th>
                            <th scope="col" class="umheadertxt" style="width: 20%;">Email</th>
                            <th scope="col" class="umheadertxt" style="width: 10%;">Username</th>
							<th scope="col" class="umheadertxt" style="width: 15%;">Position</th>
                            <th scope="col" class="umheadertxt" style="width: 15%;">Role</th>
                            <th scope="col" class="umheadertxt" style="width: 10%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="umcontenttxt" style="width: 30%;">{{$user->name}}</td>
                                <td class="umcontenttxt" style="width: 20%;">{{$user->email}}</td>
                                <td class="umcontenttxt" style="width: 10%;">{{$user->username}}</td>
								<td class="umcontenttxt" style="width: 15%;">{{$user->position}}</td>
                                <td class="umcontenttxt" style="width: 15%;">
									@foreach($user->roles as $role)
										{{$role->name}}
									@endforeach
								</td>
								<td class="actionsum" style="width: 10%;">
									<a href="{{ route('users.show', $user->id) }}" class="btn btn-view shadow-none" data-toggle="tooltip">
										<i class="material-icons actionsum" style="margin-top: -15%; margin-left: -30%;">visibility</i>
									</a>
								</td>
                                {{-- <td class="actionsum">
									<a href="{{route('users.edit', $user->id)}}" class="btn btn-edit shadow-none" data-toggle="tooltip" style="margin-left: -80%;">
										<i class="material-icons actionsum" style="margin-top: -30%; margin-left: -150%;">&#xE254;</i>
									</a>
								</td> --}}
									{{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST"  onsubmit="return confirm('Delete user?')">
										@csrf
										@method('DELETE')
										<button class="btn btn-delete shadow-none" style="margin-left: -160%;"><i class="material-icons" style="margin-top: -30%; margin-left: -90%;">&#xE872;</i></button>
									</form> --}}
									{{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST">
										@csrf
										@method('DELETE')
										<button class="btn btn-delete shadow-none" data-toggle="modal" data-target="#confirm-delete"><i class="material-icons" style="margin-top: -20%; margin-left: -35%;">&#xE872;</i></button>
										<div class="modal modalDelete fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered ">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title" id="modal-label"><b>Delete User</b></h4>
													</div>
													<div class="modal-body">
														<p style="font-size: 20px; margin-top: 10px;">Are you sure you want to delete this user?</p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal" id="formcancel-btn">Cancel</button>
														<button type="submit" class="btn btn-danger">Delete</button>
													</div>
												</div>
											</div>
										</div>
									</form>
									<script>
										$('.btn-delete').click(function(e) {
											e.preventDefault(); // Prevent the default behavior of the button
											$('#confirm-delete').modal('show'); // Show the modal
										});
									</script>
		
									<script>
										$(document).ready(function() {
											$('#formcancel-btn').click(function() {
												$('#confirm-delete').modal('hide');
											});
										});
									</script> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
				
				<script>
					const searchInput = document.getElementById('searchInput');
					const dataTable = document.getElementById('UserTable');
					const tableRows = dataTable.getElementsByTagName('tr');
				
					searchInput.addEventListener('input', function() {
						const searchText = searchInput.value.toLowerCase();
				
						for (let i = 1; i < tableRows.length; i++) {
							const row = tableRows[i];
							const rowData = row.getElementsByTagName('td');
							let isMatch = false;
				
							for (let j = 0; j < rowData.length; j++) {
								const cell = rowData[j];
								const cellText = cell.textContent.toLowerCase();
				
								if (cellText.includes(searchText)) {
									isMatch = true;
									break;
								}
							}
				
							row.style.display = isMatch ? '' : 'none';
						}
					});
				</script>

				<div class="custom-pagination">
					<ul class="pagination-list">
						<li class="pagination-item{{ $users->onFirstPage() ? ' disabled' : '' }}">
							<a href="{{ $users->previousPageUrl() }}" class="pagination-link{{ $users->onFirstPage() ? ' disabled-link' : '' }}"{{ $users->onFirstPage() ? ' aria-disabled="true"' : '' }}>&laquo; Previous</a>
						</li>
						@foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
							<li class="pagination-item{{ $page == $users->currentPage() ? ' active' : '' }}">
								<a href="{{ $url }}" class="pagination-link{{ $page == $users->currentPage() ? ' disabled-link' : '' }}">{{ $page }}</a>
							</li>
						@endforeach
						<li class="pagination-item{{ $users->currentPage() == $users->lastPage() ? ' disabled' : '' }}">
							<a href="{{ $users->nextPageUrl() }}" class="pagination-link{{ $users->currentPage() == $users->lastPage() ? ' disabled-link' : '' }}"{{ $users->currentPage() == $users->lastPage() ? ' aria-disabled="true"' : '' }}>Next &raquo;</a>
						</li>
					</ul>
				</div>						
            </div>
        </div>

		<!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>