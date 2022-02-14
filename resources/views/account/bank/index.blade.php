@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
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
                        @include('includes.flash_messages')

                        @include($view_path.'.includes.buttons')

                        @include($view_path.'.includes.search_form')
                        <!-- PAGE CONTENT BEGINS -->
                            <div class="form-horizontal">
                                @include($view_path.'.includes.table')
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.jquery_validation_scripts')
    @include('includes.scripts.dataTable_scripts')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {

            /*Change Field Value on Capital Letter When Keyup*/
            $(function() {
                $('.upper').keyup(function() {
                    this.value = this.value.toUpperCase();
                });
            });
            /*end capital function*/

            function loadSemesters($this) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('student.find-semester') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        faculty_id: $this.value
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);
                        if (data.error) {
                            $.notify(data.message, "warning");
                        } else {
                            $('.semester_select').html('').append('<option value="0">Select Sem./Sec.</option>');
                            $.each(data.semester, function(key,valueObj){
                                $('.semester_select').append('<option value="'+valueObj.id+'">'+valueObj.semester+'</option>');
                            });
                        }
                    }
                });


            }

            $('#filter-btn').click(function () {

                var url = '{{ $data['url'] }}';
                var flag = false;
                var bank_name = $('input[name="bank_name"]').val();
                var ac_name = $('input[name="ac_name"]').val();
                var ac_number = $('input[name="ac_number"]').val();
                var branch = $('input[name="branch"]').val();

                if (bank_name !== '') {
                    url += '?bank_name=' + bank_name;
                    flag = true;
                }

                if (ac_name !== '') {

                    if (flag) {

                        url += '&ac_name=' + ac_name;

                    } else {

                        url += '?ac_name=' + ac_name;
                        flag = true;

                    }
                }

                if (ac_number !== '') {

                    if (flag) {

                        url += '&ac_number=' + ac_number;

                    } else {

                        url += '?ac_number=' + ac_number;
                        flag = true;

                    }
                }

                if (branch !== '') {

                    if (flag) {

                        url += '&branch=' + branch;

                    } else {

                        url += '?branch=' + branch;
                        flag = true;

                    }
                }

                location.href = url;

            });


        });

    </script>
@endsection