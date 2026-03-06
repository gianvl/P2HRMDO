@extends ('layouts.app')

@section('body')

    <div> 
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block text-center">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
        @endif 
    </div>

    @if($loggedInUser->position === 'Dean')
        <!--PROFILE SECTION -->
        <div class="req-mainpage-grid-container-dean">
            <div class="grid-con-profile shadow" href="">
                <div class="req-mainpage-img-profile" >
                    <img src="{{ asset('storage/images/' . $loggedInUser->image) }}" class="rounded-circle" width="65px" height="65px" href="req_evalpage copy.html">
                </div>  
                <div class="req-mainpage-text-align-profile">
                    <p class="req-mainpage-text-jane-doe"><b>{{ $loggedInUser->name }}</b></p>
                    <p class="req-mainpage-text-department">{{ $loggedInUser->department }}</p>
                </div>

                <div class="main-img-college-logo"> 
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
            </div>
        </div>
    @else
        <!--PROFILE SECTION -->
        <div class="req-mainpage-grid-container">
            <div class="grid-con-profile shadow" href="">
                <div class="req-mainpage-img-profile" >
                    <img src="{{ asset('storage/images/' . $loggedInUser->image) }}" class="rounded-circle" width="65px" height="65px" href="req_evalpage copy.html">
                </div>  
                <div class="req-mainpage-text-align-profile">
                    <p class="req-mainpage-text-jane-doe"><b>{{ $loggedInUser->name }}</b></p>
                    <p class="req-mainpage-text-department">{{ $loggedInUser->position }} of {{ $loggedInUser->department }}</p>
                </div>
            </div>

            <div class="grid-con-evaldatareport-mrform shadow">
                <div class="text-align-evaldatareport-link">
                    <p><a class="evaldatareport" href="{{ route('evaldatareport.index') }}">Evaluation Data Reports</a></p>
                </div>
                <div class="text-align-mrform-link">
                    <p><a class="mrform" href="{{ route('editperformanceEvaluation.index') }}">Faculty Performance Evaluation</a></p>
                </div>

                {{-- <div class="main-img-department-logo">
                    @if ($loggedInUser->department == 'Information Technology and Information System Department')
                        <img src="{{ url('images/IT.png') }}" class="rounded-circle" width="65px" height="65px">
                    @elseif ($loggedInUser->department == 'Finance and Economics Department')
                        <img src="{{ url('images/FinanceEconomics.png') }}" class="rounded-circle" width="65px" height="65px">
                    @else
                        <img src="{{ url('/images/defaultLogo.png') }}" class="rounded-circle" width="65px" height="65px">
                    @endif
                </div> --}}
                
                <div class="main-img-college-logo"> 
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
            </div>
        </div>
    @endif

    <div class="req-mainpage-grid-container">
        <div class="grid-con-mf-form" href="">
            <a class="btn btn-mf-form shadow-none" href="{{ route('forecast.index') }}">Manpower Forecast History</a>
        </div>
        <div class="grid-con-mf-system" href="">
            <a href="{{ route('requesting.arima') }}">
                <button type="button" class="btn btn-mf-system shadow-none">Manpower Forecast System</button>
            </a>
        </div>
    </div>
    
    <div class="mainpage-grid-con-main-section shadow">
        <div class="req-mainpage-grid-container" href="">
            <div class="text-align-main-section">
                <h2 style="margin-left: -10px; font-size: 20px;"><b>Manpower Requisition History</b></h2>
            </div>
            
            <div class="req-mainpage-grid-con-edit-performance-eval">
                <a href="{{ route('requestingdashboard.create') }}" class="btn btn-create-mrf shadow-none">New Manpower Requisition Form</a>
            </div>
        </div>
        <br>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search Filter">
            <i class="material-icons search-icon">search</i>
        </div>

        <table class="MRListTable table-hover" id="ReqMRTable">
            <tbody>
                <tr>
                    <td class="MRList-header-title" style="width:8%">MR Form No.</td>
                    <td class="MRList-header-title" style="width:12%">College</td>
                    <td class="MRList-header-title" style="width:12%">Department</td>
                    <td class="MRList-header-title" style="width:12%">Position</td>
                    <td class="MRList-header-title" style="width:12%">No. of Employees Required</td>
                    <td class="MRList-header-title" style="width:10%">Date Requested</td>
                    <td class="MRList-header-title" style="width:8%">Status</td>
                    <td class="MRList-header-title" style="width:1%">Action</td>
                </tr>

                @php
                    $perPage = 100;
                    $currentPage = request()->input('page', 1);
                    $startIndex = ($currentPage - 1) * $perPage;
                    $paginatedForms = $mrform->slice($startIndex, $perPage);
                    $totalForms = $mrform->count();
                    $totalPages = ceil($totalForms / $perPage);
                @endphp

                @if($mrform->count() > 0)
                    @foreach($paginatedForms as $mrf)  
                        <tr>
                            <td class="align-middle">{{ $mrf->mrNum }}</td>
                            <td class="align-middle">{{ $mrf->college }}</td>
                            <td class="align-middle">{{ $mrf->department }}</td>
                            <td class="align-middle">{{ $mrf->position }}</td>
                            <td class="align-middle">{{ $mrf->num_emp_required }}</td>
                            <td class="align-middle">{{ $mrf->created_at->format('Y-m-d') }}</td>
                            <td class="align-middle @if ($mrf->approval_status == 'Pending') status-blue-list @elseif ($mrf->approval_status == 'Waiting for Approval') status-orange-list @elseif ($mrf->approval_status == 'Approved') status-violet-list @elseif ($mrf->approval_status == 'Disapproved') status-red-list @elseif ($mrf->approval_status == 'Completed') status-green-list @elseif ($mrf->approval_status == 'Processing') status-yellow-list @endif">
                                {{ $mrf->approval_status }}</td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <div>
                                        <a href="{{ route('requestingdashboard.show',$mrf->mrNum) }}" class="btn btn-view shadow-none" data-toggle="tooltip"><i class="material-icons" style="margin-top: -20%; margin-left: -30%;">visibility</i></a>
                                    </div>
                                        <a href="{{ route('requestingdashboard.edit', $mrf->mrNum)}}"  class="btn btn-edit shadow-none{{ $mrf->approval_status != 'Pending' ? ' hide' : '' }}" data-toggle="tooltip"><i class="material-icons" style="margin-top: -15%; margin-left: 10%;">&#xE254;</i></a>
                                    <form id="deleteForm{{ $mrf->mrNum }}" action="{{ route('requestingdashboard.destroy', $mrf->mrNum) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-deletemrf shadow-none{{ $mrf->approval_status != 'Pending' ? ' hide' : '' }}" data-toggle="modal" data-target="#confirm-delete{{ $mrf->mrNum }}"><i class="material-icons" style="margin-top: -15%; margin-left: -30%;">&#xE872;</i></button>
                                        <div class="modal fade" id="confirm-delete{{ $mrf->mrNum }}" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="modal-label"><b>Delete Manpower Requisition Form</b></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="font-size: 20px; margin-top: 10px;">Are you sure you want to delete this form?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="formcancel-btn{{ $mrf->mrNum }}">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    @if ($mrf->approval_status == 'Pending')
                                        <form id="sendForApprovalForm{{ $mrf->mrNum }}" action="{{ route('manpower.send-for-approval', $mrf->mrNum) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sendforapproval shadow-none" data-toggle="modal" data-target="#confirm-send-approval{{ $mrf->mrNum }}" style="border-radius: 0px 0px 0px 0px;">Send for Approval</button>
                                            <div class="modal fade" id="confirm-send-approval{{ $mrf->mrNum }}" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="modal-label"><b>Send Manpower Requisition Form for Approval</b></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p style="font-size: 20px; margin-top: 10px;">Are you sure you want to send this form for approval?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel-send-approval{{ $mrf->mrNum }}">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Send for Approval</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <button disabled class="btn btn-sendforapproval hide">Sent for Approval</button>
                                    @endif

                                    <script>
                                        $(document).ready(function() {
                                            $('.btn-deletemrf').click(function(e) {
                                                e.preventDefault();
                                                var formId = $(this).closest('form').attr('id');
                                                $('#confirm-delete' + formId.substring(10)).modal({backdrop: 'static'});
                                            });
                                    
                                            $('[id^="formcancel-btn"]').click(function() {
                                                var modalId = $(this).attr('id');
                                                $('#confirm-delete' + modalId.substring(14)).modal('hide');
                                            });
                                    
                                            $('.btn-sendforapproval').click(function(e) {
                                                e.preventDefault();
                                                var formId = $(this).closest('form').attr('id');
                                                $('#confirm-send-approval' + formId.substring(19)).modal({backdrop: 'static'});
                                            });
                                    
                                            $('[id^="cancel-send-approval"]').click(function() {
                                                var modalId = $(this).attr('id');
                                                $('#confirm-send-approval' + modalId.substring(18)).modal('hide');
                                            });
                                        });
                                    </script>
                                    
                                </div>   
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">No data found.</td>
                    </tr>
                @endif
            </tbody>
        </table> <br>

        <div class="custom-pagination">
            <ul class="pagination-list">
                <li class="pagination-item{{ $currentPage == 1 ? ' disabled' : '' }}">
                    <a href="{{ $currentPage == 1 ? '#' : '?page=' . ($currentPage - 1) }}" class="pagination-link{{ $currentPage == 1 ? ' disabled-link' : '' }}"{{ $currentPage == 1 ? ' aria-disabled="true"' : '' }}>&laquo; Previous</a>
                </li>
                @for ($i = 1; $i <= $totalPages; $i++)
                    <li class="pagination-item{{ $i == $currentPage ? ' active' : '' }}">
                        <a href="{{ '?page=' . $i }}" class="pagination-link{{ $i == $currentPage ? ' disabled-link' : '' }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="pagination-item{{ $currentPage == $totalPages ? ' disabled' : '' }}">
                    <a href="{{ $currentPage == $totalPages ? '#' : '?page=' . ($currentPage + 1) }}" class="pagination-link{{ $currentPage == $totalPages ? ' disabled-link' : '' }}"{{ $currentPage == $totalPages ? ' aria-disabled="true"' : '' }}>Next &raquo;</a>
                </li>
            </ul>
        </div>

        <script>
            const searchInput = document.getElementById('searchInput');
            const dataTable = document.getElementById('ReqMRTable');
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
        <br>
    </div>
    
@endsection
