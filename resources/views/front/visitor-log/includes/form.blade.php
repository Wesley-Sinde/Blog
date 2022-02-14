<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{ $panel }}</h4>

<div class="form-group">
    {!! Form::label('purpose', 'Purpose', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('purpose', $data['purpose'], null, ['class' => 'form-control']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'purpose'])
    </div>

    {!! Form::label('date', 'Date', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('date', null, ["class" => "form-control date-picker border-form input-mask-date","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'date'])
    </div>

    {!! Form::label('in_time', 'In Time', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-1">
        {!! Form::time('in_time', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'in_time'])
    </div>

    {!! Form::label('out_time', 'Out Time', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-1">
        {!! Form::time('out_time', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'out_time'])
    </div>

</div>

<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('name', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'name'])
    </div>

    {!! Form::label('phone', 'Phone', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('phone', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'phone'])
    </div>

    {!! Form::label('email', 'Email', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::email('email', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'email'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('id_doc', 'ID Doc.', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('id_doc', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'id_doc'])
    </div>

    {!! Form::label('id_num', 'ID Number', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('id_num', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'id_num'])
    </div>

    {!! Form::label('token', 'Token/Pass', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('token', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'token'])
    </div>

    {!! Form::label('file', 'Attachment', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::file('file', ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'file'])
    </div>
    <div class="col-sm-1">
        @if (isset($data['row']) && $data['row']->attachment)
            <a href="{{ asset('postalExchange'.DIRECTORY_SEPARATOR.$data['row']->attachment) }}" target="_blank"><i class="ace-icon fa fa-download bigger-130"></i></a>
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('note', 'Note', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-11">
        {!! Form::textarea('note', null, ["placeholder" => "", "class" => "form-control border-form", "rows"=>'1']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'note'])
    </div>
</div>

