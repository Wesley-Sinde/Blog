@extends('layouts.master')

@section('css')
    <style type="text/css">
        element.style {
            width: auto !important;
        }
    </style>
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
                            Receive Selected Due Fee
                        </small>
                    </h1>

                </div><!-- /.page-header -->

                <div class="row">
                    @include('account.includes.buttons')
                    <div class="col-xs-12 ">
                        @include('account.fees.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.collect.includes.profile')
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                @include($view_path.'.due.includes.table')
            </div>
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection

@section('js')
    @include('includes.scripts.jquery_validation_scripts')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.alert_confirm')
    @include('includes.scripts.delete_confirm')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function(){
            $(".balance").change(function() {
                var total = 0;
                var table_abc = document.getElementsByClassName("balance");
                for (var i = 0; table_abc[i]; ++i) {
                    feeMasterIds = $(this).attr("data-id");
                    if (table_abc[i].checked) {
                        total += parseInt(table_abc[i].value);
                    }else{

                    }
                    document.getElementById("receive_amount").value = total;
                    document.getElementById("receive_amount_temp").value = total;
                }
            });


            $('table th input:checkbox').on('click' , function(){
                var that = this;
                $(this).closest('table').find('input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        //$(this).closest('tr').toggleClass('selected');
                        document.getElementById("receive_amount_temp").value = document.getElementById("total_balance").value;
                        document.getElementById("receive_amount").value = document.getElementById("total_balance").value;
                    });
            });

            $('.group').on('click' , function(){
                var that = this;
                $(this).closest('tr').find('input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        //$(this).closest('tr').toggleClass('selected');
                    });

            });


            /*Fees Verification */
            $('#add-collection').click(function () {
                $chkIds = document.getElementsByName('chkIds[]');
                var $chkCount = 0;
                $length = $chkIds.length;

                for(var $i = 0; $i < $length; $i++){
                    if($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked){
                        $chkCount++;
                    }
                }

                if($chkCount <= 0){
                    toastr.info("Please, Select At Least One Due Record.","Info:");
                    return false;
                }

                var totalBalance = parseInt(document.getElementById("receive_amount_temp").value);
                var receiveAmount = parseInt(document.getElementById("receive_amount").value);
                var fineAmount = parseInt(document.getElementById("fine_amount").value);
                var discountAmount = parseInt(document.getElementById("discount_amount").value);
                $setValue = ($receiveAmount - $discountAmount) + $fineAmount;
                var date = $('input[name="date"]').val();

                if($receiveAmount <= 0){
                    toastr.warning('Set Receive Amount Or Fine Amount Or Discount Amount with any Due Heads','Warning:');
                    return false;
                }else{
                    if(!date){
                        toastr.warning('Enter Receive Date.','Warning:');
                        return false;
                    }

                    if(receiveAmount == 0 && fineAmount == 0 && discountAmount == 0){
                        toastr.warning('Please Enter Receive/Fine/Discount Amount Greater than 0.','Warning:');
                        return false;
                    }

                    var status = totalBalance - receiveAmount;

                    if(status < 0){
                        toastr.warning('Student Due Amount is '+totalBalance+'/-. You want to Collect Amount '+receiveAmount+'/- . Greater Than Due Amount.', "Warning");
                        return false;
                    }
                }
            });

        });

        /*function calculateReceiveAmount() {
            $receiveAmount = parseInt(document.getElementById("receive_amount").value);
            $receiveAmountTemp = parseInt(document.getElementById("receive_amount_temp").value);
            if($receiveAmount > 0) {
                $fineAmount = parseInt(document.getElementById("fine_amount").value);
                $discountAmount = parseInt(document.getElementById("discount_amount").value);
                $setValue = ($receiveAmountTemp - $discountAmount) + $fineAmount;
                document.getElementById("receive_amount").value = $setValue;
            }
        }*/
    </script>
    {{--@include('includes.scripts.dataTable_scripts')--}}
    @include('includes.scripts.datepicker_script')
@endsection