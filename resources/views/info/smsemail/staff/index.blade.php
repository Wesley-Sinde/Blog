@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    @include('includes.css.summarnote')
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
                            Staff Message
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('info.includes.buttons')
                    <div class="col-xs-12 ">
                    @include('info.smsemail.includes.buttons')
                    @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.staff.includes.search_form')
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                        {!! Form::open(['route' => $base_route.'.staff.send', 'method' => 'POST', 'class' => 'form-horizontal',
                                'id' => 'group_message_send_form', "enctype" => "multipart/form-data"]) !!}
                            @include($view_path.'.staff.includes.form')
                            @include($view_path.'.staff.includes.table')
                        {!! Form::close() !!}
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#filter-btn').click(function () {
                @include('staff.includes.common.staff_filter_common_script')
                    location.href = url;
            });

            /*Send Message */
            $('#group-message-send-btn').click(function () {
                /*type*/
                $sms = $('#typeSms').is(':checked');
                $email = $('#typeEmail').is(':checked');


                var subject = $('input[name="subject"]').val();
                var emailMessage = document.getElementById("summernote");
                var emailMessage = (emailMessage.value).length; // This will now contain text of textarea

                var message = document.getElementById("smsmessage");
                var message = (message.value).length; // This will now contain text of textarea

                if($sms || $email){
                    if($sms && message < 8){
                        toastr.info("Message is Required With More Than 8 Character. When target is SMS", "Info:");
                        return false;
                    }

                    if($email && subject === ''){
                        toastr.info("Subject is Required. When target is Email", "Info:");
                        return false;
                    }

                    if($email && emailMessage < 12){
                        toastr.info("Message is Required With More Than 12 Character. When target is SMS", "Info:");
                        return false;
                    }

                    /*Check Student List Select Or not*/
                    $chkIds = document.getElementsByName('chkIds[]');
                    var $chkCount = 0;
                    $length = $chkIds.length;

                    for (var $i = 0; $i < $length; $i++) {
                        if ($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked) {
                            $chkCount++;
                        }
                    }

                    if ($chkCount <= 0) {
                        toastr.info("Please, Select At Least One Staff Record.", "Info:");
                        return false;
                    }

                }else{
                    toastr.info("Please, Select Message Type", "Info:");
                    return false;
                }

            });
            /*Message End*/
            $('.email').css('display', 'none');


            $("#smsmessage").keyup(function(){
                $("#count").text("Length: "+ $(this).val().length);
            });
        });



        function messageTypeCondition(f) {
            //alert('ok');
            $sms = $('#typeSms').is(':checked');
            $email = $('#typeEmail').is(':checked');
            if($sms) {
                $('.email').css('display', 'none');
                $('.sms').css('display', 'block');
            }

            if($email) {
                $('.email').css('display', 'block');
                $('.sms').css('display', 'none');
            }

        }

    </script>
    @include('includes.scripts.summarnote')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.dataTable_scripts')
@endsection