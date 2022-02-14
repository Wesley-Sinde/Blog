<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{ $panel }}</h4>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('type', 'TYPE', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                <label>{!! Form::radio('type[]','sms' ,true, ["class" => "ace form-control border-form", "id"=>"typeSms","onclick" => "messageTypeCondition()"]) !!}<span class="lbl"> SMS </span></label>
                <label>{!! Form::radio('type[]','email' ,false, ["class" => "ace form-control border-form", "id"=>"typeEmail","onclick" => "messageTypeCondition()"]) !!}<span class="lbl"> E-mail</span></label>
                @include('includes.form_fields_validation_message', ['name' => 'type'])
            </div>
        </div>
        <hr class="hr-4">
        <div class="col-md-12 sms">
            <div class="form-group">
                {!! Form::label('number', 'Number', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('number', null, ["class" => "form-control border-form"]) !!}
                    @include('includes.form_fields_validation_message', ['name' => 'number'])
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('message', 'Message', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('message', null, ["class" => "form-control border-form","id"=>"smsmessage", "rows"=>"10"]) !!}
                    @include('includes.form_fields_validation_message', ['name' => 'message'])
                    <span class="black" id="count"></span>
                </div>
            </div>
        </div>
        <div class="col-md-12 email">
            <div class="form-group">
                {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('email', null, ["class" => "form-control border-form"]) !!}
                    @include('includes.form_fields_validation_message', ['name' => 'email'])
                </div>
            </div>
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
    </div>
</div>

<div class="clearfix form-actions">
    <div class="col-md-12 align-right">
        <button class="btn" type="reset">
            <i class="fa fa-undo bigger-110"></i>
            Reset
        </button>

        <button class="btn btn-info" type="submit" id="individual-message-send-btn">
            <i class="fa fa-save bigger-110"></i>
            Send
        </button>
    </div>
</div>

<div class="hr hr-24"></div>
