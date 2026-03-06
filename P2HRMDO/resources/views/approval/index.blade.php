@extends('layouts.app')

@section('body')

    <div class="grid-con-first shadow">
        <div class="grid-container-column">
            <div class="grid-con-mf-data" href="">
                <div class="img-profile" >
                    <img src="{{ asset('storage/images/' . $loggedInUser->image) }}" class="rounded-circle" width="65px" height="65px" href="req_evalpage copy.html">
                </div>  
                <div class="app-main-text-profile">
                    <p class="app-mainpage-text-jane-doe"><b>{{ $loggedInUser->name }}</b></p>
                    <p class="app-mainpage-text-department">{{ $loggedInUser->department }}</p>
                </div>
            </div>
            <div class="grid-con-mf-data" href="">
                <a href="{{ route('approval.markov') }}">
                    <button type="button" class="btn btn-mf-data shadow-none">Manpower Forecast System</button>
                </a>
            </div>
        </div>
    </div>

    <div class="grid-con-second shadow">
        <br>
        <div class="grid-con-btn-searchfilter">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input onclick="showTable('AppMRTable')" type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label class="btn btn-outline-primary custom-btn" style="border-radius: 4px 0 0 4px;" for="btnradio1">Manpower Requisition History</label>
            
                <input onclick="showTable('AppForecastTable')"type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                <label class="btn btn-outline-primary custom-btn" style="border-radius: 0 4px 4px 0;" for="btnradio2">Manpower Forecast History</label>
            </div>

            <div class="approval-search-container">
                <input type="text" id="searchInput" placeholder="Search Filter">
                <i class="material-icons approval-search-icon">search</i>
            </div>
        </div>
     <div class="table-responsive">
        <table class="table-approval table-hover" id="AppMRTable" style="margin-bottom: 20px;">
            <tbody>
                <tr>
                    <td class="table-approval-header-title" style="width:8%">MR Form No.</td>
                    <td class="table-approval-header-title" style="width:12%">College</td>
                    <td class="table-approval-header-title" style="width:12%">Department</td>
                    <td class="MRList-header-title" style="width:12%">Semester</td>
                    <td class="MRList-header-title" style="width:12%">Academic Year</td>
                    <td class="table-approval-header-title" style="width:10%">Date Received</td>
                    <td class="table-approval-header-title" style="width:10%">Date Approved</td>
                    <td class="table-approval-header-title" style="width:10%">Status</td>
                    <td class="table-approval-header-title" style="width:3%">Action</td>
                </tr>

                {{-- @php
                    $perPage = 100;
                    $currentPage = request()->input('page', 1);
                    $startIndex = ($currentPage - 1) * $perPage;
                    $paginatedForms = $pendingForms->slice($startIndex, $perPage);
                    $totalForms = $pendingForms->count();
                    $totalPages = ceil($totalForms / $perPage);
                @endphp --}}

                @if($pendingForms->count() > 0)
                    @foreach ($pendingForms  as $form)
                        <tr>
                            <td>{{ $form->mrNum }}</td>
                            <td>{{ $form->college }}</td>
                            <td>{{ $form->department }}</td>
                            <td>{{ $form->semester }}</td>
						    <td>{{ $form->ay }}</td>
                            <td>{{ $form->daterequested}}</td>
                            <td>{{ $form->dateapproved}}</td>
                            <td class="align-middle @if ($form->approval_status == 'To be sent for Approval') status-blue @elseif ($form->approval_status == 'Waiting for Approval') status-orange @elseif ($form->approval_status == 'Approved') status-violet @elseif ($form->approval_status == 'Disapproved') status-red @elseif ($form->approval_status == 'Completed') status-green @elseif ($form->approval_status == 'Processing') status-yellow @endif">
                                {{ $form->approval_status }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('approvaldashboard.show', $form) }}" class="btn btn-outline-secondary shadow-none">View</a>
                                    <a href="{{ route('approvaldashboard.show2', $form) }}" class="btn btn-outline-primary shadow-none{{ $form->approval_status != 'Waiting for Approval' ? ' hide' : '' }}">Approve/Disapprove</a>
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
        </table>
{{-- 
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
        </div> --}}

        
        <table class="table-approval table-hover" id="AppForecastTable" style="display: none; margin-bottom: 20px;">
            <tbody>
                <tr>
                    <td class="MRList-header-title" style="width:8%">Forecast No.</td>
                    <td class="MRList-header-title" style="width:12%">College</td>
					<td class="MRList-header-title" style="width:12%">Department</td>
                    <td class="MRList-header-title" style="width:12%">Semester</td>
                    <td class="MRList-header-title" style="width:12%">Academic Year</td>
                    <td class="MRList-header-title" style="width:10%">Date Received</td>
                    <td class="MRList-header-title" style="width:8%">Status</td>
                    <td class="MRList-header-title" style="width:1%">Action</td>
                </tr>

                {{-- @php
                    $perPage = 100;
                    $currentPage = request()->input('page', 1);
                    $startIndex = ($currentPage - 1) * $perPage;
                    $paginatedForms = $forecastSection1->slice($startIndex, $perPage);
                    $totalForms = $forecastSection1->count();
                    $totalPages = ceil($totalForms / $perPage);
                @endphp --}}
                
                @if($forecastSection1->count() > 0)
                @foreach($forecastSection1 as $fS1)
                    <tr>
                        <td class="align-middle">{{ $fS1->forecast_num_id }}</a></td>
                        <td class="align-middle">{{ $fS1->college }}</td>
						<td class="align-middle">{{ $fS1->department }}</td>
                        <td class="align-middle">{{ $fS1->semester }}</td>
                        <td class="align-middle">{{ $fS1->ay }}</td>
                        <td class="align-middle">{{ $fS1->created_at->format('Y-m-d') }}</td>
                        <td class="align-middle @if ($fS1->approval_status == 'To be sent for Approval') status-blue @elseif ($fS1->approval_status == 'Waiting for Approval') status-orange @elseif ($fS1->approval_status == 'Approved') status-violet @elseif ($fS1->approval_status == 'Disapproved') status-red @elseif ($fS1->approval_status == 'Completed') status-green @elseif ($fS1->approval_status == 'Processing') status-yellow @endif">
                            {{ $fS1->approval_status }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group">
                                <a href="{{ route('approvaldashboard.show3', $fS1) }}" class="btn btn-outline-secondary shadow-none">View</a>
                                <a href="{{ route('approvaldashboard.show4', $fS1) }}" class="btn btn-outline-primary shadow-none{{ $fS1->approval_status != 'Waiting for Approval' ? ' hide' : '' }}">Approve/Disapprove</a>
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
        </table>
        </div>
        {{-- <div class="custom-pagination">
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
        </div> --}}
        
        <script>
        const searchInput = document.getElementById('searchInput');
        const mrFormTable = document.getElementById('AppMRTable');
        const forecastFormTable = document.getElementById('AppForecastTable');
        const mrFormRows = mrFormTable.getElementsByTagName('tr');
        const forecastFormRows = forecastFormTable.getElementsByTagName('tr');
        
        searchInput.addEventListener('input', function() {
            const searchText = searchInput.value.toLowerCase();
        
            for (let i = 1; i < mrFormRows.length; i++) {
            const row = mrFormRows[i];
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
        
            for (let i = 1; i < forecastFormRows.length; i++) {
            const row = forecastFormRows[i];
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
        
        function showTable(tableName) {
            if (tableName === 'AppMRTable') {
            mrFormTable.style.display = 'table';
            forecastFormTable.style.display = 'none';
            } else {
            mrFormTable.style.display = 'none';
            forecastFormTable.style.display = 'table';
            }
        }
        </script>
        <br>
    </div>

@endsection