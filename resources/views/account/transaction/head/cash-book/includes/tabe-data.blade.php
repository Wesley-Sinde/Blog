<hr class="hr hr-2">
<div class="row align-center">
    <span class="receipt-copy">{{$data['print_head']}}</span>
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
        <td class="text-right"><strong>{{ $data['total']['opening'] }}</strong> Cr.</td>
        <td class="text-right"> </td>
    </tr>
    <tr>
        <td class="text-left">Total Fee Collected</td>
        <td class="text-right">{{ $data['fee_collection'] }} Cr.</td>
        <td class="text-right"></td>
    </tr>
    <tr>
        <td class="text-left">Total Salary Pay</td>
        <td class="text-right"></td>
        <td class="text-right">{{ $data['salary_pay'] }} Dr.</td>
    </tr>
    <tr>
        <td class="text-left">Bank deposit / withdraw amount</td>
        <td class="text-right">{{$data['bank_transaction']->sum('cr_amt')}} Cr.</td>
        <td class="text-right">{{ $data['bank_transaction']->sum('dr_amt') }} Dr.</td>
    </tr>
    <tr>
        <td class="text-left">Transactions Income and Expenses on different heads</td>

        <td class="text-right">{{$data['transaction']->sum('cr_amount')}} Cr.</td>
        <td class="text-right">{{ $data['transaction']->sum('dr_amount') }} Dr.</td>
    </tr>
    <tr>
        <td class="text-right"><strong>Closing Balance Cash on Hand</strong></td>
        <td class="text-right"></td>
        <td class="text-right"><strong>{{ $data['total']['coh'] }}</strong> Dr.</td>
    </tr>
    </tbody>
    <tfoot>
    <tr style="font-size: 14px; background: orangered;color: white; border:1px black solid; font-weight: bold">
        <td class="text-center">Account Tally</td>
        <td class="text-right">{{ $data['total']['cr'] }} Cr.</td>
        <td class="text-right">{{ $data['total']['dr'] }} Dr.</td>
    </tr>
    </tfoot>
</table>
