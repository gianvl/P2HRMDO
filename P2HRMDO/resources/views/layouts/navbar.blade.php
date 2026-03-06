<nav class="navbar navbar-header">
    <div font-style="#395583">
        <div class="adulogo">
            @if ($loggedInUser->position == 'Chairperson' || $loggedInUser->position == 'Dean')
            <a href="{{ route('requestingdashboard.index') }}">
                <img src="{{ url('/images/adulogowhite.png') }}" class="img-fluid">
            </a>
            @elseif ($loggedInUser->position == 'VPA' || $loggedInUser->position == 'HRMDO Director')
            <a href="{{ route('approvaldashboard.index') }}">
                <img src="{{ url('/images/adulogowhite.png') }}" class="img-fluid">
            </a>
            @endif
        </div>
        <ul class="navbar-nav navbar-profile">
            <div class="nav-item dropdown">
                {{-- <b class="caret"></b>
                    @php
                        $approvalCount = 0; // Initialize the count variable
                        $loggedInUser = auth()->user(); // Assuming you have the logged-in user available

                        if ($loggedInUser->position === 'Chairperson') {
                            // Count the waiting for approval records in the Manpower table where the department matches the user's department
                            $approvalCount = \App\Models\Manpower::where('approval_status', 'Waiting for Approval')
                                ->where('department', $loggedInUser->department)
                                ->count();
                        } elseif ($loggedInUser->position === 'Dean') {
                            // Count the waiting for approval records in the Manpower table where the college matches the user's college
                            $approvalCount = \App\Models\Manpower::where('approval_status', 'Waiting for Approval')
                                ->where('college', $loggedInUser->college)
                                ->count();
                        } elseif ($loggedInUser->position === 'VPA' || $loggedInUser->position === 'HRMDO Director') {
                            // Count all waiting for approval records in the Manpower table
                            $approvalCount = \App\Models\ManpowerApproval::where('approval_status', 'Waiting for Approval')->count();
                        }
                    @endphp
                <span class="badge badge-danger" style="font-size: 15px; padding: 8px 10px; margin-right: 20px;">
                    <i class="fa fa-bell"></i> <!-- Notification icon -->
                    {{ $approvalCount }}
                </span> --}}

                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action" id="navname"> {{ $loggedInUser->name }}
                    <img src="{{ asset('storage/images/' . $loggedInUser->image) }}" class="avatar" alt="Avatar" style="margin-left:10px; color:azure">
                </a>
                <div class="dropdown-menu">
                    @if ($loggedInUser->position == 'Chairperson' || $loggedInUser->position == 'Dean')
                        <a href="{{ route('requestingdashboard.index') }}" class="dropdown-item"><i class="fa fa-user-o"></i>Dashboard</a>
                    @elseif ($loggedInUser->position == 'VPA' || $loggedInUser->position == 'HRMDO Director')
                        <a href="{{ route('approvaldashboard.index') }}" class="dropdown-item"><i class="fa fa-user-o"></i>Dashboard</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    @if ($loggedInUser->position == 'Chairperson' || $loggedInUser->position == 'Dean')
                        <a href="{{ route('profile.index') }}" class="dropdown-item"><i class="fa fa-user-o"></i>Profile</a>
                    @elseif ($loggedInUser->position == 'VPA' || $loggedInUser->position == 'HRMDO Director')
                        <a href="{{ route('showApprovalProfile') }}" class="dropdown-item"><i class="fa fa-user-o"></i>Profile</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-logout dropdown-item"><i class="fa fa-user-o"></i>Logout</button>
                    </form>
                </div>
            </div>
        </ul>
    </div>
</nav>

<script>
    $(document).ready(function() {
        // Handle click event on the notification badge
        $('.dropdown-toggle.user-action').on('click', function() {
            // Show the dropdown menu
            $(this).siblings('.dropdown-menu').toggle();
        });
    });
</script>

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
