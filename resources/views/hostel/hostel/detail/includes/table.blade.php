<h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Rooms List</h4>
<div class="clearfix hidden-print">
    <span>
        <a class="btn-primary btn-sm bulk-action-btn" attr-action-type="active"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Active</a>
        <a class="btn-warning btn-sm bulk-action-btn" attr-action-type="in-active"><i class="fa fa-remove" aria-hidden="true"></i>&nbsp;In-Active</a>
        <a class="btn-danger btn-sm bulk-action-btn" attr-action-type="delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</a>
        <a type="button" class="btn-primary btn-sm open-AddRooms" data-toggle="modal"
                data-target="#addRooms"
                data-id="{{ $data['hostel']->id }}"
                data-title="{{ $data['hostel']->name }}" >
            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp Add Rooms
        </a>
    </span>
    <span class="pull-right tableTools-container"></span>
</div>
<div class="table-header hidden-print">
    Rooms  Record list on table. Filter list using the search box as you wish.
</div>
<div>
    {!! Form::open(['route' => $base_route.'.room.bulk-rooms', 'id' => 'bulk_action_form']) !!}
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
                    <th>Room No.</th>
                    <th>Room Type</th>
                    <th>Rate/Bed</th>
                    <th>TotalBed</th>
                    <th>Available</th>
                    <th>Occupied</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($data['rooms']) && $data['rooms']->count() > 0)
                        @php($i=1)
                        @foreach($data['rooms'] as $room)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $room->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td><a href="{{ route('hostel.room.view', ['id' => $room->id]) }}">{{ "Room No - ".$room->room_number }}</a> </td>
                                <td>{{ ViewHelper::getRoomTypeTitleById($room->room_type) }}</td>
                                <td>{{ $room->rate_perbed }}</td>
                                <td>{{ $room->beds()->count() }}</td>
                                <td>{{ $room->beds()->where('bed_status','=',1)->count() }}</td>
                                <td>{{ $room->beds()->where('bed_status','=',2)->count() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $room->status == 'active'?"btn-info":"btn-warning" }}" >
                                            {{ $room->status == 'active'?"Active":"In Active" }}
                                            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route($base_route.'.room.active', ['id' => $room->id]) }}" title="Active"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            </li>

                                            <li>
                                                <a href="{{ route($base_route.'.room.in-active', ['id' => $room->id]) }}" title="In-Active"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="green open-EditRooms" data-toggle="modal"
                                           data-target="#editRooms"
                                           data-hostel-id="{{ $data['hostel']->id }}"
                                           data-title="{{ $data['hostel']->name }}"
                                           data-room-id="{{ $room->id }}"
                                           data-room-number="{{ $room->room_number }}"
                                           data-rate="{{ $room->rate_perbed }}">
                                            <i class="fa fa-pencil-square-o bigger-130" aria-hidden="true"></i>
                                        </a>

                                        <a href="{{ route($base_route.'.room.delete', ['id' => $room->id]) }}" class="red bootbox-confirm">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                    </div>
                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a class="green open-EditRooms" data-toggle="modal"
                                                       data-target="#editRooms"
                                                       data-hostel-id="{{ $data['hostel']->id }}"
                                                       data-title="{{ $data['hostel']->name }}"
                                                       data-room-id="{{ $room->id }}"
                                                       data-room-number="{{ $room->room_number }}"
                                                       data-rate="{{ $room->rate_perbed }}">
                                                         <span class="green">
                                                             <i class="fa fa-pencil-square-o bigger-130" aria-hidden="true"></i>
                                                         </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ route($base_route.'.room.delete', ['id' => $room->id]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
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