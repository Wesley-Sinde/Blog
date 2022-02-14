<div class="col-xs-12">
    <div class="hr hr-8 hr-dotted"></div>
</div>
    <div class="clearfix">
        {{--<span class="pull-right tableTools-container"></span>--}}
    </div>
    <!-- div.table-responsive -->
<div class="table-responsive">
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead class="header">
            <tr role="row">
            <th>S.No.</th>
            <th>Sem</th>
            <th>Head</th>
            <th>DueDate</th>
            <th>Amount </th>
            <th>Dis. </th>
            <th>Fine </th>
            <th>Paid </th>
            <th>Due </th>
            <th>Status</th>
            {{--<th></th>--}}
        </tr>
        </thead>
        <tbody>
            @if (isset($data['fee_master']) && $data['fee_master']->count() > 0)
                @php($i=1)
                @foreach($data['fee_master'] as $feemaster)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ ViewHelper::getSemesterById($feemaster->semester) }}</td>
                        <td>{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}</td>
                        <td>{{ \Carbon\Carbon::parse($feemaster->fee_due_date)->format('Y-m-d')}}</td>
                        <td>{{ $feemaster->fee_amount }}</td>
                        <td>{{ $feemaster->feeCollect()->sum('discount')?$feemaster->feeCollect()->sum('discount'):'-' }}</td>
                        <td>{{ $feemaster->feeCollect()->sum('fine')?$feemaster->feeCollect()->sum('fine'):'-' }}</td>
                        <td>{{ $feemaster->feeCollect()->sum('paid_amount')?$feemaster->feeCollect()->sum('paid_amount'):'-' }}</td>
                        <td>
                            @php($net_balance = ($feemaster->fee_amount - ($feemaster->feeCollect()->sum('paid_amount')
                            + $feemaster->feeCollect()->sum('discount')))+ $feemaster->feeCollect()->sum('fine'))
                            {{ $net_balance?$net_balance:'-' }}
                        </td>
                        <td align="left" class="text text-left">
                            @if($net_balance == 0)
                                <span class="label label-success">Paid</span>
                            @elseif($net_balance < 0 )
                                <span class="label label-warning">Negative</span>
                            @elseif($net_balance < $feemaster->fee_amount)
                                <span class="label label-info">Partial</span>
                            @else
                                <span class="label label-danger">Due</span>
                            @endif
                        </td>
                        {{--<td class="hidden-print">
                            @if($net_balance > 0 && is_int($net_balance))
                                @include('account.fees.payment.online-payment')
                            @endif
                        </td>--}}
                    </tr>
                    @php($i++)
                @endforeach

            @endif
        </tbody>
        <tfoot>
            <tr style="font-size: 14px; background: orangered;color: white;">
                <td colspan="4">Total</td>
                <td>{{ $data['student']->fee_amount?$data['student']->fee_amount:'-' }}</td>
                <td>{{ $data['student']->discount?$data['student']->discount:'-' }}</td>
                <td>{{ $data['student']->fine?$data['student']->fine:'-' }}</td>
                <td>{{ $data['student']->paid_amount?$data['student']->paid_amount:'-' }}</td>
                <td>
                    {{ $data['student']->balance?$data['student']->balance:'-' }}
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
                {{--<td></td>--}}
            </tr>
        </tfoot>
    </table>
</div>
