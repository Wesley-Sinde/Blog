<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>
            @if(isset($generalSetting->institute))
                {{ $panel }} | {{$generalSetting->institute}}
            @else
                {{ isset($panel)?$panel:'' }} | UNLIMITED Edu Firm
            @endif
        </title>

        <meta name="description" content="top menu &amp; navigation" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        @if(isset($generalSetting->favicon))
            <link rel="icon" href="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$generalSetting->favicon ) }}" type="image/x-icon" />
        @endif

    <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}" />

        <!-- text fonts -->
        <link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />

        <!-- ace styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

        <!--[if lte IE 9]>
        <link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
        <![endif]-->
        <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />

        <!-- inline styles related to this page -->

        <!--[if lte IE 9]>
        <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
        <![endif]-->

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />

        <!-- ace settings handler -->
        <script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
        <script src="{{ asset('assets/js/respond.min.js') }}"></script>
        <![endif]-->

        <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/nepali.datepicker.v2.2.min.css') }}" />

        <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet">
        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
        <link href="https://fonts.googleapis.com/css?family=Fugaz+One|Lobster|Merienda|Righteous|Black+Ops+One|Gilda+Display" rel="stylesheet">
        @yield('css')

        @yield('top-script')

    </head>

    <body class="no-skin">
    {{--Preloader Css--}}
    {{--<style>
        #overlay {
            background: #E4E6E9;
            color: #666666;
            position: fixed;
            height: 100%;
            width: 100%;
            z-index: 1000;
            top: 0;
            left: 0;
            float: left;
            text-align: center;
            padding-top: 25%;
            font-size: 4em;
        }
    </style>
    <div id="overlay">
        <i class="ace-icon fa fa-spinner fa-spin blue bigger-125"></i>
    </div>--}}

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try{ace.settings.loadState('main-container')}catch(e){}
        </script>


        <div class="main-content">
            <div class="main-content-inner">
                <div class="page-content">

                    {{--<div class="page-header">
                        <h1>
                            @include($view_path.'.includes.breadcrumb-primary')
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                Registration
                            </small>
                        </h1>
                    </div><!-- /.page-header -->--}}

                    <div class="row">
                        <div class="col-xs-12 ">
                        <!-- PAGE CONTENT BEGINS -->
                            <div class="row">
                                <div class="col-md-2 col-print-2 align-left">
                                    @if(isset($generalSetting->logo))
                                        <img id=""  src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$generalSetting->logo) }}" width="200" >
                                    @endif
                                </div>
                                <div class="col-md-10 col-print-10 align-right">
                                    <div class="text-center">
                                        <h2 class="no-margin-top text-uppercase" style="font-family: 'Merienda', cursive; font-size: 30px">
                                            <strong>{{isset($generalSetting->institute)?$generalSetting->institute:"EduFirm Web Portal Online Registration"}}</strong>
                                        </h2>
                                        <h5 class="no-margin-top">
                                            {{isset($generalSetting->address)?$generalSetting->address:""}}, {{isset($generalSetting->phone)?$generalSetting->phone:""}}, {{isset($generalSetting->email)?$generalSetting->email:""}}
                                        </h5>
                                        <h3 class="text-uppercase no-margin-top" style="font-family: 'Righteous', cursive; font-size: 35px">ONLINE APPLICATION FOR ADMISSION</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix hidden-print align-right">
                                <div class="easy-link-menu">
                                    <a class="btn-primary btn-sm" href="{{ route('login') }}"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Login</a>
                                </div>
                                <hr class="hr-6 ">
                            </div>

                            @include('includes.validation_error_messages')
                            @include('includes.flash_messages')
                            {!! Form::open(['route' => 'student.public-registration.register', 'method' => 'POST', 'class' => 'form-horizontal',
                            'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

                            @include($view_path.'.includes.form')

                            <div class="clearfix form-actions">
                                <div class="col-md-12 align-right">
                                    <button class="btn" type="reset">
                                        <i class="fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>

                                    <button class="btn btn-primary" type="submit" value="Save" name="add_student" id="add-student">
                                        <i class="fa fa-save bigger-110"></i>
                                        Register
                                    </button>
                                </div>
                            </div>

                            <div class="hr hr-24"></div>

                            {!! Form::close() !!}

                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div>
        </div><!-- /.main-content -->

        <div class="footer">
            <div class="footer-inner hidden-print">
                <div class="footer-content">
                <span class="bigger-120">
                    <span class="blue bolder">
                        @if(isset($generalSetting->copyright))
                            {!! $generalSetting->copyright !!}
                        @else
                            <a href="http://businesswithtechnology.com" target="_blank">©BusinessWithTechnology</a>
                        @endif
                    </span>
                </span>

                    {{--<span class="action-buttons">
                        <a href="#">
                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                        </a>

                        <a href="#">
                            <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                        </a>

                        <a href="#">
                            <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                        </a>
                    </span>--}}
                </div>
            </div>
            {{--<footer class="onlyprint">footer text for print<!--Content Goes Here--></footer>--}}
        </div>

        <!-- basic scripts -->
        <!--[if !IE]> -->
        <script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>
        {{--<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>--}}
    <!-- <![endif]-->

        <!--[if IE]>
        <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
        <![endif]-->

        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('assets/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
        </script>

        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

        {{--<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>--}}

        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>



        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- page specific plugin scripts -->
    <!-- ace scripts -->
    <script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
    <script src="{{ asset('assets/js/ace.min.js') }}"></script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
    </script>


    {{--PReloader JS--}}
    <script>
        $(document).ready(function () {
            jQuery('#overlay').fadeOut("fast");



            $('#add-student').click(function () {
                var password = $('input[name="password"]').val();
                var confirmPassword = $('input[name="confirmPassword"]').val();

                if (password != confirmPassword) {
                    toastr.warning('Password & Confirm Password Must be Same.');
                    return false;
                }

            });
        });


    </script>
    @include('student.public-registration.includes.student-comman-script')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.datepicker_script')

    </body>
</html>
