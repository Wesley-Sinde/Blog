{{--<h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>--}}
<div class="clearfix">
    <span class="pull-right tableTools-container"></span>
</div>
{{--<div class="table-header">
    {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
</div>--}}
<!-- div.table-responsive -->
<div class="table-responsive">
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th width="5%">S.N.</th>
            <th width="40%">Question</th>
            <th>Date</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if (isset($data['assignment']) && $data['assignment']->count() > 0)
            @php($i=1)
            @foreach($data['assignment'] as $assignment)
                <tr>
                    <td>{{ $i }}</td>
                    <td>
                            {{ $assignment->title }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($assignment->publish_date)->format('M d, Y')}} TO
                        {{ \Carbon\Carbon::parse($assignment->end_date)->format('M d, Y')}}<br>


                        <div class="btn-group">
                            @php($now = date('Y-m-d'))
                            @if($assignment->end_date)
                                @if($assignment->end_date <= $now)
                                    <button data-toggle="dropdown" class="btn btn-danger btn-minier dropdown-toggle" >
                                        Time Over
                                    </button>
                                @else
                                    <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle" >
                                        Available
                                    </button>
                                @endif
                            @endif

                        </div>
                    </td>
                    <td class="hidden-480 ">
                        <div class="btn-group">
                            @php($approveStatus = $assignment->answers()->where('students_id',$data['student']->id)->first())
                            @if(isset($approveStatus))
                                @if( $approveStatus->approve_status == 1)
                                    <button class="btn btn-success btn-minier dropdown-toggle" >
                                        Approve
                                    </button>
                                @elseif( $approveStatus->approve_status == 2)
                                    <button class="btn btn-danger btn-minier dropdown-toggle" >
                                        Rejected
                                    </button>
                                @else
                                    <button class="btn btn-info btn-minier dropdown-toggle" >
                                        Pending
                                    </button>
                                @endif
                            @else
                                <button class="btn btn-warning btn-minier dropdown-toggle" >
                                    Not Submited
                                </button>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="hidden-sm hidden-xs action-buttons">
                            @if(isset($approveStatus))
                                <a href="{{ route('user-guardian.students.assignment.answer.view', ['id'=>Crypt::encryptString($data['student_id']),'assignment' => $assignment->id, 'answer'=> $approveStatus->id]) }}" class="btn btn-primary btn-minier">
                                    <i class="ace-icon fa fa-eye bigger-130"></i> View
                                </a>
                            @endif


                        </div>
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
</div>
</div>