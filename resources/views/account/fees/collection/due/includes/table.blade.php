<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue text-uppercase">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;
            Total Due: {{ number_format($data['student']->balance, 2) }} [{{ ViewHelper::convertNumberToWord($data['student']->balance ) }} ONLY]
        </h4>
      {{--  <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
        </div>--}}
        <!-- div.table-responsive -->
        {!! Form::open(['route' => 'account.fees.due.store', 'method' => 'POST', 'class' => 'form-horizontal',
                       'id' => 'bulk_action_form', "enctype" => "multipart/form-data"]) !!}
            <input type="hidden" name="students_id" value="{{ $data['student']->id }}" class="ace" />

            <div class="table-responsive">
                <table {{--id="dynamic-table"--}} class="table table-striped table-bordered table-hover">
                    <thead class="header">
                        <tr role="row">
                            <th class="sorting_disabled">Sem./Sec.</th>
                            <th class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </th>
                            <th class="sorting_disabled">FeeHead</th>
                            <th class="sorting_disabled">DueDate</th>
                            <th class="sorting_disabled">Amount </th>
                            <th class="sorting_disabled">Di </th>
                            <th class="sorting_disabled">Fi </th>
                            <th class="sorting_disabled">Paid </th>
                            <th class="sorting_disabled">Balance</th>
                            <th class="sorting_disabled">Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($data['fee_master']) && $data['fee_master']->count() > 0)
                            @foreach($data['fee_master'] as $feemaster)
                                @php($net_balance = (($feemaster->fee_amount + $feemaster->feeCollect()->sum('fine')) - (($feemaster->feeCollect()->sum('paid_amount') + $feemaster->feeCollect()->sum('discount')))))
                                <tr class="danger font12 odd" role="row" style="font-weight: 600;">
                                    <td>{{ ViewHelper::getSemesterById($feemaster->semester) }}</td>
                                    <td class="center first-child">
                                        <label>
                                            <input type="checkbox" name="balance[]" value="{{$net_balance}}" class="ace group balance" />
                                            <span class="lbl"></span>
                                        </label>
                                        <label>
                                            <input type="checkbox" name="chkIds[]" value="{{ $feemaster->id }}" class="ace label-large group" onclick="this.checked=!this.checked;"/>
                                            <span class="lbl"></span>
                                        </label>
                                    </td>
                                    <td>{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($feemaster->fee_due_date)->format('Y-m-d')}}</td>
                                    <td>{{ $feemaster->fee_amount }}</td>
                                    <td>{{ $feemaster->feeCollect()->sum('discount')?$feemaster->feeCollect()->sum('discount'):"-" }}</td>
                                    <td>{{ $feemaster->feeCollect()->sum('fine')?$feemaster->feeCollect()->sum('fine'):'-' }}</td>
                                    <td>{{ $feemaster->feeCollect()->sum('paid_amount')?$feemaster->feeCollect()->sum('paid_amount'):'-' }}</td>
                                    <td>
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
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                    <tr style="font-size: 14px; background: orangered;color: white;">
                        <td colspan="4">Total</td>
                        <td>{{ $feeAmount = $data['fee_master']->sum('fee_amount') }}</td>
                        <td>{{ $data['fee_master']->sum('discount') }}</td>
                        <td>{{ $data['fee_master']->sum('fine') }}</td>
                        <td>{{ $data['fee_master']->sum('paid_amount') }}</td>
                        <td>
                            {{ $balance = $data['fee_master']->sum('balance') }}
                            <input type="hidden" name="total_balance" value="{{ $balance }}" id="total_balance" class="ace" />
                        </td>
                        <td>
                            @if($balance == 0)
                                <span class="label label-success">Paid</span>
                            @elseif($balance < 0 )
                                <span class="label label-warning">Negative</span>
                            @elseif($balance < $feeAmount)
                                <span class="label label-warning">Partial</span>
                            @else
                                <span class="label label-danger">Due</span>
                            @endif
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            @include($view_path.'.due.includes.form')

        {!! form::close() !!}
    </div>
</div>