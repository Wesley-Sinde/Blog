@extends('layouts.master')
@section('css')
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
    @endsection
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    @include('includes.flash_messages')
                    @include('dashboard.includes.notice')
                    @include('dashboard.includes.buttons')
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                        {{--Chart Begans--}}
                            @role(['super-admin','admin','account'])
                                <div class="row">
                                    <div class="col-md-10">
                                        <div>{!! $data['feeSalaryChart']->container() !!}</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>{!! $data['feeCompare']->container() !!}</div>
                                    </div>
                                    <div class="col-md-12">
                                        <div>{!! $data['transactionChart']->container() !!}</div>
                                    </div>
                                </div>
                            @endrole
                        {{--chart end--}}

                        <div class="row">
                            <div class="col-sm-9">
                                @role(['super-admin','admin','account'])
                                    @include('dashboard.includes.account')
                                @endrole
                                @role(['super-admin','admin','library'])
                                    @include('dashboard.includes.library')
                                @endrole
                                @role(['super-admin','admin'])
                                @include('dashboard.includes.attendance')
                                @endrole
                                @include('dashboard.includes.birthday')
                            </div><!-- /.col -->
                            <div class="col-sm-3">
                                @include('dashboard.includes.summary')
                            </div><!-- /.col -->
                            {{--Faculty wise Student Status Summary--}}
                        </div>

        </div><!-- /.row -->
        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->
@endsection
@section('js')
<!-- page specific plugin scripts -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js" charset="utf-8"></script>
 {!! $data['feeSalaryChart']->script() !!}
 {!! $data['feeCompare']->script() !!}
 {!! $data['transactionChart']->script() !!}
@endsection