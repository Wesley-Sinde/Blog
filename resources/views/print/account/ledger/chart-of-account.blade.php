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
                            <span class="receipt-copy">CHART OF ACCOUNTS </span>
                        </div>
                        <table width="100%" class="table-bordered">
                            <thead>
                            <tr>
                                <th>TYPE</th>
                                <th>GROUP</th>
                                <th>ACCOUNT</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($data['account-group']) && $data['account-group']->count() > 0)
                                @php($i=1)
                                @foreach($data['account-group'] as $key => $type)
                                    <tr>
                                        <td class="align-top">
                                            {{$key}}
                                        </td>
                                        <td COLSPAN="2">
                                            <table class="no-border">
                                                @foreach($type as $gkey => $group )
                                                    <tr>
                                                        <td class="align-top" width="5%">{{$group->id}}</td>
                                                        <td class="align-top" width="40%">{{$group->ac_name}}</td>
                                                        <td width="60%" class="no-border">
                                                            @if($group->ledgers->count() > 0)
                                                                <table class="no-border">
                                                                    @foreach($group->ledgers as $lkey => $ledger )
                                                                        <tr>
                                                                            <td width="12%">{{$group->id}}_{{$ledger->id}}</td>
                                                                            <td class="text-left">{{$ledger->tr_head}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </table>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                    @php($i++)
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                                </tr>
                            @endif
                            </tbody>
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