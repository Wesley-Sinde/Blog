@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
@endsection

@section('content')

    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')

                <div class="page-header">
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
                    <div class="col-xs-12 ">
                        @include('account.transaction.includes.buttons')
                        @include('includes.flash_messages')
                        @include('includes.validation_error_messages')
                        <div class="col-md-12 col-xs-12">
                            @if (isset($data['row']) && $data['row']->count() > 0)
                                @include($view_path.'.edit')
                            @else
                                @include($view_path.'.add')
                            @endif

                        </div>
                        <div class="col-md-12 col-xs-12">
                            @include($view_path.'.includes.table')
                        </div>
                    </div>
                </div><!-- /.row -->
            </div>

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->



@endsection

@section('js')
    <!-- page specific plugin scripts -->
    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    <script type="text/javascript">
        $(document).ready(function () {
            document.getElementById('create_ledger_form').style.display = 'none';
            document.getElementById('search_ledger_form').style.display = 'none';
            /*$(function() {
                $('.upper').keyup(function() {
                    this.value = this.value.toUpperCase();
                });
            });*/
        });

        $('#create_ledger_btn').click(function () {
            document.getElementById('create_ledger_form').style.display = 'block';
            document.getElementById('search_ledger_form').style.display = 'none';
        });

        $('#search_ledger_btn').click(function () {
            document.getElementById('search_ledger_form').style.display = 'block';
            document.getElementById('create_ledger_form').style.display = 'none';
        });

        $('#filter-btn').click(function () {

            var url = '{{ $data['url'] }}';
            var flag = false;
            var tr_head = $('input[name="tr_head"]').val();
            var acc_id = $('select[name="acc_id"]').val();

            if (tr_head !== '') {
                url += '?tr_head=' + tr_head;
                flag = true;
            }

            if (acc_id !== '' && acc_id > 0) {

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
    @include('includes.scripts.dataTable_scripts')


@endsection