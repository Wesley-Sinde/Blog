<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">

            <div class="panel-body">
                <div class="text-right hidden-print">
                    <button class="btn btn-warning text-right" href="#" onclick="print()">
                        <i class="fa fa-print bigger-110"></i>    Print
                    </button>
                </div>

                <div id="printableArea" style="margin-left:2px;">
                    <div class="text-center">

                        <h3 style="font-family: 'Merienda', cursive; font-size: 30px"> {{ strtoupper($data['row']->bank_name) }}</h3>
                        <h4 style="font-family: 'Righteous', cursive;">A/C Number : {{ strtoupper($data['row']->ac_number) }} </h4>
                        <h4 style="font-family: 'Righteous', cursive;">Branch : {{ strtoupper($data['row']->branch) }} </h4>

                        <span> Print Date: {{ today()->format('Y-m-d') }} </span>
                    </div>


                    <div class="table-responsive" style="margin-top: 10px;">
                        <table id="" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Withdraw / Deposite ID</th>
                                <th>Debit (+)</th>
                                <th>Credit (-)</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if (isset($data['transaction']) && $data['transaction']->count() > 0)
                                    @php($i=1)
                                    @foreach($data['transaction'] as $transaction)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}</td>
                                        <td>{{ $transaction->description }}</td>
                                        <td align="center">{{ $transaction->deposit_id }}</td>
                                        <td align="right">{{ $transaction->dr_amt }}</td>
                                        <td align="right">{{ $transaction->cr_amt }}</td>
                                        <td align="right">{{ $transaction->balance }}</td>
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
                                <tr>
                                    <td colspan="3" align="right"><b>Grand Total:</b></td>

                                    <td align="right"><b>{{$drTotal = $data['transaction']->sum('dr_amt')}}</b></td>

                                    <td align="right"><b>{{$crTotal = $data['transaction']->sum('cr_amt')}}</b></td>

                                    <td align="right"><b>{{ $drTotal - $crTotal }}</b></td>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="text-center">
                </div>
            </div>
        </div>
    </div>
</div>
