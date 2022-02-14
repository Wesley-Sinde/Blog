<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead class="text-center">
                <tr>
                    <th>S.N.</th>
                    <th>Subject/Course</th>
                    <th>Topic</th>
                    <th>Start Time</th>
                    <th>Duration(M)</th>
                    <th>TimeZone</th>
                    <th>ScheduleBy</th>
                    <th>Status</th>
                    <th>Join</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['meetings']) && $data['meetings']->count() > 0)
                    @php($i=1)
                    @foreach($data['meetings'] as $meeting)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ ViewHelper::getSubjectById($meeting->subjects_id) }}</td>
                            <td> {{$meeting->topic}} </td>
                            <td>{{ \Carbon\Carbon::parse($meeting->start_time)->format('D, d-M-Y | H:i:s A')  }} </td>
                            <td> {{$meeting->duration}} </td>
                            <td> {{$meeting->timezone}} </td>
                            <td> {{$meeting->created_by_name}} </td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $meeting->status == 'active'?"btn-info":"btn-warning" }}" >
                                        @if( $meeting->status == 'active')
                                            Complete
                                        @elseif( $meeting->status == 'in-active')
                                            Pending
                                        @else
                                            Start
                                        @endif
                                    </button>
                                </div>
                            </td>
                            <td>
                                @php($endTime = \Carbon\Carbon::parse($meeting->start_time)->add('minute',$meeting->duration))
                                @if(\Carbon\Carbon::parse($endTime) > \Carbon\Carbon::now() && $meeting->status != 'active')
                                    <div class="action-buttons">
                                        <a href="{{$meeting->join_url}}" target="_blank" class="btn-primary btn-sm">
                                            <i class="fa fa-video-camera" aria-hidden="true"></i> Join
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
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