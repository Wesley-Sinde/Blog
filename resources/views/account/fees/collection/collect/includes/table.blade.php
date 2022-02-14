<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue text-uppercase">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;
            Student Ledger -
            Due: {{ number_format($data['student']->balance, 2) }} [{{ ViewHelper::convertNumberToWord($data['student']->balance ) }}]
        </h4>
        <div class="clearfix">
            <a class="label label-primary label-lg bulk-action-btn" target="_blank">
                <i class="fa fa-print"></i> Print Fee Head
            </a>

            <a href="{{ route('account.fees.due.view', ['id' => $data['student']->id]) }}" target="_blank" class="label label-primary label-lg white">
                <i class="ace-icon fa fa-calculator  align-top bigger-125 icon-on-right"></i>
                Collect Balance
            </a>
            <a type="button" class="label label-primary label-lg whit open-feeMasterDialog" data-toggle="modal"
               data-target="#feeMasterAddModal">
                <i class="fa fa-plus" aria-hidden="true"></i> Add Fees
            </a>

            <a class="label label-primary label-lg white" href="{{ route('print-out.fees.student-ledger', ['id' => $data['student']->id]) }}" target="_blank">
                Print Ledger
                <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
            </a>
            <a class="label label-warning label-lg white" href="{{ route('print-out.fees.student-due-detail', ['id' => $data['student']->id]) }}" target="_blank">
                Due Detail
                <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
            </a>
            <a class="label label-warning label-lg white" href="{{ route('print-out.fees.student-due', ['id' => $data['student']->id]) }}" target="_blank">
                Total Balance
                <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
            </a>
            <a class="label label-success label-lg white" href="{{ route('print-out.fees.today-receipt-detail', ['id' => $data['student']->id]) }}" target="_blank">
                Detail Receipt: {{ number_format($data['student']->payment_today, 2) }}/-
                <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
            </a>
            <a class="label label-success label-lg white" href="{{ route('print-out.fees.today-receipt', ['id' => $data['student']->id]) }}" target="_blank">
                Receipt
                <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
            </a>
            <a class="label label-warning label-lg white receipt-alert" href="{{ route('info.smsemail.fees-receipt', ['id' => $data['student']->id]) }}">
                <i class="fa fa-send"> </i> Send Receive Alert
            </a>
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
        </div>
        <!-- div.table-responsive -->
        <form id="bulk_action_form" method="get" action="{{route('print-out.fees.selected-master-receipt')}}">
            <div class="table-responsive">
                <input type="hidden" name="studentId" value="{{ encrypt($data['student']->id) }}" class="ace" />
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead class="header">
                        <tr role="row">
                            <th class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </th>
                            <th class="sorting_disabled">Sem./Sec.</th>
                            <th class="sorting_disabled">FeeHead</th>
                            <th class="sorting_disabled">DueDate</th>
                            <th class="sorting_disabled">Amount </th>
                            <th class="sorting_disabled">PayId</th>
                            <th class="sorting_disabled">Mode</th>
                            <th class="sorting_disabled">Date</th>
                            <th class="sorting_disabled">Di </th>
                            <th class="sorting_disabled">Fi </th>
                            <th class="sorting_disabled">Paid </th>
                            <th class="sorting_disabled">Balance</th>
                            <th class="sorting_disabled">Remark</th>
                            <th class="sorting_disabled">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($data['fee_master']) && $data['fee_master']->count() > 0)
                            @foreach($data['fee_master'] as $feemaster)
                                <tr class="danger font12 odd" role="row" style="font-weight: 600;">
                                    <td class="center first-child">
                                        <label>
                                            <input type="checkbox" name="chkIds[]" value="{{ $feemaster->id }}" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </td>
                                    <td>{{ ViewHelper::getSemesterById($feemaster->semester) }}</td>
                                    <td>{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($feemaster->fee_due_date)->format('Y-m-d')}}</td>
                                    <td>{{ $feemaster->fee_amount }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $feemaster->feeCollect()->sum('discount')?$feemaster->feeCollect()->sum('discount'):"-" }}</td>
                                    <td>{{ $feemaster->feeCollect()->sum('fine')?$feemaster->feeCollect()->sum('fine'):'-' }}</td>
                                    <td>{{ $feemaster->feeCollect()->sum('paid_amount')?$feemaster->feeCollect()->sum('paid_amount'):'-' }}</td>
                                    <td>
                                        @php($net_balance = ($feemaster->fee_amount - ($feemaster->feeCollect()->sum('paid_amount') + $feemaster->feeCollect()->sum('discount')))+ $feemaster->feeCollect()->sum('fine'))
                                        {{ $net_balance?$net_balance:'-' }}
                                    </td>
                                    <td>
                                        @if($net_balance == 0)
                                            <span class="label label-success">Paid</span>
                                        @elseif($net_balance < 0 )
                                            <span class="label label-warning">Negative</span>
                                        @elseif($net_balance < $feemaster->fee_amount)
                                            <span class="label label-warning">Partial</span>
                                        @else
                                            <span class="label label-danger">Due</span>
                                        @endif
                                    </td>
                                    <td class="hidden-print">
                                        <div class="btn-group pull-right">
                                            @if($net_balance > 0)
                                            <button type="button" class="btn btn-xs btn-primary open-AddFeeDialog" data-toggle="modal"
                                                    data-target="#feeCollectionModal"
                                                    data-students-id="{{ $feemaster->students_id }}"
                                                    data-id="{{ $feemaster->id }}"
                                                    data-amount="{{ $net_balance }}"
                                                    data-head="{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}"
                                                    data-semester="{{ ViewHelper::getSemesterById($feemaster->semester) }}">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                            @endif

                                            <a class="btn btn-xs btn-primary" href="{{ route('print-out.fees.master-receipt', ['id' => $feemaster->id]) }}" target="_blank">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            @if($net_balance > 0)
                                                <a class="btn btn-xs btn-success" href="{{ route('account.fees.master.edit', ['id' => $feemaster->id]) }}" target="_blank">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                            @endif
                                                <a class="btn btn-xs btn-danger bootbox-confirm" href="{{ route('account.fees.master.delete', ['id' => $feemaster->id]) }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                        </div>
                                    </td>
                                </tr>
                                @if (isset($data['fee_collection']) && $data['fee_collection']->count() > 0)
                                    @php($i=1)
                                     @foreach($data['fee_collection'] as $fee_collection)
                                        @if($fee_collection->fee_masters_id == $feemaster->id)

                                            <tr class="white-td even" role="row" >
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><i class="fa fa-arrow-right"></i></td>
                                                <td>
                                                    <a href="#" data-toggle="popover" class="detail_popover" data-original-title="" title=""> {{ $i.' of '.$fee_collection->fee_masters_id }}</a>
                                                    <div class="fee_detail_popover" style="display: none">
                                                        <p class="text text-danger">{{ $fee_collection->note }}</p>
                                                    </div>
                                                </td>
                                                <td>{{ $fee_collection->payment_mode }}</td>
                                                <td> {{ \Carbon\Carbon::parse($fee_collection->date)->format('Y-m-d')}}</td>
                                                <td>{{ $fee_collection->discount?$fee_collection->discount:'-' }}</td>
                                                <td>{{ $fee_collection->fine?$fee_collection->fine:'-' }}</td>
                                                <td>{{ $fee_collection->paid_amount?$fee_collection->paid_amount:'-' }}</td>
                                                <td></td>
                                                <td>{{ ViewHelper::getUserNameId($fee_collection->created_by) }}</td>
                                                <td class="text text-right hidden-print">
                                                    <div class="btn-group pull-right">
                                                        <a class="btn btn-xs btn-danger bootbox-confirm" href="{{ route($base_route.'.delete', ['id' => $fee_collection->id]) }}">
                                                            <i class="fa fa-trash"> </i>
                                                        </a>
                                                        <a class="btn btn-xs btn-primary" href="{{ route('print-out.fees.collection', ['id' => $fee_collection->id]) }}" target="_blank">
                                                            <i class="fa fa-print"></i>
                                                        </a>
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
                            <td colspan="4">Total</td>
                            <td>{{ $data['student']->fee_amount }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $data['student']->discount?$data['student']->discount:'-' }}</td>
                            <td>{{ $data['student']->fine?$data['student']->fine:'-' }}</td>
                            <td>{{ $data['student']->paid_amount?$data['student']->paid_amount:'-' }}</td>
                            <td>
                                {{ $data['student']->balance?$data['student']->balance:'-' }}
                            </td>
                            <td>
                                @if($data['student']->balance == 0)
                                    <span class="label label-success">Paid</span>
                                @elseif($data['student']->balance < 0 )
                                    <span class="label label-warning">Negative</span>
                                @elseif($data['student']->balance < $data['student']->fee_amount)
                                    <span class="label label-warning">Partial</span>
                                @else
                                    <span class="label label-danger">Due</span>
                                @endif
                            </td>
                            <td class="hdidden-print"> </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </form>
    </div>
</div>