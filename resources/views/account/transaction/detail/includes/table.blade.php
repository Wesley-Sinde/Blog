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
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>2019-04-06</td>
                                <td></td>
                                <td align="center">1</td>
                                <td align="right">NPR. 500</td>
                                <td align="right">NPR. </td>

                                <td align="right">NPR. 500</td>
                            </tr>

                            <tr>
                                <td>2019-04-06</td>
                                <td></td>
                                <td align="center">2</td>
                                <td align="right">NPR. </td>
                                <td align="right">NPR. 1700</td>

                                <td align="right">NPR. 1700</td>
                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3" align="right"><b>Grand Total:</b></td>

                                <td align="right"><b>NPR. 500.00</b></td>

                                <td align="right"><b>NPR. 1,700.00</b></td>

                                <td align="right"><b>NPR. -1,200.00</b></td>

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
