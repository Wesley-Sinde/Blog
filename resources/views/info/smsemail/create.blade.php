@extends('layouts.master')

@section('css')

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
                            Create {{ $panel }}
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('info.includes.buttons')
                    <div class="col-xs-12 ">
                    @include('info.smsemail.includes.buttons')
                    @include('includes.flash_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        @include('includes.validation_error_messages')
                        {!! Form::open(['route' => $base_route.'.send', 'method' => 'POST', 'class' => 'form-horizontal',
                        'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                            @include($view_path.'.includes.form')
                        {!! Form::close() !!}

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.email').css('display', 'none');
            /*Send Message */
            $('#group-message-send-btn').click(function () {
                /*type*/
                $sms = $('#typeSms').is(':checked');
                $email = $('#typeEmail').is(':checked');

                /*Group*/
                $role = $('.role').is(':checked');

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

                    if($role){

                    }else{
                        toastr.info("Please, Select At Least One Target Group", "Info:");
                        return false;                    }
                }else{
                    toastr.info("Please, Select Message Type", "Info:");
                    return false;
                }
            });
            /*Message End*/


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
    @include('includes.scripts.datepicker_script')
@endsection
