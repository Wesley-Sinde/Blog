@if($data['row'] && $data['row']->count() > 0)
    <div class="row align-center">
        <span class="receipt-copy">{{$data['row']['print_head']}}</span>
    </div>
    <hr class="hr hr-2">
    @for ($i = 0; $i <= $data['keys']; $i++)
        <div class="row align-center">
            <span class="receipt-copy">{{$data['row'][$i]['table_head']}}</span>
        </div>
        <hr class="hr hr-2">
        <table width="90%">
            <thead>
            <tr>
                <th>Particulars</th>
                <th class="text-right">Cr.</th>
                <th class="text-right">Dr.</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-right"><strong>Opening Balance </strong></td>
                <td class="text-right"><strong>{{ $data['row'][$i]['total']['opening'] }}</strong> Cr.</td>
                <td class="text-right"> </td>
            </tr>
            <tr>
                <td class="text-left">Total Fee Collected</td>
                <td class="text-right">{{ $data['row'][$i]['fee_collection'] }} Cr.</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-left">Total Salary Pay</td>
                <td class="text-right"></td>
                <td class="text-right">{{ $data['row'][$i]['salary_pay'] }} Dr.</td>
            </tr>
            <tr>
                <td class="text-left">Bank deposit / withdraw amount</td>
                <td class="text-right">{{$data['row'][$i]['bank_transaction']->sum('cr_amt')}} Cr.</td>
                <td class="text-right">{{ $data['row'][$i]['bank_transaction']->sum('dr_amt') }} Dr.</td>
            </tr>
            <tr>
                <td class="text-left">Transactions Income and Expenses on different heads</td>

                <td class="text-right">{{$data['row'][$i]['transaction']->sum('cr_amount')}} Cr.</td>
                <td class="text-right">{{ $data['row'][$i]['transaction']->sum('dr_amount') }} Dr.</td>
            </tr>
            <tr>
                <td class="text-right"><strong>Closing Balance Cash on Hand</strong></td>
                <td class="text-right"></td>
                <td class="text-right"><strong>{{ $data['row'][$i]['total']['coh'] }}</strong> Dr.</td>
            </tr>
            </tbody>
            <tfoot>
            <tr style="font-size: 14px; background: orangered;color: white; border:1px black solid; font-weight: bold">
                <td class="text-center">Account Tally</td>
                <td class="text-right">{{ $data['row'][$i]['total']['cr'] }} Cr.</td>
                <td class="text-right">{{ $data['row'][$i]['total']['dr'] }} Dr.</td>
            </tr>
            </tfoot>
        </table>
        <div class="space-8"></div>
    @endfor
@endif