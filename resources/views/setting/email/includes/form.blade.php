<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Email Configuration</h4>
<div class="form-group">
    {!! Form::label('driver', 'Driver', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('driver', null, ['placeholder'=>'e.g.SMTP', "class" => "form-control border-form", "required", "autofocus"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'driver'])
    </div>

    {!! Form::label('host', 'Host', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('host', null, ['placeholder'=>'e.g.mail.google.com', "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'host'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('port', 'Port', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('port', null, ['placeholder'=>'e.g.465', "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'port'])
    </div>

    {!! Form::label('encryption', 'Encryption', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('encryption', null, ['placeholder'=>'e.g.TLS', "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'encryption'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('user_name', 'User Name', ['placeholder'=>'e.g.SMTP','class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('user_name', null, ["class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'user_name'])
    </div>

    {!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('password', null,["class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'password'])
    </div>
</div>
@if( $data['row'])
    @if($data['row']->status == 'active')
        @php( $checkStatus = 'checked="checked"')
    @else
        @php($checkStatus = '')
    @endif
    <div class="form-group">
        <label class="pull-left inline">
            <small class="muted smaller-90">Active:</small>

            <input id="status-button"  type="checkbox" {{ $checkStatus }} onchange="onToggle()" class="ace ace-switch ace-switch-5">
            <span class="lbl middle"></span>
        </label>
    </div>
@endif