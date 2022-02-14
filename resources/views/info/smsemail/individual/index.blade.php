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
                            Individual Messaging
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
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                        {!! Form::open(['route' => $base_route.'.individual.send', 'method' => 'POST', 'class' => 'form-horizontal',
                                'id' => 'individual_message_send_form', "enctype" => "multipart/form-data"]) !!}
                            @include($view_path.'.individual.includes.form')
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
            /*Send Message */
            $('#individual-message-send-btn').click(function () {
                /*type*/
                $sms = $('#typeSms').is(':checked');
                $email = $('#typeEmail').is(':checked');

                /*Individual*/
                var number = $('input[name="number"]').val();
                var email = $('input[name="email"]').val();
                var subject = $('input[name="subject"]').val();

                var emailMessage = document.getElementById("summernote");
                var emailMessage = (emailMessage.value).length; // This will now contain text of textarea

                var message = document.getElementById("smsmessage");
                var message = (message.value).length; // This will now contain text of textarea

                if($sms || $email){

                    if($sms && number === ''){
                        toastr.info("Please, Fill At Least One Contact Number", "Info:");
                        return false;
                    }

                    if($sms && message < 8){
                        toastr.info("Message is Required With More Than 8 Character. When target is SMS", "Info:");
                        return false;
                    }

                    if($email && email === ''){
                        toastr.info("Please, Select Fill At Lease One Email ID", "Info:");
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
@endsection