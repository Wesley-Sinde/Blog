@if($data['row'] && $data['row']->count() > 0)
    <div class="row align-center">
        <span class="receipt-copy">{{$data['row']['print_head']}}</span>
    </div>
    <hr class="hr hr-2">

    <table width="100%" class="table-bordered">
        <thead>
        <tr>
            <th class="text-center" width="5%">S.N.</th>
            <th>Date</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>

        @php($sn=1)
        @for ($i = 0; $i <= $data['keys']; $i++)
            @if (isset($data['row'][$i]['fee_collection']) && $data['row'][$i]['fee_collection']->count() > 0)
                @foreach($data['row'][$i]['fee_collection'] as $Index => $feesCollection)
                        @if($data['tag'] =='daily')
                            <tr style="border-bottom: #d8d8d8 0.1px solid;">
                                <td>{{ $sn }}.</td>
                                <td>{{ \Carbon\Carbon::parse($Index)->format('Y-m-d') }} </td>
                                <td class="text-right">{{ $data['row'][$i]['fee_collection_total'] }}</td>
                            </tr>
                        @elseif($data['tag'] =='weekly')
                            <tr style="border-bottom: #d8d8d8 0.1px solid;">
                                <td>{{ $sn }}.</td>
                                <td>{{ $data['row'][$i]['table_head'] }}</td>
                                <td class="text-right">{{ $data['row'][$i]['fee_collection_total'] }}</td>
                            </tr>
                        @elseif($data['tag'] =='monthly')
                            <tr style="border-bottom: #d8d8d8 0.1px solid;">
                                <td>{{ $sn }}.</td>
                                <td>{{ \Carbon\Carbon::parse($Index)->format('Y-M') }} </td>
                                <td class="text-right">{{ $data['row'][$i]['fee_collection_total'] }}</td>
                            </tr>
                        @elseif($data['tag'] =='yearly')
                            <tr style="border-bottom: #d8d8d8 0.1px solid;">
                                <td>{{ $sn }}.</td>
                                <td>{{ \Carbon\Carbon::parse($Index)->format('Y') }}</td>
                                {{--<td>{{ $data['row'][$i]['table_head'] }}</td>--}}
                                <td class="text-right">{{ $data['row'][$i]['fee_collection_total'] }}</td>
                            </tr>
                        @endif
                    @php($sn++)
                @endforeach
            @endif
        @endfor

        </tbody>
        <tfoot>
            <tr style="font-size: 16px;font-weight: 600; background: orangered;color: white;border-bottom: #d8d8d8 0.1px solid;">
                <td colspan="2" class="text-right">Total</td>
                <td  class="text-right">{{ $data['date_total_fee'] }}</td>
            </tr>
        </tfoot>
    </table>
    <div class="space-8"></div>

@endif