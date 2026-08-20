@extends ('layouts.app')

@section('body')
	<div class="content">
		<div class="col-12 mt-5">
			<div>
				@if ($message = Session::get('success'))
					<div class="alert alert-success  alert-block text-center">
						<button type="button" class="close" data-dismiss="alert">×</button>	
							<strong>{{ $message }}</strong>
					</div>
				@endif
			</div>
			<div class="card">
				<div class="card-body">
					<h4 class="header-title" style="display: flex; flex-direction: column; align-items: center;">Edit User Profile</h4>
					<form action="{{ route('updateApprovalProfile', ['id' => $loggedInUser->id]) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div style="display: flex; flex-direction: column; align-items: center; margin-top: 10px;">
							<label for="image" class="upload-btn"> 
								<input type="file" id="image" name="image" style="display: none;">
								<div class="circle-container">
									@if($loggedInUser->image)
										<img src="{{ asset('storage/images/' . $loggedInUser->image) }}" onerror="this.onerror=null; this.src='{{ asset('images/profilepic.png') }}';" alt="Profile Image Saved" id="profile-image1">
										@else
											<img src="{{ asset('images/profilepic.png') }}" alt="Profile Image Default" id="profile-image1">
										@endif
								</div>
								Click to Change Picture
							</label>
						</div>

						<script>
							document.getElementById('image').addEventListener('change', function(event) {
								const selectedImage = event.target.files[0];
								const profileImage = document.getElementById('profile-image1');
							
								if (selectedImage) {
									profileImage.src = URL.createObjectURL(selectedImage);
									profileImage.style.display = 'block'; // Show the image
								} else {
									profileImage.style.display = 'none'; // Hide the image if no image is selected
								}
							});
						</script>
						<br>
						<div class="form-row">
							<div class="form-group col-md-4 col-sm-12">
								<label for="name">Name<span class="required">*</span></label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" readonly minlength="3" value="{{$loggedInUser->name}}">
								@error('name')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
								<small class="form-text text-muted">Please enter your full name.</small>
							</div>
							<div class="form-group col-md-4 col-sm-12">
								<label for="email">Email<span class="required">*</span></label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email" readonly value="{{$loggedInUser->email}}">
								@error('email')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
								<small class="form-text text-muted">Please enter a valid email address.</small>
							</div>
							<div class="form-group col-md-4 col-sm-12">
								<label for="username">Username<span class="required">*</span></label>
								<input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter Username" readonly minlength="3" value="{{$loggedInUser->username}}">
								@error('username')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
								<small class="form-text text-muted">Username must be at least 3 characters.</small>
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-md-4 col-sm-12">
								<label for="college">College<span class="required">*</span></label>
								<input type="text" class="form-control" id="college" name="college" readonly value="{{ $loggedInUser->college }}">
								<small class="form-text text-muted">Please select the user's college.</small>
							</div>
							<div class="form-group col-md-4 col-sm-12">
								<label for="department">Department<span class="required">*</span></label>
								<input type="text" class="form-control" id="department" name="department" readonly value="{{ $loggedInUser->department }}">
								<small class="form-text text-muted">Please select the user's department.</small>
							</div>
							<div class="form-group col-md-4 col-sm-12">
								<label for="position">Position<span class="required">*</span></label>
								<input type="text" class="form-control" id="position" name="position" readonly value="{{ $loggedInUser->position }}">
								<small class="form-text text-muted">Please select the user's position.</small>
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-md-6 col-sm-12">
								<label for="password">Password<span class="required">*</span></label>
								<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password" minlength="6">
								@error('password')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
								<small class="form-text text-muted">Password must be at least 6 characters.</small>
							</div>
							<div class="form-group col-md-6 col-sm-12">
								<label for="password_confirmation">Confirm Password<span class="required">*</span></label>
								<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
								@error('password_confirmation')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
								<small class="form-text text-muted">Please confirm your password.</small>
							</div>
						</div>

						<script>
							const togglePassword = document.querySelectorAll('.toggle-password');
							
							togglePassword.forEach(icon => {
								icon.addEventListener('click', function() {
								const input = this.closest('.input-group').querySelector('input');
								if (input.type === 'password') {
									input.type = 'text';
									this.classList.remove('fa-eye-slash');
									this.classList.add('fa-eye');
								} else {
									input.type = 'password';
									this.classList.remove('fa-eye');
									this.classList.add('fa-eye-slash');
								}
								});
							});
						</script> 

						<!-- <div class="form-row">
							<div class="form-group col-md-12 col-sm-12">
								<label for="roles">Roles<span class="required">*</span></label>
								<div class="row">
									
								</div>
							</div>
						</div> -->
						<div style="display: flex; flex-direction:column; height: 20px;  align-items: center; margin-top: 20px; margin-bottom: 20px;">
							<button type="submit" class="btn btn-updateuser" id="saveUserBtn" disabled>Save User</button>
						</div> 
					</form>

					<script>
						// Function to validate the form before submission
						function validateForm() {
							const passwordField = document.getElementById('password');
							const confirmPasswordField = document.getElementById('password_confirmation');
					
							// Check if the password and password confirmation match
							if (passwordField.value.trim() !== confirmPasswordField.value.trim()) {
								// Display a prompt or alert
								alert("Password and Confirm Password do not match. Changes will not be saved.");
								
								// Prevent the form submission
								return false;
							}
					
							// Continue with the form submission
							return true;
						}
					
						// Function to enable/disable the "Save User" button based on form inputs
						function toggleSaveButton() {
							const passwordField = document.getElementById('password');
							const confirmPasswordField = document.getElementById('password_confirmation');
							const imageField = document.getElementById('image');
							const saveUserBtn = document.getElementById('saveUserBtn');
					
							// Enable the button if all conditions are met
							saveUserBtn.disabled = !(
								(passwordField.value.trim() === confirmPasswordField.value.trim()) &&
								((passwordField.value.trim() && confirmPasswordField.value.trim()) || (imageField.files.length > 0))
							);
						}
					
						// Attach the function to the input events of password and image fields
						document.getElementById('password').addEventListener('input', toggleSaveButton);
						document.getElementById('password_confirmation').addEventListener('input', toggleSaveButton);
						document.getElementById('image').addEventListener('change', toggleSaveButton);
					</script>
				</div>
			</div>
		</div>
	</div>

	<script>
		function updateDepartments() {
			var collegeDropdown = document.getElementById("college");
			var departmentDropdown = document.getElementById("department");
			var selectedCollege = collegeDropdown.value;

			// Clear existing options
			departmentDropdown.innerHTML = '<option disabled selected value="">Select Department</option>';

			$.ajax({
				type: 'GET',
				url: `/api/college/${selectedCollege}/department`,
				success: function(response) {
					console.log(response);
					const departments = response;
					departments.map(department => {
						departmentDropdown.innerHTML += `<option value="${department.department}">${department.department}</option>`;
					});
				},
				error: function(err) {
					console.log(err);
				}
			});
		}
	</script>
	
@endsection