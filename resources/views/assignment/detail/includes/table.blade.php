<h4 class="header large lighter blue"><i class="fa fa-comment" aria-hidden="true"></i>&nbsp;Submited Answers</h4>
<div class="clearfix hidden-print">
 <span class="easy-link-menu">
        <a class="btn-primary btn-sm bulk-action-btn" attr-action-type="Approve"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Approve</a>
        <a class="btn-warning btn-sm bulk-action-btn" attr-action-type="Reject"><i class="fa fa-remove" aria-hidden="true"></i>&nbsp;Reject</a>
        <a class="btn-danger btn-sm bulk-action-btn" attr-action-type="Delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</a>
    </span>

    <span class="pull-right tableTools-container"></span>
</div>
<div class="table-header hidden-print">
    Student Submitted Answers Record list on table. Filter list using the search box as you wish.
</div>
<div>
    {!! Form::open(['route' => 'assignment.answer.bulk-action', 'id' => 'bulk_action_form']) !!}
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
                    <th >S.N.</th>
                    <th>Reg. Num..</th>
                    <th>Name</th>
                    <th>Answer</th>
                    <th>Attachment</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($data['answers']) && $data['answers']->count() > 0)
                        @php($i=1)
                        @foreach($data['answers'] as $answer)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $answer->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ $i }}</td>
                                <td>{!! $answer->reg_no !!}</td>
                                <td>{{ $answer->first_name.' '. $answer->middle_name.' '.$answer->last_name }}</td>
                                <td>{{--{!! $answer->answer_text !!}--}}
                                    <a href="{{ route('assignment.answer.view',['id'=>$data['assignment']->id,'answer' => $answer->id]) }}" class="btn btn-primary btn-mini" >
                                        <i class="ace-icon fa fa-eye bigger-120"></i>
                                        View Answer Detail
                                    </a>
                                </td>
                                <td>
                                    @if($answer->file)
                                        <a href="{{ asset('assignments'.DIRECTORY_SEPARATOR.'answers'.DIRECTORY_SEPARATOR.$answer->file) }}" target="_blank" class="btn btn-success btn-mini" >
                                            <i class="ace-icon fa fa-download bigger-120"></i>
                                            Attachment File
                                        </a>
                                    @endif

                                </td>
                                <td>
                                    @if($answer->approve_status == 1)
                                        <button class="btn btn-primary btn-minier dropdown-toggle" >
                                            Approve
                                        </button>
                                    @elseif($answer->approve_status == 2)
                                        <button class="btn btn-danger btn-minier dropdown-toggle" >
                                        Rejected
                                        </button>
                                    @else
                                        <button class="btn btn-info btn-minier dropdown-toggle" >
                                            Pending
                                        </button>
                                    @endif
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