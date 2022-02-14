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
        <table width="100%" class="table-bordered">
            <thead>
            <tr>
                <th>Particulars</th>
                <th class="text-right">Credit (-)</th>
                <th class="text-right">Debit (+)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-right"><strong>Opening Balance </strong></td>
                <td class="text-right"><strong>{{ $data['row'][$i]['total']['opening'] }}</strong></td>
                <td class="text-right"> </td>
            </tr>
            <tr>
                <td class="text-left">Total Fee Collected</td>
                <td class="text-right">{{ $data['row'][$i]['fee_collection'] }}</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-left">Total Salary Pay</td>
                <td class="text-right"></td>
                <td class="text-right">{{ $data['row'][$i]['salary_pay'] }}</td>
            </tr>
            <tr>
                <td class="text-left">Bank deposit / withdraw amount</td>
                <td class="text-right">{{$data['row'][$i]['bank_transaction']->sum('cr_amt')}}</td>
                <td class="text-right">{{ $data['row'][$i]['bank_transaction']->sum('dr_amt') }}</td>
            </tr>
            <tr>
                <td class="text-left">Transactions Income and Expenses on different heads</td>

                <td class="text-right">{{$data['row'][$i]['transaction']->sum('cr_amount')}}</td>
                <td class="text-right">{{ $data['row'][$i]['transaction']->sum('dr_amount') }}</td>
            </tr>
            <tr>
                <td class="text-right"><strong>Closing Balance Cash on Hand</strong></td>
                <td class="text-right"></td>
                <td class="text-right"><strong>{{ $data['row'][$i]['total']['coh'] }}</strong></td>
            </tr>
            </tbody>
            <tfoot>
            <tr style="font-size: 14px; background: orangered;color: white; border:1px black solid; font-weight: bold">
                <td class="text-center">Account Tally</td>
                <td class="text-right">{{ $data['row'][$i]['total']['cr'] }}</td>
                <td class="text-right">{{ $data['row'][$i]['total']['dr'] }}</td>
            </tr>
            </tfoot>
        </table>
        <div class="space-8"></div>
    @endfor
@endif