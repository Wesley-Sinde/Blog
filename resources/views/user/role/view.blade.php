@extends('admin.layout.master')

@section('css')

    <link rel="stylesheet" href="{{ asset('admin-panel/assets/css/datepicker.css') }}" />

@endsection

@section('content')

    <div class="main-content">

        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>

            <ul class="breadcrumb">
                @include($view_path.'.includes.breadcrumb-primary')
                <li class="active">List</li>
            </ul><!-- .breadcrumb -->


        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    {{ $panel }} Manager
                    <small>
                        <i class="icon-double-angle-right"></i>
                        View
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    @if (Gate::allows('accessUserManager', auth()->user()))
                        <a href="{{ route($base_route) }}" class="btn btn-xs btn-info">
                            <i class="icon-backward bigger-120"></i>&nbsp;Go back
                        </a>
                        <a href="{{ route($base_route.'.add') }}" class="btn btn-xs btn-info">
                            <i class="icon-plus bigger-120"></i>&nbsp;Add {{ $panel }}
                        </a>
                    @endif    

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th width="20%">Column</th>
                                        <th>Value</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>Id</td>
                                        <td>{{ $data['row']->id }}</td>
                                    </tr>

                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $data['row']->name }}</td>
                                    </tr>

                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $data['row']->email }}</td>
                                    </tr>

                                    <tr>
                                        <td>Profile Image</td>
                                        <td>
                                            @if ($data['row']->profile_image)
                                                <img src="{{ asset('images/'.$folder_name.'/150_150_'.$data['row']->profile_image) }}">
                                            @else
                                                <p>No image</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $data['row']->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Contact Number</td>
                                        <td>{{ $data['row']->contact_number }}</td>
                                    </tr>

                                    <tr>
                                        <td>Create at</td>
                                        <td>{{ $data['row']->created_at }}</td>
                                    </tr>

                                    <tr>
                                        <td>Last updated at</td>
                                        <td>{{ $data['row']->last_updated_at }}</td>
                                    </tr>

                                    <tr>
                                        <td>Created by</td>
                                        <td>{{ $data['row']->created_by }}</td>
                                    </tr>

                                    <tr>
                                        <td>Last updated by</td>
                                        <td>{{ $data['row']->last_updated_by }}</td>
                                    </tr>

                                    <tr>
                                        <td>Status</td>
                                        <td>{{ $data['row']->status?'Active':'Inactive' }}</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div><!-- /.table-responsive -->
                        </div><!-- /span -->
                    </div><!-- /row -->

                    <div class="hr hr-18 dotted hr-double"></div>


                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div><!-- /.main-content -->

@endsection


@section('js')

    <script type="text/javascript">
        jQuery(function($) {

            $('table th input:checkbox').on('click' , function(){
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

            });

        })
    </script>

@endsection