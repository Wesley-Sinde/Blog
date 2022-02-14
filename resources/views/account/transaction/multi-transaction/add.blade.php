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
                            Multi Transaction
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('account.includes.buttons')
                    <div class="col-xs-12 ">
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                    @include('includes.validation_error_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            {!! Form::open(['route' => $base_route.'.multi-store', 'method' => 'POST', 'class' => 'form-horizontal',
                    'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                            <div class="hr hr-18 dotted hr-double"></div>
                            @include('account.transaction.multi-transaction.includes.form')

                            <div class="clearfix form-actions">
                                <div class="col-md-12 align-center">
                                    <button class="btn" type="reset">
                                        <i class="fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                    <button class="btn btn-primary" type="submit" value="Save" name="add_transaction" id="add-transaction">
                                        <i class="fa fa-save bigger-110"></i>
                                        Save
                                    </button>

                                    <button class="btn btn-success" type="submit" value="Save" name="add_transaction_another" id="add-transaction-another">
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


            </div><!-- /.row -->

        </div><!-- /.page-content -->
    </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.datepicker_script')
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

        });

        $(document).ready(function () {

            $('#load-transaction-html').click(function () {
                insertNewRow();
            });



            $('#sample-table-1').on('click','tr:last',function(){
                copyLastRow();
            });

            $('#sample-table-1').on('focus','tr:last',function(e){
                //copyLastRow();

            });

            function copyLastRow(){
                var $tableBody = $('#sample-table-1').find("tbody"),
                    $trLast = $tableBody.find("tr:last"),
                    $trNew = $trLast.clone();
                $trLast.after($trNew);

            }

            function insertNewRow(){
                $.ajax({
                    type: 'POST',
                    url: '{{ route('account.multi-transaction.tr-html') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);

                        if (data.error) {
                            //$.notify(data.message, "warning");
                        } else {

                            $('#transaction_wrapper').append(data.html);
                            $(document).find('option[value="0"]').attr("value", "");
                        }
                    }
                });
            }

        });

    </script>
@endsection