<div class="row align-center">
    <span class="receipt-copy">STATEMENT OF ACCOUNT </span>
    <table width="100%" class="table-bordered">
        <tr>
            <th class="text-right">Date:</th>
            <td class="text-left">{{$data['table_head']}}</td>

            <th class="text-right">A/C No. / Name :</th>
            <td class="text-left">{{ strtoupper(isset($data['row']->tr_head)?$data['row']->tr_head:'') }}</td>

        </tr>
        {{--<tr>
            <th class="text-right">A/C Type : </th>
            <td class="text-left">{{ strtoupper(ViewHelper::getAcGroupById($data['row']->acc_id)) }}</td>

            <th class="text-right">Currency : </th>
            <td class="text-left">{{ strtoupper(ViewHelper::getAcGroupById($data['row']->acc_id)) }}</td>
        </tr>--}}
    </table>
    <hr class="hr hr-8">
</div>
<table width="100%" class="table-bordered">
    <thead>
    <tr>
        <th>SN</th>
        <th>Date</th>
        <th>Description</th>
        <th>Debit (+)</th>
        <th>Credit (-)</th>
        <th>Balance</th>
    </tr>
    </thead>
    <tbody>
    @if (isset($data['transaction']) && $data['transaction']->count() > 0)
        @php($i=1)
        @php($diffAmount[0] = 0)
        <tr>
            <td colspan="5" class="text-right"><strong>Opening Balance </strong></td>
            @if(is_numeric($data['opening']) && $data['opening'] >= 0)
                <td align="right"><strong>{{ $data['opening'] }}</strong></td>
            @else
                <td class="red" align="right"><strong>{{ $data['opening'] }}</strong></td>
            @endif
        </tr>
        @foreach($data['transaction'] as $key => $transaction)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}</td>
                <td>{{ $transaction->description }}</td>
                <td align="right">{{ $transaction->dr_amount > 0?$transaction->dr_amount:'' }}</td>
                <td align="right">{{ $transaction->cr_amount > 0?$transaction->cr_amount:'' }}</td>
                @if(is_numeric($transaction->balance) && $transaction->balance >= 0)
                    <td align="right">{{ $transaction->balance }}</td>
                @else
                    <td class="red" align="right">{{ $transaction->balance }}</td>
                @endif
            </tr>
            @php($i++)
        @endforeach
    @else
        <tr>
            <td colspan="6">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
        </tr>
    @endif
    </tbody>
    <tfoot>
    <tr style="font-size: 14px; background: orangered;color: white; border:1px black solid; font-weight: bold">
        <td colspan="3" align="right"><b>Grand Total:</b></td>
        <td align="right"><b>{{$drTotal = isset($data['transaction'])?$data['transaction']->sum('dr_amount'):0}}</b></td>
        <td align="right"><b>{{$crTotal = isset($data['transaction'])?$data['transaction']->sum('cr_amount'):0}}</b></td>
        {{--<td align="right"><b>{{ $drTotal - $crTotal }}</b></td>--}}
        <td align="right"><b>{{ isset($transaction->balance)?$transaction->balance:0 }}</b></td>
    </tr>
    </tfoot>
</table>
<div class="space-8"></div>