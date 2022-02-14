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
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                        @include('staff.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                            @include('includes.validation_error_messages')
                        <div class="col-md-4 col-xs-12">
                            @if (isset($data['row']) && $data['row']->count() > 0)
                                @include($view_path.'.edit')
                            @else
                                @include($view_path.'.add')
                            @endif
                        </div>

                        <div class="col-md-8 col-xs-12">
                            @include($view_path.'.includes.table')
                        </div>
                    </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

@endsection

@section('js')
    <!-- page specific plugin scripts -->
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')

@endsection