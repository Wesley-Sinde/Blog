<div class="form-group">
    {!! Form::label('institute', 'Institute', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('institute', null, ["class" => "form-control border-form", "required", "autofocus"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'institute'])
    </div>

    {!! Form::label('salogan', 'Salogan', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('salogan', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'salogan'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('copyright', 'Copyright©', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-11">
        {!! Form::text('copyright', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'copyright'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('address', 'Address', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('address', null, ["class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'address'])
    </div>

    <label class="col-sm-1 control-label">
        <i class="fa fa-phone bigger-120 white" aria-hidden="true"></i> Contact
    </label>
    <div class="col-sm-5">
        {!! Form::text('phone', null, ["class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'phone'])
    </div>
</div>
<div class="form-group">
    <label class="col-sm-1 control-label">
        <i class="fa fa-envelope bigger-120 white" aria-hidden="true"></i> Email
    </label>
    <div class="col-sm-5">
        {!! Form::email('email', null, ["class" => "form-control border-form" , "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'email'])
    </div>

    <label class="col-sm-1 control-label">
        <i class="fa fa-globe bigger-120 white" aria-hidden="true"></i> Website
    </label>
    <div class="col-sm-5">
        {!! Form::text('website', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'website'])
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        {!! Form::label('logo_image', 'Logo', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::file('logo_image', ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'logo_image'])
        </div>

        @if (isset($data['row']))
            @if ($data['row']->logo)
                <img id="avatar"  src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$data['row']->logo) }}" class="img-responsive" >
            @endif
        @endif
    </div>
    <div class="col-md-6">
        {!! Form::label('favicon_image', 'Favicon', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::file('favicon_image', ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'favicon_image'])
        </div>

        @if (isset($data['row']))
            @if ($data['row']->favicon)
                <img id="avatar"  src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$data['row']->favicon) }}" class="img-responsive" >
            @endif
        @endif
    </div>
</div>