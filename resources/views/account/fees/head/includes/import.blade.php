<div class="form-horizontal">
    {!! Form::open(['route' => $base_route.'.bulk.import', 'method' => 'POST', 'class' => 'form-horizontal',
     'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
    <hr>
    <a href="{{ asset('assets/csv-template/feehead-import.csv') }}" target="_blank" class="easy-link-menu"><h3><i class="fa fa-download"></i> CSV Template</h3></a>
    <hr>
    <div class="form-group">
        {!! Form::label('file', 'File', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::file('file', null, ["class" => "form-control border-form", "required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'file'])
        </div>
    </div>

    <div class="clearfix form-actions">
        <div class="col-md-12 align-right">
            <button class="btn btn-info" type="submit" id="filter-btn">
                <i class="fa fa-upload"></i>
                Import
            </button>
        </div>
    </div>
    <div class="hr hr-18 dotted hr-double"></div>
    {!! Form::close() !!}
</div>