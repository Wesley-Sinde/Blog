<h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
<div class="clearfix hidden-print">
    <span>
        {{--<a class="btn-primary btn-sm bulk-action-btn" attr-action-type="active"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Active</a>
        <a class="btn-warning btn-sm bulk-action-btn" attr-action-type="in-active"><i class="fa fa-remove" aria-hidden="true"></i>&nbsp;In-Active</a>--}}
        <a class="btn-danger btn-sm bulk-action-btn" attr-action-type="delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</a>
        <a type="button" class="btn-primary btn-sm open-AddRooms" data-toggle="modal"
                data-target="#addRooms"
                data-hostel-id="{{ $data['rooms']->hostels_id }}"
                data-room-id="{{ $data['rooms']->id }}"
                data-room-number="{{ $data['rooms']->room_number }}" >
            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp Add Beds
        </a>
    </span>
    <span class="pull-right tableTools-container"></span>
</div>
<div class="table-header hidden-print">
    {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
</div>
<div>
    {!! Form::open(['route' => 'hostel.bed.bulk-beds', 'id' => 'bulk_action_form']) !!}
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr >
                    <th class="center" width="5%" >
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>Room - Bed No.</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($data['beds']) && $data['beds']->count() > 0)
                        @php($i=1)
                        @foreach($data['beds'] as $bed)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $bed->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ "Bed Number - ".$bed->bed_number }}</td>
                                <td class="hidden-480 ">
                                    <div class="label {{ ViewHelper::getBedStatusClassById($bed->bed_status) }}">
                                        {{ ViewHelper::getBedStatusById($bed->bed_status) }}
                                    </div>
                                </td>
                                <td class="hidden-480 ">
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a href="{{ route('hostel.bed.delete', ['id' => $bed->id]) }}" class="red bootbox-confirm">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                        <div class="btn-group hidden-print ">
                                            <button data-toggle="dropdown" class="btn btn-minier btn-primary dropdown-toggle" >
                                                <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                            </button>
                                            <ul class="dropdown-menu " >
                                                @if (isset($data['beds_status']) && $data['beds_status']->count() > 0)
                                                    @foreach($data['beds_status'] as $beds_status)
                                                        <li>
                                                            <a href="{{ route('hostel.bed.bed-status', ['id' => $bed->id,'status' => $beds_status->id ]) }}">
                                                                {{ $beds_status->title }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li>
                                                        No Status
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a href="{{ route('hostel.bed.delete', ['id' => $bed->id]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
                                                        <span class="red ">
                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php($i++)
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    {!! Form::close() !!}
</div>