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
                            Profile
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                        @include('includes.flash_messages')

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
                                    <td>Profile Image</td>
                                    <td>
                                        @if ($data['row']->profile_image)
                                            <img src="{{ asset('images/user/'.$data['row']->profile_image) }}" width="150px">
                                        @else
                                            <p>No image</p>
                                        @endif
                                    </td>
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
                                    <td>Address</td>
                                    <td>{{ $data['row']->address }}</td>
                                </tr>
                                <tr>
                                    <td>Contact Number</td>
                                    <td>{{ $data['row']->contact_number }}</td>
                                </tr>

                                <tr>
                                    <td>Password</td>
                                    <td>
                                        <div id="show-password-change"><button class="btn btn-sm btn-primary">Change Password</button></div>
                                        <div id="change-password">
                                            <div id="cancel-password-change"><button class="btn btn-sm btn-warning">Cancel</button></div>
                                            <hr>
                                            {!! Form::model($data['row'], ['route' => ['user.password-change', encrypt($data['row']->id)], 'method' => 'POST', 'class' => 'form-horizontal',
                                                'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

                                            {!! Form::hidden('id', encrypt($data['row']->id)) !!}

                                            <div class="form-group">
                                                {!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-sm-4">
                                                    {!! Form::password('password',  ["placeholder" => "", "class" => "form-control border-form","autofocus","id"=>"pass", "required"]) !!}
                                                    @include('includes.form_fields_validation_message', ['name' => 'password'])
                                                </div>

                                                {!! Form::label('confirmPassword', 'Confirm Password', ['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-sm-4">
                                                    {!! Form::password('confirmPassword',  ["placeholder" => "", "class" => "form-control border-form"/*,"onkeyup"=>"passCheck()"*/,"id"=>"repatpass", "required"]) !!}
                                                    @include('includes.form_fields_validation_message', ['name' => 'confirmPassword'])
                                                </div>
                                            </div>

                                            <div class="clearfix form-actions">
                                                <div class="align-right">
                                                    <button class="btn btn-info" type="submit">
                                                        <i class="icon-ok bigger-110"></i>
                                                        Change
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="hr hr-24"></div>

                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Status</td>
                                    <td>{{ $data['row']->status?'Active':'Inactive' }}</td>
                                </tr>


                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection

@section('js')
    {{--@include('includes.scripts.jquery_validation_scripts')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')--}}
    <script>

        /*
        * $("#hide").click(function(){
  $("p").hide();
});

$("#show").click(function(){
  $("p").show();
});
        * */
        $(document).ready(function () {
            $('#show-password-change').show();
            $('#change-password').hide();

            $('#show-password-change').click(function () {
                $('#show-password-change').hide();
                $('#change-password').show();
            });

            $('#cancel-password-change').click(function () {
                $('#show-password-change').show();
                $('#change-password').hide();
            });

        });
    </script>
@endsection