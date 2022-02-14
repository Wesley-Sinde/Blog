<div class="form-horizontal">
    <div class="row">
        <div class="col-xs-12">
            <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
            <div class="clearfix">
            <span class="easy-link-menu">
                <a class="btn-primary btn-sm bulk-action-btn" attr-action-type="complete"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Complete</a>
                <a class="btn-warning btn-sm bulk-action-btn" attr-action-type="pending"><i class="fa fa-remove" aria-hidden="true"></i>&nbsp;Pending</a>
                <a class="btn-danger btn-sm bulk-action-btn" attr-action-type="delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</a>
            </span>

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
                        <th>SEM/SEC</th>
                        <th>Subject/Course</th>
                        <th>Topic</th>
                        {{--<th>Created Date</th>--}}
                        {{--<th>ID</th>--}}
                        <th>Start Time</th>
                        {{--<th>TimeZone</th>--}}
                        <th>MIN</th>
                        <th>Schedule By</th>
                        <th>Status</th>
                        <th>LINK</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($data['meetings']) && $data['meetings']->count() > 0)
                        @php($i=1)
                        @foreach($data['meetings'] as $meeting)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ encrypt($meeting->id) }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ $i }}</td>
                                <td>{{ ViewHelper::getSemesterById($meeting->semesters_id) }}</td>
                                <td>{{ ViewHelper::getSubjectById($meeting->subjects_id) }}</td>
                                <td> {{$meeting->topic}} </td>
                                {{--<td> {{\Carbon\Carbon::parse($meeting->date)->format('Y-M-d')}} </td>--}}
                                {{--<td> {{$meeting->meeting_id}} </td>--}}
                                <td>
                                    {{ \Carbon\Carbon::parse($meeting->start_time)->format('D, d-M-Y | H:i:s A')  }}
                                </td>
                                {{--<td> {{$meeting->timezone}} </td>--}}
                                <td> {{$meeting->duration}} </td>
                                <td> {{$meeting->created_by_name}} </td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $meeting->status == 'active'?"btn-info":"btn-warning" }}" >
                                            {{--{{ $meeting->status == 'active'?"Complete":"Pending" }}--}}
                                            @if( $meeting->status == 'active')
                                                Complete
                                            @elseif( $meeting->status == 'in-active')
                                                Pending
                                            @else
                                                Start
                                            @endif
                                            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route($base_route.'.pending', ['id' => encrypt($meeting->id)]) }}" title="Pending"><i class="fa fa-remove" aria-hidden="true"></i> Pending</a>
                                            </li>

                                            <li>
                                                <a href="{{ route($base_route.'.start', ['id' => encrypt($meeting->id)]) }}" title="Start"><i class="fa fa-line-chart" aria-hidden="true"></i> Start</a>
                                            </li>

                                            <li>
                                                <a href="{{ route($base_route.'.complete', ['id' => encrypt($meeting->id)]) }}" title="Complete"><i class="fa fa-check" aria-hidden="true"></i> Complete</a>
                                            </li>


                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    {{--{{(\Carbon\Carbon::parse(\Carbon\Carbon::now())->addMinutes($meeting->duration))}}--}}
                                    @if(((\Carbon\Carbon::parse($meeting->start_time))->addMinutes($meeting->duration)) > \Carbon\Carbon::now())

                                        @if($meeting->status != 'active')
                                            <div class="action-buttons">
                                                <a href="{{$meeting->start_url}}" target="_blank" title="Start" class="btn-success btn-sm">
                                                    <i class="fa fa-video-camera" aria-hidden="true"></i> Start
                                                </a>
                                                <a href="{{ route($base_route.'.send-alert', ['event' => 'schedule', 'id' => encrypt($meeting->id)]) }}" target="_blank" title="Start" class="btn-warning btn-sm">
                                                    <i class="fa fa-send" aria-hidden="true"></i> Alert/Invite
                                                </a>
                                            </div>
                                        @endif
                                    @else
                                        <span class="red">
                                            Expire:{{((\Carbon\Carbon::parse($meeting->start_time))->addMinutes($meeting->duration))->diffForHumans()}}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if( $meeting->status == 'in-active')
                                    <div class="action-buttons">
                                        <a href="{{ route($base_route.'.delete', ['id' => encrypt($meeting->id)]) }}" class="red bootbox-confirm">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @php($i++)
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

