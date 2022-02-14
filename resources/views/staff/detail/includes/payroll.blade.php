<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Payroll List</h4>
        <div class="clearfix">
            <a class="label label-primary label-lg white" href="{{ route('print-out.payroll.staff-ledger', ['id' => $data['staff']->id]) }}" target="_blank">
                Print Ledger
                <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
            </a>

            <label class="label label-info arrowed label-lg white">Total Balance Amount : {{ number_format($data['staff']->balance, 2) }}/-</label>
            <span>
                <a class="btn-warning btn-sm" href="{{ route('account.salary.payment.view', ['id' => $data['staff']->id]) }}">
                     <i class="fa fa-calculator" aria-hidden="true"></i> Pay Salary Now
                 </a>
            </span>
        </div>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            Staff Payroll  Record list on table. Filter list using the search box as you wish.
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="" class="table table-striped table-bordered table-hover dynamic-table">
                <thead class="header">
                    <tr role="row">
                    <th>S.No.</th>
                    <th>Tag Line</th>
                    <th>Head</th>
                    <th>Due Date</th>
                    <th>Amount </th>
                    <th>Allowance </th>
                    <th>Fine </th>
                    <th>Paid </th>
                    <th>Balance </th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['payroll_master']) && $data['payroll_master']->count() > 0)
                    @php($i =1)
                    @foreach($data['payroll_master'] as $payrollMaster)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $payrollMaster->tag_line }}</td>
                            <td>{{ ViewHelper::getPayrollHeadById($payrollMaster->payroll_head) }}</td>
                            <td>{{ \Carbon\Carbon::parse($payrollMaster->fee_due_date)->format('Y-m-d')}}</td>
                            <td>{{ $payrollMaster->amount }}</td>
                            <td>{{ $payrollMaster->paySalary()->sum('allowance') }}</td>
                            <td>{{ $payrollMaster->paySalary()->sum('fine') }}</td>
                            <td>{{ $payrollMaster->paySalary()->sum('paid_amount') }}</td>
                            <td>
                                {{
                                    $net_balance = ($payrollMaster->amount - ($payrollMaster->paySalary()->sum('paid_amount') + $payrollMaster->paySalary()->sum('fine')))+ $payrollMaster->paySalary()->sum('allowance')
                                }}
                            </td>
                            <td align="left">
                                @if($net_balance == 0)
                                    <span class="label label-success">Paid</span>
                                @elseif($net_balance < 0 )
                                    <span class="label label-danger">Negative</span>
                                @elseif($net_balance < $payrollMaster->amount)
                                    <span class="label label-warning">Partial</span>
                                @else
                                    <span class="label label-danger">Due</span>
                                @endif
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">No Payroll Data Found</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>