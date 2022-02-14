<div class="col-md-8 email">
    <div class="form-group">
        {!! Form::label('subject', 'Subject', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('subject', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'subject'])
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('emailMessage', 'Message', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('emailMessage', null, ["class" => "form-control border-form", "id"=>"summernote","rows"=>"5"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'emailMessage'])
        </div>
    </div>
</div>