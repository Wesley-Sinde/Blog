@extends('layouts.master')

@section('css')
    @include('print.includes.print-layout')
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header hidden-print">
                    <h1>
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('account.includes.buttons')
                    <div class="col-xs-12 hidden-print">
                        @include('includes.flash_messages')

                        @include('account.transaction.includes.buttons')


                        <h4 class="header large lighter blue" id="filterBox"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Filter Transaction</h4>
                        <div class="form-horizontal" id="filterDiv">
                            <div class="form-group">
                                <label for="tr_head" class="col-sm-1 control-label">Ledger</label>
                                <div class="col-sm-4">
                                    <select name="tr_head" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Ledger..." >
                                        <option value="">  </option>
                                        @foreach( $data['th'] as $key => $th)
                                            <option value="{{ $key }}">{{ $th }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {!! Form::label('acc_id', 'Group', ['class' => 'col-sm-1 control-label']) !!}
                                <div class="col-sm-5">
                                    @if(isset($data['row']))
                                        <select name="acc_id" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Group..." >
                                            <option value="">  </option>
                                            @foreach( $data['ac'] as $key => $aCat)
                                                <option value="{{ $key }}" {{ ($key == $data['row']->acc_id)?"selected":'' }}>{{ $aCat }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select name="acc_id" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Group..." >
                                            <option value="">  </option>
                                            @foreach( $data['ac'] as $key => $aCat)
                                                <option value="{{ $key }}">{{ $aCat }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <button class="btn btn-info btn-sm" type="submit" id="filter-btn">
                                    <i class="fa fa-filter"></i>
                                    Filter
                                </button>
                            </div>
                        </div>
                        <hr>


                    </div>
                    <div class="col-sm-12 align-right hidden-print">
                        <a href="#" class="btn-primary btn-lg" onclick="window.print();">
                            <i class="ace-icon fa fa-print"></i> Print
                        </a>
                    </div>
                    <div class="space-32 hidden-print"></div>
                    <div class="col-xs-12">
                    @include('print.includes.institution-detail')
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="row align-center">
                            <span class="receipt-copy">BALANCE STATEMENT OF ACCOUNTS </span>
                        </div>
                        <table width="100%" class="table-bordered">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>ACCOUNT</th>
                                <th>TYPE</th>
                                <th>Debit (+)</th>
                                <th>Credit (-)</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($data['tr_head']) && $data['tr_head']->count() > 0)
                                @php($i=1)
                                @foreach($data['tr_head'] as $key => $trHead)
                                    <tr>
                                        <td> {{ $i }}</td>
                                        <td> {{$trHead->tr_head}}</td>
                                        <td> {{ ViewHelper::getAcGroupById($trHead->acc_id) }} </td>
                                        <td class="text-right"> {{$trHead->dr_amount}}</td>
                                        <td class="text-right"> {{$trHead->cr_amount}}</td>
                                        <td class="text-right"> {{$trHead->balance}}</td>
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
                            <tr style="font-size: 14px; background: orangered;color: white; border:1px black solid; font-weight: bold">
                                <td colspan="3" align="right"><b>Grand Total:</b></td>
                                <td align="right"><b>{{isset($data['tr_head'])?$data['tr_head']->sum('dr_amount'):0}}</b></td>
                                <td align="right"><b>{{isset($data['tr_head'])?$data['tr_head']->sum('cr_amount'):0}}</b></td>
                                <td align="right"><b>{{isset($data['tr_head'])?$data['tr_head']->sum('balance'):0}}</b></td>
                            </tr>
                            </tfoot>
                        </table>
                        <div class="space-8"></div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    <script type="text/javascript">
        $('#filter-btn').click(function () {

            var url = '{{ $data['url'] }}';
            var flag = false;

            var tr_head = $('select[name="tr_head"]').val();
            var acc_id = $('select[name="acc_id"]').val();

            if (tr_head >0) {
                if (flag) {
                    url += '&tr_head=' + tr_head;
                } else {
                    url += '?tr_head=' + tr_head;
                    flag = true;
                }
            }

            if (acc_id >0) {
                if (flag) {
                    url += '&acc_id=' + acc_id;
                } else {
                    url += '?acc_id=' + acc_id;
                    flag = true;
                }
            }


            location.href = url;

        });
    </script>
@endsection