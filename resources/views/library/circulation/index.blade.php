@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
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
                    @include('includes.flash_messages')
                    @include('library.includes.buttons')
                        @if (isset($data['row']) && $data['row']->count() > 0)
                            @include($view_path.'.edit')
                        @else
                        {{--<div id="fromOpen">
                            <div class="btn btn-sm btn-info2" id="hideForm"><i class="fa fa-minus" aria-hidden="true"></i>&nbsp;Hide Form</div>
                            @include($view_path.'.add')
                        </div>
                        <div class="btn btn-sm btn-primary"  id="fromShow"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Circulation Setting</div>
                        <hr class="hr-double hr-10">--}}
                    @endif
                    <div class="col-md-12 col-xs-12">
                        @include($view_path.'.includes.table')
                    </div>
                </div><!-- /.row -->

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->



@endsection

@section('js')
    <!-- page specific plugin scripts -->
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.jquery_validation_scripts')
    <script>
        $(document).ready(function () {
            /*Change Field Value on Capital Letter When Keyup*/
            $(function() {
                $('.upper').keyup(function() {
                    this.value = this.value.toUpperCase();
                });
            });
            /*end capital function*/

            /*show hide form*/
            $('#fromOpen').hide();
            $('#fromShow').click(function(){
                $('#fromOpen').show();
                $('#fromShow').hide();
            });

            $('#hideForm').click(function(){
                $('#fromOpen').hide();
                $('#fromShow').show();
            });
            /*end form*/



            jqueryValidation(
                {
                    "title": {
                        required: true,
                    }
                },
                {
                    "title": {
                        required: "Please Add Title.",
                    },
                }
            );
        });
    </script>
@endsection