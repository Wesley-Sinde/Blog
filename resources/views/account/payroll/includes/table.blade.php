<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i> Salary Paid History </h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            Salary Paid  Record list on table. Filter Salary Paid using the filter.
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th >S.N.</th>
                            <th>Reg.Num</th>
                            <th>Staff Name</th>
                            <th>Head</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>User</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (isset($data['salaryPay']) && $data['salaryPay']->count() > 0)
                        @php($i=1)
                        @foreach($data['salaryPay'] as $salaryPay)
                            <tr>
                                <td>{{ $i }}</td>
                                <td> <a href="{{ route('student.view', ['id' => $salaryPay->staff_id]) }}" target="_blank">{{ $salaryPay->reg_no }}</a></td>
                                <td> <a href="{{ route('student.view', ['id' => $salaryPay->staff_id]) }}" target="_blank">{{ $salaryPay->first_name.' '.$salaryPay->middle_name.' '. $salaryPay->last_name }}</a></td>
                                {{--<td>{{ ViewHelper::getDesignationId($salaryPay->designation) }}</td>--}}
                                <td>{{ ViewHelper::getFeeHeadById($salaryPay->payroll_head) }}</td>
                                <td>{{ \Carbon\Carbon::parse($salaryPay->date)->format('Y-m-d')}} </td>
                                <td class="text-right">{{ $salaryPay->paid_amount }}</td>
                                <td>{{ $salaryPay->payment_mode }}</td>
                                <td> {{  ViewHelper::getUserNameId( $salaryPay->created_by ) }}</td>
                                <td>
                                    <div class="btn btn-primary btn-minier action-buttons">
                                        <a class="white" href="{{ route('account.salary.payment.view', ['id' => $salaryPay->staff_id]) }}">
                                            <i class="ace-icon fa fa-calculator bigger-130"></i>&nbsp;
                                        </a>
                                    </div>
                                </td>
                            @php($i++)
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">No Salary Paid data found. Please Filter Salary Paid to show. </td>
                        </tr>
                    @endif
                    </tbody>
                    <tfoot>
                        <tr style="font-size: 14px; background: orangered;color: white;">
                            <td colspan="5" class="text-right">Total</td>
                            <td  class="text-right">{{ $data['salaryPay']->sum('paid_amount') }}</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                    </tfoot>
                </table>
        </div>
        {!! Form::close() !!}
    </div>
</div>


