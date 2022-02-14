@extends('user-student.layouts.master')

@section('css')
    <!-- page specific plugin styles -->
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        Assignment
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Submit
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('user-student.assignment.includes.buttons')
                    <div class="col-xs-12 ">
                    @include('includes.flash_messages')
                    @include('includes.validation_error_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        @include($view_path.'.assignment.answer.includes.preview-question')
                        <div class="form-horizontal">
                            {!! Form::open(['route' => 'user-student.assignment.answer.store', 'method' => 'POST', 'class' => 'form-horizontal',
                                'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                            {!! Form::hidden('assignments_id', $data['assignment']->id) !!}
                                @include($view_path.'.assignment.answer.includes.form')

                            <div class="clearfix form-actions">
                                <div class="col-md-12 align-right">
                                    <button class="btn" type="reset">
                                        <i class="fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn btn-info" type="submit" id="assignment-btn">
                                        <i class="fa fa-save bigger-110"></i>
                                        Submit Assignment
                                    </button>
                                </div>
                            </div>
                            <div class="hr hr-18 dotted hr-double"></div>
                            {!! Form::close() !!}
                        </div>
                        </div>
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
            $('#assignment-btn').click(function () {
                var answer = $('textarea[name="answer_text"]').val();

                if (answer == "") {
                    toastr.info("Please, Enter Your Answer", "Info:");
                    return false;
                }

            });

        });

    </script>
    @include('includes.scripts.summarnote')
@endsection