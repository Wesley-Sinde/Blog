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
                        Instamojo
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Payment
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('includes.flash_messages')
                    <div class="col-md-4 col-xs-4" ></div>
                    <div class="col-xs-4 well">
                        <div class="easy-link-menu align-center">
                            <img alt="PayUMoney Payment Request Form" src="{{ asset('assets/images/paymenticon/instamojo.png') }}" width="300px" />
                        </div>
                        {{-- <div class="card-header" style="background: #0275D8;">
                             <h2>Register for Event</h2>
                         </div>--}}


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Opps!</strong> Something went wrong<br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('account.fees.instamojoPayment.pay') }}" method="POST" name="laravel_instamojo">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Name</strong>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{$data['data']['student_name']}}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Mobile Number</strong>
                                        <input type="text" name="mobile_number" class="form-control" placeholder="Enter Mobile Number" value="{{$data['data']['mobile']}}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Email Id</strong>
                                        <input type="text" name="email" class="form-control" placeholder="Enter Email id" value="{{$data['data']['email']}}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Fees Amount</strong>
                                        <input type="number" name="amount" class="form-control" placeholder="" value="{{$data['data']['balance']}}" min="1" max="{{$data['data']['balance']}}">
                                        <strong class="info">Balance Fees Amount:{{$data['data']['balance']}}</strong>
                                    </div>
                                </div>
                                <input type="hidden" name="student_id" value="{{$data['data']['student_id']}}">
                                {{--<input type="hidden" name="description" value="{{$data['data']['description']}}">--}}
                                <div class="col-md-12 align-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-4 col-xs-4" ></div>
                </div>


            </div>
        </div><!-- /.page-content -->
    </div>
@endsection


@section('js')

@endsection