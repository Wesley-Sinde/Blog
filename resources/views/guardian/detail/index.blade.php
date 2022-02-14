@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header hidden-print">
                    <h1>
                        Guardian
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
                            <div class="tabbable  ">
                                    <ul class="nav nav-tabs  padding-18 hidden-print ">
                                        <li class="active">
                                            <a data-toggle="tab" href="#profile">
                                                <i class="green ace-icon fa fa-user bigger-140"></i>
                                                Profile
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
                                           @include($view_path.'.detail.includes.profile')
                                           @include($view_path.'.detail.includes.students')
                                        </div><!-- /#home -->

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
    <!-- inline scripts related to this page -->
    @include('includes.scripts.delete_confirm')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            /*link guardian*/
            $('select[name="student_link_id"]').select2({
                placeholder: 'Select Student...',
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
        });

    </script>

@endsection