@extends('layouts.master')

@section('css')
    <style>
        @page {
            /* margin-top: 5cm;
             margin-bottom: 5cm;*/
        }

        span.receipt-copy {
            font-family:'Alfa+Slab+One';
            font-size: 22px;
            font-weight: 600;
            /*background: #438EB9;
            color: white;*/
            padding: 3px 15px;
        }

       /* .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
            border: 1px solid #444 !important;
            padding: 0px 3px 0px 5px;
        }
*/

        @media print {

            body {
                margin-top: 6mm; margin-bottom: 6mm;
                margin-left: 12.7mm; margin-right: 6mm
            }

            @page{
                /*margin-left: 100px !important;*/
                /* margin: 500px !important;*/
            }

            .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
                border: 0.5px solid #7e7d7d1c !important;

            }

            span.receipt-copy {
                font-size: 22px;
                font-weight: 600;
                /*background: black;
                color: white;*/
                padding: 3px 15px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header hidden-print">
                    <h1>
                        Student
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                    @include('includes.validation_error_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="space-2"></div>

                        <div id="user-profile-2" class="user-profile">
                            <div class="tabbable">
                                <ul class="nav nav-tabs  padding-18 hidden-print ">
                                    <li class="active">
                                        <a data-toggle="tab" href="#profile">
                                            <i class="green ace-icon fa fa-user bigger-140"></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#academicInfo">
                                            <i class="green ace-icon fa fa-university bigger-140"></i>
                                            Academic
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#fees">
                                            <i class="orange ace-icon fa fa-calculator bigger-140"></i>
                                            Fees
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#library">
                                            <i class="purple ace-icon fa fa-book bigger-140"></i>
                                            Library
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#attendance">
                                            <i class="blue ace-icon fa fa-calendar bigger-140"></i>
                                            Attendance
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#examscore">
                                            <i class="blue ace-icon fa fa-line-chart bigger-140"></i>
                                            Exam
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#certificate">
                                            <i class="blue ace-icon fa fa-certificate bigger-140"></i>
                                            Certificate
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#hostel">
                                            <i class="blue ace-icon fa fa-bed bigger-140"></i>
                                            Hostel
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#transport">
                                            <i class="blue ace-icon fa fa-car bigger-140"></i>
                                            Transport
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#documents">
                                            <i class="pink ace-icon fa fa-files-o bigger-140"></i>
                                            Docs
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#notes">
                                            <i class="red ace-icon fa fa-sticky-note-o bigger-140"></i>
                                            Notes
                                        </a>
                                    </li>
                                    @ability('super-admin', 'user-add')
                                    <li>
                                        <a data-toggle="tab" href="#login-access">
                                            <i class="red ace-icon fa fa-key bigger-140"></i>
                                            Login Access
                                        </a>
                                    </li>
                                    @endability

                                </ul>

                                <div class="tab-content no-border padding-24">
                                        <div id="profile" class="tab-pane in active">
                                            <div class="row text-center">
                                                @include('print.includes.institution-detail')
                                                <h2 class="no-margin-top text-uppercase" style="font-family: 'Bowlby+One+SC'; font-size: 30px; font-weight: 600">
                                                    <strong>REGISTRATION DETAIL</strong>
                                                </h2>
                                            </div>
                                            <hr class="hr-double hr-8">
                                           @include($view_path.'.detail.includes.profile')
                                        </div><!-- /#home -->

                                        <div id="academicInfo" class="tab-pane">
                                            @include($view_path.'.detail.includes.academicInfo')
                                        </div><!-- /#AcademicInfo -->

                                        <div id="fees" class="tab-pane">
                                            @include($view_path.'.detail.includes.fees')
                                        </div><!-- /#home -->

                                        <div id="library" class="tab-pane">
                                            @include($view_path.'.detail.includes.library')
                                        </div><!-- /#Library -->

                                        <div id="attendance" class="tab-pane">
                                            @include($view_path.'.detail.includes.attendance')
                                        </div><!-- /#attendance -->

                                        <div id="examscore" class="tab-pane">
                                            @include($view_path.'.detail.includes.examscore')
                                        </div><!-- /#examscore -->

                                        <div id="certificate" class="tab-pane">
                                            @include($view_path.'.detail.includes.certificate')
                                        </div><!-- /#certificate -->

                                        <div id="hostel" class="tab-pane">
                                            @include($view_path.'.detail.includes.hostel')
                                        </div><!-- /#Hostel -->

                                        <div id="transport" class="tab-pane">
                                            @include($view_path.'.detail.includes.transport')
                                        </div><!-- /#Transport -->

                                        <div id="documents" class="tab-pane">
                                            @include($view_path.'.detail.includes.documents')
                                        </div><!-- /#Documents -->

                                        <div id="notes" class="tab-pane">
                                            @include($view_path.'.detail.includes.notes')
                                        </div><!-- /#Notes -->
                                        @ability('super-admin', 'user-add')
                                        <div id="login-access" class="tab-pane">
                                            @include($view_path.'.detail.includes.login-access')
                                        </div><!-- /#Login Detail -->
                                        @endability
                                    </div>
                            </div>

                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    </div>
@endsection

@section('js')
    <script>
        $('.bulk-action-btn').click(function () {
            $chkIds = document.getElementsByName('chkIds[]');
            var $chkCount = 0;
            $length = $chkIds.length;
            for (var $i = 0; $i < $length; $i++) {
                if ($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked) {
                    $chkCount++;
                }
            }

            if ($chkCount <= 0) {
                toastr.info("Please, Select At Least One Record.", "Info:");
                return false;
            }

            var $this = $(this);
            var bulk_action = $this.attr('attr-action-type');
            var form = $('#bulk_action_form');
            $('#bulk_action_form').submit();

        });
    </script>
    <!-- inline scripts related to this page -->
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    {{--@include('includes.scripts.paymentgateway.khalti')--}}
@endsection