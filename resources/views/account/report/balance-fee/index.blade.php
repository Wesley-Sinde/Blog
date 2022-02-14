@extends('layouts.master')

@section('css')
    @include('print.includes.print-layout')
@endsection

@section('content')
    <div class="main-content A4 landscape">
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
                    <div class="col-xs-12 ">
                    @include('account.report.includes.buttons')
                    @include('includes.flash_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.includes.search_form')
                            {{--<div class="hr hr-18 dotted hr-double"></div>--}}
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="col-sm-12 align-right hidden-print">
                    <a href="#" class="btn-primary btn-lg" onclick="window.print();">
                        <i class="ace-icon fa fa-print"></i> Print
                    </a>
                </div>
                <div class="space-32 hidden-print"></div>
                @include('print.includes.institution-detail')
                @if(isset($data))
                    @include($view_path.'.includes.table')
                @endif
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection

@section('js')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#filter-btn').click(function () {
                        @include('student.includes.common-script.student_filter_common_script')

                var village = $('select[name="village"]').val();

                if (village !== '' ) {

                    if (village !== '') {

                        if (flag) {

                            url += '&village=' + village;

                        } else {

                            url += '?village=' + village;

                        }

                    }
                }

                var due_status = $('select[name="due_status"]').val();

                if (due_status !== '' ) {

                    if (due_status !== 'all') {

                        if (flag) {

                            url += '&due_status=' + due_status;

                        } else {

                            url += '?due_status=' + due_status;

                        }

                    }
                }
                location.href = url;
            });

            /*Send Due Reminder*/

            $('table th input:checkbox').on('click' , function(){
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

            });

            $('.message-send-btn').click(function () {
                $chkIds = document.getElementsByName('chkIds[]');
                var $chkCount = 0;
                $length = $chkIds.length;

                for(var $i = 0; $i < $length; $i++){
                    if($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked){
                        $chkCount++;
                    }
                }

                if($chkCount <= 0){
                    toastr.info("Please, Select At Least One Record.","Info:");
                    return false;
                }

                var $this = $(this);
                var form = $('#send_reminder_message');

                bootbox.confirm("You are selected "+$chkCount+" Recored. Are you sure, You Want Send Due Reminder Message?", function(result) {
                    if(result) {
                        $('#send_reminder_message').submit();
                    }
                });
            });


            $('.bulk-due-slip').click(function () {
                $chkIds = document.getElementsByName('chkIds[]');
                var $chkCount = 0;
                $length = $chkIds.length;
                student = new Array();

                for(var $i = 0; $i < $length; $i++){
                    if($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked){
                        student[$i] = $chkIds[$i].value;
                        $chkCount++;
                    }
                }

                if ($chkCount <= 0) {
                    toastr.info("Please, Select At Least One Record.", "Info:");
                    return false;
                }

                student = student.filter(function (t) {
                    return (t !== (undefined || null || ''));
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('print-out.fees.bulk-due-detail-slip') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        student:student
                    },
                    success: function (response) {
                        toastr.info("ok");
                        /* var w = window.open();
                         $(w.document.body).html(response);*/
                        //var w = window.open();
                        //Append Search unordered list
                        //var newWindow = window.open("", "new window", "width=200, height=100");
                        //var newWindow = window.open("", "new window", "width=900, height=1000");
                        document.write(response);
                        //window.open(document.write(response));
                        //var newWindow = window.open(response, '_blank');
                        //write the data to the document of the newWindow
                        //newWindow.document.write(response);
                        //newWindow.print();
                    }
                });


            });

            $('.short-due-slip').click(function () {
                $chkIds = document.getElementsByName('chkIds[]');
                var $chkCount = 0;
                $length = $chkIds.length;
                student = new Array();

                for(var $i = 0; $i < $length; $i++){
                    if($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked){
                        student[$i] = $chkIds[$i].value;
                        $chkCount++;
                    }
                }

                if ($chkCount <= 0) {
                    toastr.info("Please, Select At Least One Record.", "Info:");
                    return false;
                }

                student = student.filter(function (t) {
                    return (t !== (undefined || null || ''));
                });


                $.ajax({
                    type: 'POST',
                    url: '{{ route('print-out.fees.bulk-due-slip') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        student:student
                    },
                    success: function (response) {
                        toastr.info("ok");
                        /* var w = window.open();
                         $(w.document.body).html(response);*/
                        //var w = window.open();
                        //Append Search unordered list
                        //var newWindow = window.open("", "new window", "width=200, height=100");
                        //var newWindow = window.open("", "new window", "width=900, height=1000");
                        document.write(response);
                        //window.open(document.write(response));
                        //var newWindow = window.open(response, '_blank');

                        //write the data to the document of the newWindow
                        //newWindow.document.write(response);
                        //newWindow.print();
                    }
                });


            });
            /*Due Reminder End*/

            $('#load-fee-html').click(function () {

                $.ajax({
                    type: 'POST',
                    url: '{{ route('account.fees.master.fee-html') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);

                        if (data.error) {
                            //$.notify(data.message, "warning");
                        } else {

                            $('#fee_wrapper').append(data.html);
                            $(document).find('option[value="0"]').attr("value", "");
                            //$(document).find('option[value="0"]').attr("disabled", "disabled");
                            //$.notify(data.message, "success");
                        }
                    }
                });

            });

        });

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
    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.datepicker_script')
@endsection