<div class="col-xs-12">
    <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;
        {{ strtoupper(isset($data['transactionHead'])?$data['transactionHead']->tr_head:'') }} -
        {{ strtoupper(isset($data['transactionHead'])?ViewHelper::getAcGroupById($data['transactionHead']->acc_id):'') }}
    </h4>
    <div class="clearfix">
        <span class="pull-right tableTools-container"></span>

        {!! Form::open(['route' => ['account.transaction-head.view'], 'method' => 'GET', 'class' => 'form-horizontal',
                        'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
        <div class="form-horizontal" id="filterDiv">
            <div class="form-group">
                {!! Form::hidden('tr_head', isset($data['transactionHead']->id)?$data['transactionHead']->id:'', ["class" => "input-sm form-control border-form"]) !!}
                {!! Form::label('tr_date', 'Date Range', ['class' => 'col-sm-2 control-label']) !!}
                <div class=" col-sm-4">
                    <div class="input-group ">
                        {!! Form::text('tr_start_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                        <span class="input-group-addon">
                            <i class="fa fa-exchange"></i>
                    </span>
                        {!! Form::text('tr_end_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}

                    </div>
                </div>
                <button class="btn btn-info btn-sm" type="submit">
                    <i class="fa fa-filter"></i>
                    Filter
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="table-header">
        Service Record list on table. Filter list using search box as your Wish.
    </div>
    <!-- div.table-responsive -->
    <div class="table-responsive">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead class="header">
                <tr role="row">
                    <th>S.N.</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Debit (+)</th>
                    <th>Credit (-)</th>
                    <th>Balance</th>
                </tr>
            </thead>

            @if (isset($data['transaction']) && $data['transaction']->count() > 0)
                <tbody>
                    @php($i=1)
                    @foreach($data['transaction'] as $transaction)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td align="right">{{ $transaction->dr_amount }}</td>
                            <td align="right">{{ $transaction->cr_amount }}</td>
                            @if(is_numeric($transaction->balance) && $transaction->balance >= 0)
                                <td align="right">{{ $transaction->balance }}</td>
                            @else
                                <td class="red" align="right">{{ $transaction->balance }}</td>
                            @endif
                        </tr>
                        @php($i++)
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="font-size: 14px; background: orangered;color: white;">
                        <td></td>
                        <td></td>
                        <td colspan="" align="right"><b>Grand Total:</b></td>
                        <td align="right"><b>{{$drTotal = $data['transaction']->sum('dr_amount')}}</b></td>
                        <td align="right"><b>{{$crTotal = $data['transaction']->sum('cr_amount')}}</b></td>
                        <td align="right"><b>{{ $drTotal - $crTotal }}</b></td>
                    </tr>
                </tfoot>
            @else
                <tr>
                    <td colspan="6">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                </tr>
            @endif
        </table>
    </div>
</div>
