<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Alert Setting Manage</h4>
<div class="form-group">
    {!! Form::label('event', 'Event', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('event', null, ["class" => "form-control border-form", "required", "disabled"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'event'])
    </div>

    {!! Form::label('Type', 'Alert Type', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
    <div class="control-group">
        <div class="checkbox">
            <label>
                @if ($data['row']->sms ==1)
                    {!! Form::checkbox('sms', 1, true, ['class' => 'ace']) !!}
                @else
                    {!! Form::checkbox('sms', 1,  false, ['class' => 'ace']) !!}
                @endif
                    <span class="lbl"> SMS </span>
            </label>
            <label>
                @if ($data['row']->email ==1)
                    {!! Form::checkbox('email', 1, true, ['class' => 'ace']) !!}
                @else
                    {!! Form::checkbox('email', 1,  false, ['class' => 'ace']) !!}
                @endif
                <span class="lbl"> Email </span>
            </label>
        </div>
    </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('subject', 'Subject', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('subject', null, ["class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'subject'])
    </div>
</div>
<div class="form-group">
    {!! Form::label('template', 'Template', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('template', null, ["class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'template'])
    </div>
</div>

