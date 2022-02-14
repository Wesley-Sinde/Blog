<div class="col-xs-12">
    <div class="hr hr-8 hr-dotted"></div>
</div>
    <div class="clearfix">
        {{--<span class="pull-right tableTools-container"></span>--}}
    </div>
    <!-- div.table-responsive -->
<div class="table-responsive">
    <table {{--id="dynamic-table-1" --}}class="table table-striped table-bordered table-hover">
        <thead class="header">
            <tr role="row">
            <th>S.No.</th>
            <th>Student</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Gateway</th>
            <th>Reference</th>
            <th>Paid By</th>
            <th>Status</th>
            {{--<th></th>--}}
        </tr>
        </thead>
        <tbody>
            @if (isset($data['onlinePayments']) && $data['onlinePayments']->count() > 0)
                @php($i=1)
                @foreach($data['onlinePayments'] as $payment)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ ViewHelper::getStudentRegById($payment->students_id) }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->date)->format('Y-m-d')}}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->payment_gateway }}</td>
                        <td> {{ $payment->ref_no }} </td>
                        <td> {{ ViewHelper::getUserNameId($payment->created_by) }} </td>
                        <td align="left" class="text text-left">
                            @if($payment->status == 0)
                                <span class="label label-danger">Not Verify</span>
                            @else
                                <span class="label label-success">Verified</span>
                            @endif
                        </td>
                    </tr>
                    @php($i++)
                @endforeach

            @endif
        </tbody>
    </table>
</div>
