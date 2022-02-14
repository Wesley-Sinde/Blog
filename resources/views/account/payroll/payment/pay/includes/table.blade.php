<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
        <div class="clearfix">
            <a type="button" class="label label-primary label-lg whit open-AddSalMasterDialog" data-toggle="modal"
               data-target="#salaryMasterModal">
                <i class="fa fa-plus" aria-hidden="true"></i> Add
            </a>

            <a class="label label-primary label-lg white" href="{{ route('print-out.payroll.staff-ledger', ['id' => $data['staff']->id]) }}" target="_blank">
                Print Ledger
                <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
            </a>

            <label class="label label-info arrowed label-lg white">Total Balance Amount : {{ number_format($data['staff']->balance, 2) }}/-</label>
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">

            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead class="header">
                    <tr role="row">
                        <th class="sorting_disabled">TagLine</th>
                        <th class="sorting_disabled">Head</th>
                        <th class="sorting_disabled">DueDate</th>
                        <th class="sorting_disabled">Amount </th>
                        <th class="sorting_disabled">Pay Id</th>
                        <th class="sorting_disabled">Mode</th>
                        <th class="sorting_disabled">Date</th>
                        <th class="sorting_disabled">Allowance </th>
                        <th class="sorting_disabled">Fine </th>
                        <th class="sorting_disabled">Paid </th>
                        <th class="sorting_disabled">Balance </th>
                        <th class="sorting_disabled">Status</th>
                        <th class="sorting_disabled">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if (isset($data['payroll_master']) && $data['payroll_master']->count() > 0)
                    @foreach($data['payroll_master'] as $payrollMaster)
                        <tr class="danger font12 odd" role="row">
                            <td> {{ $payrollMaster->tag_line }}</td>
                            <td> {{ ViewHelper::getPayrollHeadById($payrollMaster->payroll_head) }}</td>
                            <td>{{ \Carbon\Carbon::parse($payrollMaster->due_date)->format('Y-m-d')}}</td>
                            <td>{{ $payrollMaster->amount }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $payrollMaster->paySalary()->sum('allowance') }}</td>
                            <td>{{ $payrollMaster->paySalary()->sum('fine') }}</td>
                            <td>{{ $payrollMaster->paySalary()->sum('paid_amount') }}</td>
                            <td>
                                {{
                                    $net_balance = ($payrollMaster->amount - ($payrollMaster->paySalary()->sum('paid_amount') + $payrollMaster->paySalary()->sum('fine')))+ $payrollMaster->paySalary()->sum('allowance')
                                }}
                            </td>
                            <td>
                                @if($net_balance == 0)
                                    <span class="label label-success">Paid</span>
                                @elseif($net_balance < 0 )
                                    <span class="label label-warning">Negative</span>
                                @elseif($net_balance < $payrollMaster->amount)
                                    <span class="label label-info">Partial</span>
                                @else
                                    <span class="label label-danger">Due</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group pull-right">
                                    @if($net_balance > 0)
                                    <button type="button" class="btn btn-xs btn-primary open-AddSalDialog" data-toggle="modal"
                                            data-target="#salaryPayModal"
                                            data-staff-id="{{ $payrollMaster->staff_id }}"
                                            data-id="{{ $payrollMaster->id }}"
                                            data-amount="{{ $net_balance }}"
                                            data-tag-line="{{ $payrollMaster->tag_line }}"
                                            data-head="{{ ViewHelper::getPayrollHeadById($payrollMaster->payroll_head) }}"
                                            >
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                    @endif

                                    <button class="btn btn-xs btn-primary printDoc" data-main_invoice="132" data-sub_invoice="1" title="Print"><i class="fa fa-print"></i> </button>
                                </div>
                            </td>
                        </tr>
                        @if (isset($data['pay_salary']) && $data['pay_salary']->count() > 0)
                            @php($i=1)
                             @foreach($data['pay_salary'] as $pay_salary)
                                @if($pay_salary->salary_masters_id == $payrollMaster->id)

                                    <tr class="white-td even" role="row">
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td class="text-right"><i class="fa fa-arrow-right"></i></td>
                                        <td>
                                            <a href="#" data-toggle="popover" class="detail_popover" data-original-title="" title=""> {{ $pay_salary->salary_masters_id.'/'.$i }}</a>
                                            <div class="fee_detail_popover" style="display: none">
                                                <p class="text text-danger">{{ $pay_salary->note }}</p>
                                            </div>
                                        </td>
                                        <td>{{ $pay_salary->payment_mode }}</td>
                                        <td> {{ \Carbon\Carbon::parse($pay_salary->date)->format('Y-m-d')}}</td>
                                        <td>{{ $pay_salary->allowance }}</td>
                                        <td>{{ $pay_salary->fine }}</td>
                                        <td>{{ $pay_salary->paid_amount }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="btn-group pull-right">
                                                <a class="btn btn-xs btn-danger bootbox-confirm" href="{{ route($base_route.'.delete', ['id' => $pay_salary->id]) }}">
                                                    <i class="fa fa-trash"> </i>
                                                </a>
                                                <button class="btn btn-xs btn-primary printDoc" data-main_invoice="132" data-sub_invoice="1" title="Print"><i class="fa fa-print"></i> </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @php($i++)
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                    <tr style="font-size: 14px; background: orangered;color: white;">
                        <td colspan="3 ">Total</td>
                        <td>{{ $data['staff']->amount }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $data['staff']->allowance }}</td>
                        <td>{{ $data['staff']->fine }}</td>
                        <td>{{ $data['staff']->paid_amount }}</td>
                        <td>
                            {{ $data['staff']->balance }}
                        </td>
                        <td>
                            @if($data['staff']->balance == 0)
                                <span class="label label-success">Paid</span>
                            @elseif($data['staff']->balance < 0 )
                                <span class="label label-warning">Negative</span>
                            @elseif($data['staff']->balance < $data['staff']->amount)
                                <span class="label label-info">Partial</span>
                            @else
                                <span class="label label-danger">Due</span>
                            @endif
                        </td>
                        <td class="hidden-print"> </td>
                    </tr>
                </tfoot>
               {{--<thead class="header-copy header-fixed hide" style="width: 1098px;">
                    <tr role="row">
                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 50px;">Sem</th>
                        <th align="left" class="sorting_disabled" rowspan="1" colspan="1" style="width: 111px;">Head</th>
                        <th align="left" class="text text-left sorting_disabled" rowspan="1" colspan="1" style="width: 80px;">Due Date</th>
                        <th align="left" class="text text-left sorting_disabled" rowspan="1" colspan="1" style="width: 60px;">Status</th>
                        <th class="text text-right sorting_disabled" rowspan="1" colspan="1" style="width: 66px;">Amount </th>
                        <th class="text text-left sorting_disabled" rowspan="1" colspan="1" style="width: 66px;">Payment Id</th>
                        <th class="text text-left sorting_disabled" rowspan="1" colspan="1" style="width: 34px;">Mode</th>
                        <th class="text text-left sorting_disabled" rowspan="1" colspan="1" style="width: 65px;">Date</th>
                        <th class="text text-right sorting_disabled" rowspan="1" colspan="1" style="width: 71px;">Discount </th>
                        <th class="text text-right sorting_disabled" rowspan="1" colspan="1" style="width: 44px;">Fine </th>
                        <th class="text text-right sorting_disabled" rowspan="1" colspan="1" style="width: 57px;">Paid </th>
                        <th class="text text-right sorting_disabled" rowspan="1" colspan="1" style="width: 65px;">Balance </th>
                        <th class="text text-right sorting_disable hidden-print" rowspan="1" colspan="1" style="width: 43px;"></th>
                </thead>--}}
            </table>
        </div>
    </div>
</div>