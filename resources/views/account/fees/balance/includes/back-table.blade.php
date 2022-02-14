<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
        {!! Form::open(['route' => 'info.smsemail.dueReminder', 'id' => 'send_reminder_message']) !!}
        <div class="clearfix">
            <span class="form-group due-reminder-submit">
                    <label>{!! Form::radio('type[]','sms' ,false, ["class" => "ace", "id"=>"typeSms"]) !!}<span class="lbl"> SMS </span></label>
                    <label>{!! Form::radio('type[]','email' ,false, ["class" => "ace", "id"=>"typeEmail"]) !!}<span class="lbl"> E-mail</span></label>
                    <a class="btn-primary btn-sm message-send-btn" ><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Send Reminder</a>
                    <a class="btn-success btn-sm bulk-due-slip" >Bulk Due Detail Slip <i class="fa fa-print" aria-hidden="true"></i></a>
            </span>
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>S.N.</th>
                    <th>Faculty/Class</th>
                    <th>Sem./Sec.</th>
                    <th>Reg. Num.</th>
                    <th>Name of Student</th>
                    <th>Total Fee</th>
                    <th>Balance</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($data['student']) && $data['student']->count() > 0)
                        @php($i=1)
                        @foreach($data['student'] as $student)
                            @php($balance = (($student->feeMaster()->sum('fee_amount')-$student->feeCollect()->sum('paid_amount'))
                            - $student->feeCollect()->sum('discount'))+$student->feeCollect()->sum('fine'))
                            @if($balance > 0)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $student->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ $i }}</td>
                                <td> {{  ViewHelper::getFacultyTitle( $student->faculty ) }}</td>
                                <td> {{  ViewHelper::getSemesterTitle( $student->semester ) }}</td>
                                <td><a href="{{ route('student.view', ['id' => $student->id]) }}">{{ $student->reg_no }}</a></td>
                                <td><a href="{{ route('student.view', ['id' => $student->id]) }}"> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</a></td>
                                <td>
                                    {{ $student->feeMaster()->sum('fee_amount') }}
                                </td>
                                <td>
                                    {{ $balance }}
                                </td>
                                <td>
                                    <div class="btn btn-primary btn-minier action-buttons ">
                                        <a class="white" href="{{ route('account.fees.collection.view', ['id' => $student->id]) }}">
                                            <i class="ace-icon fa fa-calculator bigger-130"></i>&nbsp;
                                        </a>
                                    </div>
                                </td>
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
                <tfoot>
                    <tr style="font-size: 14px; background: orangered;color: white;">
                    <td colspan="3 ">Total</td>
                    <td>{{ $data['student']->fee_amount }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $data['student']->discount }}</td>
                    <td>{{ $data['student']->fine }}</td>
                    <td>{{ $data['student']->paid_amount }}</td>
                    <td>
                        {{ $data['student']->balance }}
                    </td>
                    <td>
                        @if($data['student']->balance == 0)
                            <span class="label label-success">Paid</span>
                        @elseif($data['student']->balance < 0 )
                            <span class="label label-warning">Negative</span>
                        @elseif($data['student']->balance < $data['student']->fee_amount)
                            <span class="label label-warning">Partial</span>
                        @else
                            <span class="label label-danger">Due</span>
                        @endif
                    </td>
                    <td class="hdidden-print"> </td>
                </tr>
                </tfoot>
            </table>
        </div>

        {!! Form::close() !!}
    </div>
</div>


