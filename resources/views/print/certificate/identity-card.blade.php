@extends('layouts.master')

@section('css')
    @include('print.certificate.common.css')
    <style>
        /*.page {
            width: 54mm;
            height: 86mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            background-color: #D3D3D3 !important;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }*/

        .subpage {
            width: 54mm;
            height: 86mm;
            margin: 15px 25px;
            float: left;
            border: 1px rgba(0,0,0,.2) solid;
        }
        .page-content {
            padding: 5px !important;
        }


        @media print {
            html, body {
                color: white !important;
            }
            .page {
                color: white !important;
            }


        }
    </style>
    <style>
        @if($data['certificate_template']->background_status == 1)
        @if(@isset($data['certificate_template']->background_image))
            .subpage{
            background-image: url({{ asset('images/certificateBackground/'.$data['certificate_template']->background_image) }}) !important;
            background-repeat: round !important;
            background-size: cover !important;
        }
        @endif
        @endif

        {{$data['certificate_template']->custom_css}}
    </style>
@endsection

@section('content')
    @include('print.certificate.common.print-button')
    @if($data['students'] && $data['students']->count() > 0)
        @foreach($data['students']->chunk(9) as $students)
            <div class="book">
                <div class="page">
                    @foreach($students as $key => $student)
                        <div class="subpage">
                                    <div class="main-content" {{--style="page-break-after:always;"--}}>
                                        <div class="main-content-inner">
                                            <div class="page-content">
                                                <div class="row">
                                                    <div class="col-sm-12 align-center text-center">
                                                        <div class="widget-box transparent">
                                                            {{--@include('print.includes.institution-detail')--}}
                                                            {{--<div class="row">
                                                                <h3 class="no-margin no-margin-top text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 15px">
                                                                    <strong><u>{{$student->certificate}} Certificate </u></strong>
                                                                </h3>
                                                            </div>--}}
                                                            <div class=row">
                                                                <div class="text-center" >
                                                                    @if($student->student_image !='')
                                                                        <img class="student_image"  alt="{{ $student->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'studentProfile'.DIRECTORY_SEPARATOR.$student->student_image) }}" />
                                                                    @else
                                                                        <img class="student_image" alt="" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
                                                                    @endif
                                                                    {!! $student->certificate_template !!}
                                                                </div>
                                                                {{--<div class="row text-uppercase">
                                                                    <div class="pull-left text-center" >
                                                                        <span>
                                                                            <strong style="border-bottom: 2px black solid"  >{{\Carbon\Carbon::now()}}</strong ><br>
                                                                            Print Date/Time
                                                                        </span>
                                                                    </div>
                                                                    <div class="pull-right text-center">
                                                                        <br>
                                                                        <span style="border-top: 2px black solid; padding: 0px 50px;">&nbsp;Signature&nbsp;</span >
                                                                    </div>
                                                                </div>--}}
                                                            </div>
                                                        </div>
                                                    </div><!-- /.col -->
                                                </div><!-- /.row -->
                                            </div>
                                        </div>
                                    </div><!-- /.main-content -->
                                </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
@endsection
{{--
@foreach($items->chunk(5) as $chunk)
    <ul>
        @foreach($chunk as $item)
            Item {{ $loop->iteration }}
        @endforeach
    </ul>
@endforeach
--}}
@section('js')
    <!-- inline scripts related to this page -->
   {{--@include('includes.scripts.print_script')--}}
@endsection