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
                            Create
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    @include('user.includes.commanbuttons')
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        @include('includes.validation_error_messages')
                        {!! Form::open(['route' => $base_route.'.store', 'method' => 'POST', 'class' => 'form-horizontal',
                        'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

                        @include($view_path.'.includes.form')

                        <div class="clearfix form-actions">
                            <div class="align-right">
                                <button class="btn" type="reset">
                                    <i class="fa fa-undo bigger-110"></i>
                                    Reset
                                </button>

                                <button class="btn btn-primary" type="submit" value="Save" name="add_user" id="add-user">
                                    <i class="fa fa-save bigger-110"></i>
                                    Save
                                </button>

                                <button class="btn btn-success" type="submit" value="Save" name="add_user_another" id="add-user-another">
                                    <i class="fa fa-save bigger-110"></i>
                                    <i class="fa fa-plus bigger-110"></i>
                                    Save And Add Another
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
@endsection

@section('js')

    @include('includes.scripts.jquery_validation_scripts')
    <script src="{{ asset('assets/js/notify.min.js') }}"></script>
    <script>

        $(document).ready(function () {

            /*function passCheck(){
                alert('Attention!, Please Enter Value Greater Than 0');
                pass = $("#pass").val();
                repeatpass = $("#repeatpass").val();
                if(pass == repeatpass){
                    $.notify("Please, Choose Your Target Year.", "warning");
                }
            }*/

            jqueryValidation(
                {
                    "name": {
                        required: true,
                    },
                    "email": {
                        required: true,
                    },
                    "password": {
                        required: true,
                    },
                    "contact_number": {
                        required: true,
                    },
                    "address": {
                        required: true,
                    }

                },
                {
                    "name": {
                        required: "Please, Add User Name.",
                    },
                    "email": {
                        required: "Please, Add User Email.",
                    },
                    "password": {
                        required: "Please, Add User Password.",
                    },
                    "contact_number": {
                        required: "Please, Add Contact Number.",
                    },
                    "address": {
                        required: "Please, Add Address.",
                    }
                }
            );


        });
        /*'name', 'email', 'password', 'profile_image', 'contact_number', 'address','user_type',*/
    </script>

@endsection
