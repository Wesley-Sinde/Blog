<div class="form-horizontal">
    <div class="row">
        <div class="col-xs-12">
            <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i> Zoom Schedule &nbsp;{{ $panel }} List</h4>
            <div class="clearfix">
            {{--<span class="easy-link-menu">
                <a class="btn-primary btn-sm bulk-action-btn" attr-action-type="active"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Active</a>
                <a class="btn-warning btn-sm bulk-action-btn" attr-action-type="in-active"><i class="fa fa-remove" aria-hidden="true"></i>&nbsp;In-Active</a>
                <a class="btn-danger btn-sm bulk-action-btn" attr-action-type="delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</a>
            </span>--}}

                <span class="pull-right tableTools-container"></span>
            </div>
            <div class="table-header">
                {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
            </div>
            <!-- div.table-responsive -->
                <div class="table-responsive">
                    {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th class="center">
                                        <label class="pos-rel">
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </th>
                                    <th>S.N.</th>
                                    <th>Created Date</th>
                                    <th>Topic</th>
                                    <th>ID</th>
                                    <th>Start Time</th>
                                    <th>TimeZone</th>
                                    <th>Duration(M)</th>
                                    <th>Start / Join</th>
                                    {{--<th>Action</th>--}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($data['meetings']) && $data['meetings']->count() > 0)
                                    @php($i=1)
                                    @foreach($data['meetings'] as $meeting)
                                        @php($endTime = \Carbon\Carbon::parse($meeting->start_time)->add('minute',$meeting->duration))
                                        @if(\Carbon\Carbon::parse($endTime) > \Carbon\Carbon::now())
                                        <tr>
                                            <td class="center first-child">
                                                <label>
                                                    <input type="checkbox" name="chkIds[]" value="{{ encrypt($meeting->id) }}" class="ace" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td>{{ $i }}</td>
                                            <td> {{\Carbon\Carbon::parse($meeting->date)->format('Y-M-d')}} </td>
                                            <td> {{$meeting->topic}} </td>
                                            <td> {{$meeting->id}} </td>
                                            <td> {{$meeting->start_time}} </td>
                                            <td> {{$meeting->timezone}} </td>
                                            <td> {{$meeting->duration}} </td>
                                            <td>
                                                @if(\Carbon\Carbon::parse($endTime) > \Carbon\Carbon::now())
                                                    <div class="action-buttons">
                                                        <a href="https://zoom.us/s/{{$meeting->id}}" target="_blank" class="btn-success btn-sm">
                                                            <i class="fa fa-video-camera" aria-hidden="true"></i> Start
                                                        </a>
                                                        <a href="https://zoom.us/j/{{$meeting->id}}" target="_blank" class="btn-primary btn-sm">
                                                            <i class="fa fa-video-camera" aria-hidden="true"></i> Join
                                                        </a>
                                                    </div>
                                                @elseif(\Carbon\Carbon::parse($meeting->start_time) < \Carbon\Carbon::now())
                                                    <span class="red">
                                                        Expire:{{\Carbon\Carbon::parse($meeting->start_time)->diffForHumans()}}
                                                    </span>
                                                @else
                                                    <span class="green">
                                                        Start:{{\Carbon\Carbon::parse($meeting->start_time)->diffForHumans()}}
                                                    </span>

                                                @endif
                                            </td>
                                            {{--<td>
                                                <div class="hidden-sm hidden-xs action-buttons">
                                                    <a class="green" href="{{ route($base_route.'.edit', ['id' => encrypt($meeting->id)]) }}">
                                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                    </a>

                                                    <a href="{{ route($base_route.'.delete', ['id' => encrypt($meeting->id)]) }}" class="red bootbox-confirm">
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
                                                                <a href="{{ route($base_route.'.edit', ['id' => encrypt($meeting->id)]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                    <span class="green">
                                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="{{ route($base_route.'.delete', ['id' => encrypt($meeting->id)]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
                                                                    <span class="red ">
                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>--}}
                                        </tr>
                                        @endif
                                        @php($i++)
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    {!! Form::close() !!}
                </div>
        </div>
    </div>
</div>

