@if($data['row'] && $data['row']->count() > 0)
    <div class="row align-center">
        <span class="receipt-copy">{{$data['row']['print_head']}}</span>
    </div>
    <hr class="hr hr-2">
    @for ($i = 0; $i <= $data['keys']; $i++)
        @if (isset($data['row'][$i]['fee_collection']) && $data['row'][$i]['fee_collection']->count() > 0)
            <div class="row align-center">
                <span class="receipt-copy">{{$data['row'][$i]['table_head']}}</span>
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
                    @php($sn=1)
                    @foreach($data['row'][$i]['fee_collection'] as $feesCollection)
                        <tr style="border-bottom: #d8d8d8 0.1px solid;">
                            <td>{{ $sn }}.</td>
                            <td>{{ ViewHelper::getFeeHeadById($feesCollection[0]->fee_head) }}</td>
                            <td class="text-right">{{ $feesCollection->sum('paid_amount') }}</td>
                            @php($sn++)
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="font-size: 16px;font-weight: 600; background: orangered;color: white;border-bottom: #d8d8d8 0.1px solid;">
                        <td colspan="2" class="text-right">Total</td>
                        <td  class="text-right">{{ $data['row'][$i]['fee_collection_total'] }}</td>
                    </tr>
                </tfoot>
            </table>
            <div class="space-8"></div>
        @endif
    @endfor
@endif