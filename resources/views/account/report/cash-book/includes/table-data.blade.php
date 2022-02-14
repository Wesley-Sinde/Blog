<hr class="hr hr-2">
<div class="row align-center">
    <span class="receipt-copy">{{$data['print_head']}}</span>
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
        <td class="text-right"><strong>{{ $data['total']['opening'] }}</strong></td>
        <td class="text-right"> </td>
    </tr>
    <tr>
        <td class="text-left">Total Fee Collected</td>
        <td class="text-right">{{ $data['fee_collection'] }} </td>
        <td class="text-right"></td>
    </tr>
    <tr>
        <td class="text-left">Total Salary Pay</td>
        <td class="text-right"></td>
        <td class="text-right">{{ $data['salary_pay'] }} </td>
    </tr>
    <tr>
        <td class="text-left">Bank deposit / withdraw amount</td>
        <td class="text-right">{{$data['bank_transaction']->sum('cr_amt')}}</td>
        <td class="text-right">{{ $data['bank_transaction']->sum('dr_amt') }}</td>
    </tr>
    <tr>
        <td class="text-left">Transactions on different Ledger</td>

        <td class="text-right">{{$data['transaction']->sum('cr_amount')}}</td>
        <td class="text-right">{{ $data['transaction']->sum('dr_amount') }}</td>
    </tr>
    <tr>
        <td class="text-right"><strong>Closing Balance Cash on Hand</strong></td>
        <td class="text-right"></td>
        <td class="text-right"><strong>{{ $data['total']['coh'] }}</strong> </td>
    </tr>
    </tbody>
    <tfoot>
    <tr style="font-size: 14px; background: orangered;color: white; border:1px black solid; font-weight: bold">
        <td class="text-center">Account Tally</td>
        <td class="text-right">{{ $data['total']['cr'] }}</td>
        <td class="text-right">{{ $data['total']['dr'] }}</td>
    </tr>
    </tfoot>
</table>
