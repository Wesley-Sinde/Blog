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
                            Books Add
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('library.includes.buttons')
                    <div class="col-xs-12 ">
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                    @include('includes.validation_error_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            {!! Form::open(['route' => $base_route.'.store', 'method' => 'POST', 'class' => 'form-horizontal',
                    'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

                                @include($view_path.'.includes.form')

                            <div class="clearfix form-actions">
                                <div class="col-md-12 align-right">
                                    <button class="btn" type="reset">
                                        <i class="fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>

                                    <button class="btn btn-primary" type="submit" value="Save" name="add_book" id="add-book">
                                        <i class="fa fa-save bigger-110"></i>
                                        Save
                                    </button>

                                    <button class="btn btn-success" type="submit" value="Save" name="add_book_another" id="add-book-another">
                                        <i class="fa fa-save bigger-110"></i>
                                        <i class="fa fa-plus bigger-110"></i>
                                        Save And Add Another
                                    </button>
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

            var url = '{{ $data['url'] }}';
            $('#add-book') || $('#add-book-another').click(function () {
                console.log('ok');
                if(start == 0 || end == 0){
                    toastr.warning('Attention!, Please Enter Value Greater Than 0','Warning:');
                    false;
                }
                if(start > end){
                    toastr.warning('Attention!, Yo have enter End Value is Less than Starting. Correct It.','Warning:');
                    false;
                }

                location.href = url;
            });

           /* $('#add-book-another').click(function () {

            });*/

        });

        function changeStartCode(){
            code =  $('input[name="code"]').val();
            start =  $('input[name="start"]').val();
            end =  $('input[name="end"]').val();

            if(start == 0 || end == 0){
                //toastr.warning('Attention!, Please Enter Value Greater Than 0','Warning:');
            }
            end = parseInt(start);
            if(start == end){
                totalCopy = 1;
            }else{
                totalCopy = (end - start) + 1;
            }
            $('input[name="start_preview"]').val(code+start);
        }

        function changeEndCode(){
            code =  $('input[name="code"]').val();
            start =  $('input[name="start"]').val();
            end =  $('input[name="end"]').val();

            if(start == 0 || end == 0){
                //alert('Attention!, Please Enter Value Greater Than 0');
                toastr.warning('Attention!, Please Enter Value Greater Than 0','Warning:');
            }
            //$('#errorShow').text('');
            if(start > end){
                //alert('Attention!, Yo have enter End Value is Less than Starting. Correct It.');
                toastr.warning('Attention!, Yo have enter End Value is Less than Starting. Correct It.','Warning:');
            }
            $('#errorShow').text('');

            $(':input[type="submit"]').prop('disabled', false);
            if(start == end){
                totalCopy = 1;
            }else{
                totalCopy = (end - start) + 1;
            }

            $('input[name="end_preview"]').val(code+end);
            $('input[name="total_copy"]').val(totalCopy);
        }
    </script>
@endsection