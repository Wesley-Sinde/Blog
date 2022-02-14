<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{ $panel }}</h4>

<div class="form-group">
    {!! Form::label('type', 'Type', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::select('type', $data['exchange_type'], null, ['class' => 'form-control']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'type'])
    </div>

    {!! Form::label('ref_no', 'REF No.', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('ref_no', isset($data['ref_no'])?$data['ref_no']:null, ["placeholder" => "", "class" => "form-control border-form", "required", "autofocus"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'ref_no'])
    </div>

    {!! Form::label('date', 'Date', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('date', null, ["class" => "form-control date-picker border-form input-mask-date","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'date'])
    </div>

</div>

<div class="form-group">
    {!! Form::label('subject', 'Subject', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('subject', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'subject'])
    </div>

    <div class="form-group">
        {!! Form::label('file', 'Attachment', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::file('file', ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'file'])
        </div>
        <div class="col-sm-2">
            @if (isset($data['row']) && $data['row']->attachment)
                <a href="{{ asset('postalExchange'.DIRECTORY_SEPARATOR.$data['row']->attachment) }}" target="_blank"><i class="ace-icon fa fa-download bigger-130"></i></a>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('from', 'From', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('from', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'from'])
    </div>

    {!! Form::label('to', 'To', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('to', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'to'])
    </div>
</div>
<div class="form-group">
    {!! Form::label('note', 'Note', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('note', null, ["placeholder" => "", "class" => "form-control border-form", "rows"=>'2']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'note'])
    </div>
</div>

