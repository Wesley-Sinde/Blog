@extends('layouts.master')

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
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Add
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    @include('certificate.includes.buttons')
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                    @include('includes.validation_error_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="space-8"></div>
                        <div class="form-horizontal">
                            {!! Form::model($data['row'], ['route' => $base_route.'.store', 'method' => 'POST', 'class' => 'form-horizontal',
                                'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

                                @include($view_path.'.includes.form')

                                <div class="clearfix form-actions">
                                    <div class="col-md-12 align-right">
                                        <div class="col-md-12 align-right">
                                            {{--<button class="btn" type="reset">
                                                <i class="fa fa-undo bigger-110"></i>
                                                Reset
                                            </button>--}}
                                            <button class="btn btn-primary" type="submit" value="Issue" name="issue_certificate" id="issue-certificate">
                                                <i class="fa fa-save bigger-110"></i>
                                                Issue {{$panel}}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="hr hr-18 dotted hr-double"></div>
                            {!! Form::close() !!}
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    @include('includes.scripts.inputMask_script')

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

            //date
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!

            var yyyy = today.getFullYear();
            if(dd<10){
                dd='0'+dd;
            }
            if(mm<10){
                mm='0'+mm;
            }
            var today = yyyy +'-'+mm+'-'+ dd;
            $("#date_of_issue").val( today );
            $(".date_of_issue").val( today );
            /*enddate*/


        });

    </script>

    @include('includes.scripts.datepicker_script')
@endsection