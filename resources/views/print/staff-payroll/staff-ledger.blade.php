@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="space-6"></div>

                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="widget-box transparent">
                                    <div class="widget-header widget-header-large">
                                        <h3 class="widget-title grey lighter no-margin-bottom">
                                            <i class="ace-icon fa fa-calculator green"></i> Staff Payroll Ledger - {{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}
                                        </h3>

                                        <div class="widget-toolbar no-border invoice-info">
                                            <span class="invoice-info-label">User:</span>
                                            <span class="red">{{isset(auth()->user()->name)?auth()->user()->name:""}}</span>

                                            <br />
                                            <span class="invoice-info-label">Date:</span>
                                            <span class="blue">{{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}</span>
                                        </div>

                                        <div class="widget-toolbar hidden-480">
                                            <a href="#" onclick="window.print()">
                                                <i class="ace-icon fa fa-print bigger-180"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main padding-24">
                                            <div class="print-info">
                                                <table class="table  no-border">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span>Reg No. : </span>{{ $data['staff']->reg_no }}
                                                                <hr class="hr-2 no-border">
                                                                <span>Name : </span><strong>{{ $data['staff']->first_name.' '.$data['staff']->middle_name.' '.$data['staff']->last_name }}</strong>
                                                                <hr class="hr-2 no-border">
                                                                <span>Designation: </span>{{ ViewHelper::getDesignationId($data['staff']->designation) }}
                                                                <hr class="hr-2 no-border">
                                                                <span>ContactNo: </span>{{$data['staff']->mobile_1 }}
                                                            </td>
                                                            <td class="text-right">
                                                                {!! isset($generalSetting->print_header)?$generalSetting->print_header:'-' !!}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="space"></div>

                                            <div>
                                                <table class="table table-striped table-bordered no-margin-bottom">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th class="sorting_disabled">TagLine</th>
                                                            <th class="sorting_disabled">Head</th>
                                                            <th class="sorting_disabled">DueDate</th>
                                                            <th class="sorting_disabled">Amount </th>
                                                            <th class="sorting_disabled">Allowance </th>
                                                            <th class="sorting_disabled">Fine </th>
                                                            <th class="sorting_disabled">Paid </th>
                                                            <th class="sorting_disabled">Balance </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if($data['payroll_master']->count() > 0)
                                                            @php($i=1)
                                                            @foreach($data['payroll_master'] as $payrollMaster)
                                                                <tr class="font12 odd" role="row">
                                                                    <td> {{ $payrollMaster->tag_line }}</td>
                                                                    <td> {{ ViewHelper::getPayrollHeadById($payrollMaster->payroll_head) }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($payrollMaster->fee_due_date)->format('Y-m-d')}}</td>
                                                                    <td>{{ $amount = $payrollMaster->amount }}</td>
                                                                    <td>{{ $allowance = $payrollMaster->paySalary()->sum('allowance') }}</td>
                                                                    <td>{{ $fine = $payrollMaster->paySalary()->sum('fine') }}</td>
                                                                    <td>{{ $paid_amount = $payrollMaster->paySalary()->sum('paid_amount') }}</td>
                                                                    <td>
                                                                        {{
                                                                            $net_balance = (($amount +$allowance) - ($fine + $paid_amount))
                                                                        }}
                                                                    </td>
                                                                </tr>
                                                                @if (isset($data['pay_salary']) && $data['pay_salary']->count() > 0)
                                                                    @php($i=1)
                                                                    @foreach($data['pay_salary'] as $pay_salary)
                                                                        @if($pay_salary->salary_masters_id == $payrollMaster->id)

                                                                            <tr class="white-td even" role="row">
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
                                                                            </tr>
                                                                            @php($i++)
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                            <tr style="font-size: 14px; background: orangered;color: white;">
                                                                <td colspan="2">Total</td>
                                                                <td>{{ $data['staff']->payroll_amount?$data['staff']->payroll_amount:'-' }}</td>
                                                                <td></td>
                                                                <td>{{ $data['staff']->discount?$data['staff']->discount:'-' }}</td>
                                                                <td>{{ $data['staff']->fine?$data['staff']->fine:'-' }}</td>
                                                                <td>{{ $data['staff']->paid_amount?$data['staff']->paid_amount:'-' }}</td>
                                                                <td>
                                                                    {{ $data['staff']->balance?$data['staff']->balance:'-' }}
                                                                </td>

                                                            </tr>
                                                        @else
                                                            <tr colspan="8"></tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="hr hr8 hr-dotted"></div>

                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                    <strong>Total :</strong>{{$data['staff']->paid_amount}}/-
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                   <strong> In Word:</strong> {{ ViewHelper::convertNumberToWord($data['staff']->paid_amount) }}only.
                                                </div>
                                            </div>
                                            <div class="hr hr8 hr-double"></div>
                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                    <strong>Total Balance :</strong>{{$data['staff']->balance }}/-
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                    <strong> Balance In Word:</strong> {{ ViewHelper::convertNumberToWord($data['staff']->balance ) }}only.
                                                </div>
                                            </div>
                                            <div class="hr hr-4 hr-dotted"></div>
                                            @if(isset($generalSetting->print_footer))
                                                <div class="well well-sm">
                                                    {!! $generalSetting->print_footer !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    <!-- inline scripts related to this page -->
    @include('includes.scripts.print_script')
    @endsection