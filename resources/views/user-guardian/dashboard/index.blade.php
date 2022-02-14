@extends('user-guardian.layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('user-guardian.layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        Dashboard
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Guardian
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12 ">
                        @include('includes.flash_messages')
                        @include('user-guardian.dashboard.includes.notice')

                    </div>
                    <div class="col-xs-12 ">
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
                                    <li>
                                        <a data-toggle="tab" href="#login-access">
                                            <i class="red ace-icon fa fa-key bigger-140"></i>
                                            Login Access
                                        </a>
                                    </li>

                                </ul>

                                <div class="tab-content no-border padding-24">
                                    <div id="profile" class="tab-pane in active">
                                        @include('user-guardian.dashboard.includes.profile')
                                    </div><!-- /#home -->

                                    <div id="login-access" class="tab-pane">
                                        @include('user-guardian.dashboard.includes.login-access')
                                    </div><!-- /#Login Detail -->

                                </div>
                            </div>

                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->

                    <div class="col-md-12">


                        <div class="row">
                            <div class="col-md-2">
                                <a href="{{ route('user-guardian.students') }}" class="easy-link-menu">
                                    <div class="dash-card card-softred text-xs-center">
                                        <div class="card-block">
                                            <h4 class="card-title">
                                                {{ $data['students']->count() }}
                                            </h4>
                                            <p class="card-text"><i class="ace-icon fa fa-users"></i> Students</p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                        @if(isset($data['feeCompare']))
                        <div class="row">
                            <div class="col-md-12">
                                <div>{!! $data['feeCompare']->container() !!}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    </div><!-- /.row -->
                <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    </div>
@endsection

@section('js')

<!-- page specific plugin scripts -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js" charset="utf-8"></script>
@if(isset($data['feeCompare']))
 {!! $data['feeCompare']->script() !!}
@endif
@endsection