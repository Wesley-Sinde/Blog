<hr class="hr hr-2">
<div class="row align-center">
    <span class="receipt-copy">{{$data['print_head']}}</span>
</div>
<hr class="hr hr-2">
<table width="100%" class="table-bordered">
    <thead>
        <tr>
            <th class="text-center" width="5%">S.N.</th>
            <th>Head</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
    @if (isset($data['fee_collection']) && $data['fee_collection']->count() > 0)
        @php($i=1)
        @foreach($data['fee_collection'] as $feesCollection)
                <tr style="border-bottom: #d8d8d8 0.1px solid;">
                    <td>{{ $i }}.</td>
                    <td>{{ ViewHelper::getFeeHeadById($feesCollection[0]->fee_head) }}</td>
                    <td class="text-right">{{ $feesCollection->sum('paid_amount') }}</td>
                     @php($i++)
                </tr>
        @endforeach
    @else
        <tr>
            <td colspan="11">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
        </tr>
    @endif
    </tbody>
    <tfoot>
        <tr style="font-size: 16px;font-weight: 600; background: orangered;color: white;border-bottom: #d8d8d8 0.1px solid;">
            <td colspan="2" class="text-right">Total</td>
            <td  class="text-right">{{ $data['fee_collection_total'] }}</td>
        </tr>
    </tfoot>
</table>
