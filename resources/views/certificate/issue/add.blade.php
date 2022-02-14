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
                        @include($view_path.'.issue.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Add Fees
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('certificate.includes.buttons')
                    <div class="col-xs-12 ">
                        {{--@include('certificate.fees.includes.buttons')--}}
                        @include('includes.flash_messages')
                        <h4 class="header large lighter blue"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search & Verify Student Before Issue Certificate</h4>
                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::select('students_id', [], null, ["placeholder" => "Type Student Name | Reg.No. | Mobile | Email...", "class" => "col-xs-12 col-sm-12", "style" => "width: 100%;"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'students_id'])

                                <hr>
                                <div class="align-right">
                                    <button type="button" class="btn btn-sm btn-primary" id="load-html-btn">
                                        <i class="fa fa-user bigger-120"></i> Verify Student
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="space-4"></div>

                        @include('certificate.issue.includes.form')


                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {

            /*date*/
           /* var today = new Date();
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
            $("#date").val( today );*/

            /*Find Student*/
            $('select[name="students_id"]').select2({
                placeholder: 'Search Student...',
                ajax: {
                    url: '{{ route('student.student-name-autocomplete') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            /*Student Verify*/
            $('#load-html-btn').click(function () {
                $('#student_wrapper').empty();
                var students_id = $('select[name="students_id"]').val();
                if (!students_id)
                    toastr.warning("Please, Choose Student.", "Warning");
                else {

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('certificate.student-detail-html') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: students_id
                        },
                        success: function (response) {
                            var data = $.parseJSON(response);

                            if (data.error) {
                            } else {

                                $('#student_wrapper').append(data.html);
                            }
                        }
                    });

                }
            });


        });

    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.datepicker_script')

@endsection