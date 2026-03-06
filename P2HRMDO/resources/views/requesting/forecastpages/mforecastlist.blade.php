@extends('layouts.app')

@section('body')

<div>
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block text-center">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
    @endif
</div>

<div class="grid-container-print-backtodashboard">
    <div class="grid-container" style="margin-top: 10px; margin-left: 5px;">
        <a class="text-showmrform-backtodashboard" id="back" href="{{route('requestingdashboard.index')}}">Go back to Dashboard</a>
    </div>
</div>

<div class="mainpage-grid-con-main-section shadow">
    <div class="req-mainpage-grid-container" href="">
        <div class="text-align-main-section">
            <h2 style="margin-left: -10px; font-size: 20px;"><b>Manpower Forecast History</b></h2>
        </div>
        
        <div class="req-mainpage-grid-con-edit-performance-eval">
            <a href="{{ route('forecast.create') }}" class="btn btn-create-mrf shadow-none">New Manpower Forecast Form</a>
        </div>
    </div>
    <br>
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search Filter">
        <i class="material-icons search-icon">search</i>
    </div>
<div class="table-responsive">
    <table class="MRListTable table-hover" id="ReqForecastTable">
        <tbody>
            <tr>
                <td class="MRList-header-title" style="width:8%">Forecast No.</td>
                {{-- <td class="MRList-header-title" style="width:12%">No. of Additional Faculty Member</td> --}}
                <td class="MRList-header-title" style="width:12%">College</td>
                <td class="MRList-header-title" style="width:12%">Department</td>
                <td class="MRList-header-title" style="width:12%">Semester</td>
                <td class="MRList-header-title" style="width:12%">Academic Year</td>
                {{-- <td class="MRList-header-title" style="width:10%">Date Created</td> --}}
                <td class="MRList-header-title" style="width:8%">Status</td>
                <td class="MRList-header-title" style="width:1%">Action</td>
            </tr>

            @php
                $perPage = 100;
                $currentPage = request()->input('page', 1);
                $startIndex = ($currentPage - 1) * $perPage;
                $paginatedForms = $forecastSection1->slice($startIndex, $perPage);
                $totalForms = $forecastSection1->count();
                $totalPages = ceil($totalForms / $perPage);
            @endphp
            
            @if($totalForms > 0)
            @foreach($forecastSection1  as $fS1)
                <tr>
                    <td class="align-middle">{{ $fS1->forecast_num_id }}</a></td>
                    {{-- <td class="align-middle">
                        @foreach($forecastSection4 as $fS4)
                            @if($fS4->forecast_num_id == $fS1->forecast_num_id)
                                {{ $fS4->numaddfacmember }}
                            @endif
                        @endforeach
                    </td> --}}
                    <td class="align-middle">{{ $fS1->college }}</td>
                    <td class="align-middle">{{ $fS1->department }}</td>
                    <td class="align-middle">{{ $fS1->semester }}</td>
                    <td class="align-middle">{{ $fS1->ay }}</td>
                    {{-- <td class="align-middle">{{ $fS1->created_at->format('Y-m-d') }}</td> --}}
                    <td class="align-middle @if ($fS1->approval_status == 'Pending') status-blue-list @elseif ($fS1->approval_status == 'Waiting for Approval') status-orange-list @elseif ($fS1->approval_status == 'Approved') status-violet-list @elseif ($fS1->approval_status == 'Disapproved') status-red-list @elseif ($fS1->approval_status == 'Completed') status-green-list @elseif ($fS1->approval_status == 'Processing') status-yellow-list @endif">
                        {{ $fS1->approval_status }}</td>
                    <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <div>
                                <a href="{{ route('forecast.show',$fS1->forecast_num_id) }}" class="btn btn-view shadow-none" data-toggle="tooltip"><i class="material-icons" style="margin-top: -20%; margin-left: -30%;">visibility</i></a>
                            </div>
                            <a href="{{ route('forecast.edit', $fS1->forecast_num_id)}}" class="btn btn-edit shadow-none{{ $fS1->approval_status != 'Pending' ? ' hide' : '' }}" data-toggle="tooltip"><i class="material-icons" style="margin-top: -15%; margin-left: 10%;">&#xE254;</i></a>
                            <form id="deleteForm{{ $fS1->forecast_num_id }}" action="{{ route('forecast.destroy', $fS1->forecast_num_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-deleteforecast shadow-none{{ $fS1->approval_status != 'Pending' ? ' hide' : '' }}"><i class="material-icons" style="margin-top: -20%; margin-left: -35%;">&#xE872;</i></button>
                                <div class="modal fade" id="confirm-delete{{ $fS1->forecast_num_id }}" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modal-label"><b>Delete Manpower Forecast Form</b></h4>
                                            </div>
                                            <div class="modal-body">
                                                <p style="font-size: 20px; margin-top: 10px;">Are you sure you want to delete this form?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal" id="formcancel-btn{{ $fS1->forecast_num_id }}">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            @if ($fS1->approval_status == 'Pending')
                                <form id="sendForApprovalForm{{ $fS1->forecast_num_id }}" action="{{ route('forecasting.send-for-approval', $fS1) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sendforapproval shadow-none" id="send-for-approval-button" data-toggle="modal" data-target="#confirm-send-approval{{ $fS1->forecast_num_id }}" style="border-radius: 0px 0px 0px 0px;">Send for Approval</button>
                                    <div class="modal fade" id="confirm-send-approval{{ $fS1->forecast_num_id }}" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="modal-label"><b>Send Forecast Form for Approval</b></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="font-size: 20px; margin-top: 10px;">Are you sure you want to send this form for approval?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel-send-approval{{ $fS1->forecast_num_id }}">Cancel</button>
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
                                    $('.btn-deleteforecast').click(function(e) {
                                        e.preventDefault();
                                        var formId = $(this).closest('form').attr('id');
                                        $('#confirm-delete' + formId.substring(10)).modal('show');
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
    </table> </div><br>

    <div class="custom-pagination">
        <ul class="pagination-list">
            <li class="pagination-item{{ $forecastSection1->currentPage() == 1 ? ' disabled' : '' }}">
                <a href="{{ $forecastSection1->previousPageUrl() }}" class="pagination-link{{ $forecastSection1->currentPage() == 1 ? ' disabled-link' : '' }}"{{ $forecastSection1->currentPage() == 1 ? ' aria-disabled="true"' : '' }}>&laquo; Previous</a>
            </li>
            @for ($i = 1; $i <= $forecastSection1->lastPage(); $i++)
                <li class="pagination-item{{ $i == $forecastSection1->currentPage() ? ' active' : '' }}">
                    <a href="{{ $forecastSection1->url($i) }}" class="pagination-link{{ $i == $forecastSection1->currentPage() ? ' disabled-link' : '' }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="pagination-item{{ $forecastSection1->currentPage() == $forecastSection1->lastPage() ? ' disabled' : '' }}">
                <a href="{{ $forecastSection1->nextPageUrl() }}" class="pagination-link{{ $forecastSection1->currentPage() == $forecastSection1->lastPage() ? ' disabled-link' : '' }}"{{ $forecastSection1->currentPage() == $forecastSection1->lastPage() ? ' aria-disabled="true"' : '' }}>Next &raquo;</a>
            </li>
        </ul>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const dataTable = document.getElementById('ReqForecastTable');
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