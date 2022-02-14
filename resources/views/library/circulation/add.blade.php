<div class="col-md-12 col-xs-12">
    <h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create {{ $panel }}</h4>
<!-- PAGE CONTENT BEGINS -->
    {!! Form::open(['route' => $base_route.'.store', 'method' => 'POST', 'class' => 'form-horizontal',
    'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
        @include($view_path.'.includes.form')
        <div class="clearfix form-actions">
            <div class="col-md-12 align-right">
                <button class="btn btn-default" type="reset">
                    <i class="fa fa-save bigger-110"></i>
                    Reset
                </button>
                <button class="btn btn-info" type="submit">
                    <i class="fa fa-save bigger-110"></i>
                    Create
                </button>
            </div>
        </div>
        <div class="hr hr-24"></div>
    {!! Form::close() !!}
    <div class="hr hr-18 dotted hr-double"></div>
</div><!-- /.col -->