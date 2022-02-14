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
                        @include('library.return-over.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Return Period Over
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        {!! Form::open(['route' => 'info.smsemail.bookReturnReminder', 'id' => 'send_reminder_message']) !!}
                            <div class="clearfix">
                                <label class="label label-info arrow arrowed-right">To</label>
                                <span class="form-group">
                                    <label>{!! Form::checkbox('to[]','student' ,false, ["class" => "ace","id" => "toStudent"]) !!}<span class="lbl"> Student </span></label>
                                    <label>{!! Form::checkbox('to[]','staff' ,false, ["class" => "ace","id" => "toStaff"]) !!}<span class="lbl"> Staff</span></label>
                                </span>
                                {{--<label class="label label-info arrow arrowed-right">Reminder Type</label>
                                <span class="form-group">
                                    <label>{!! Form::radio('type[]','sms' ,false, ["class" => "ace", "id"=>"typeSms"]) !!}<span class="lbl"> SMS </span></label>
                                    <label>{!! Form::radio('type[]','email' ,false, ["class" => "ace", "id"=>"typeEmail"]) !!}<span class="lbl"> E-mail</span></label>
                                </span>--}}
                                <a class="btn-primary btn-sm message-send-btn" id=""><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Send Reminder</a>
                            </div>
                            <div class="space-4"></div>
                            <div id="user-profile-2" class="user-profile">
                                <div class="tabbable  ">
                                    <ul class="nav nav-tabs  padding-18 hidden-print ">
                                        <li class="active">
                                            <a data-toggle="tab" href="#student">
                                                <i class="green ace-icon fa fa-users bigger-140"></i>
                                                Student Return Period Over <span class="badge badge-warning"> {{ $data['student_return_over']->count() }}</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#staff">
                                                <i class="orange ace-icon fa fa-user-secret bigger-140"></i>
                                                Staff Return Period Over <span class="badge badge-warning"> {{ $data['staff_return_over']->count() }}</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content no-border padding-24">
                                        <div id="student" class="tab-pane active">
                                            @include('library.return-over.includes.student')
                                        </div><!-- /#home -->

                                        <div id="staff" class="tab-pane">
                                            @include('library.return-over.includes.staff')
                                        </div><!-- /#home -->
                                    </div>
                                </div>
                            </div>
                            <!-- PAGE CONTENT ENDS -->
                        {!! Form::close() !!}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    @include('includes.scripts.jquery_validation_scripts')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {

            /*Send Due Reminder*/
            $('.message-send-btn').click(function () {
                $student = $('#toStudent').is(':checked');
                $staff = $('#toStaff').is(':checked');
                if($student || $staff){
                    var $this = $(this);
                    var form = $('#send_reminder_message');
                    bootbox.confirm("Are you sure, You Want Send Library Clearance Message?", function(result) {
                        if(result) {
                            $('#send_reminder_message').submit();
                        }
                    });
                }else{
                    toastr.info("Please, Select Reminder Send To User Group");
                    return false;

                }
            });
            /*Due Reminder End*/

        });

    </script>
    @include('includes.scripts.delete_confirm')
@endsection