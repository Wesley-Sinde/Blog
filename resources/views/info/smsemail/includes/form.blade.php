<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{ $panel }}</h4>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('type', 'TYPE', ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-sm-8">
                <label>{!! Form::radio('type[]','sms' ,true, ["class" => "ace", "id"=>"typeSms","onclick" => "messageTypeCondition()"]) !!}<span class="lbl"> SMS </span></label>
                <label>{!! Form::radio('type[]','email' ,false, ["class" => "ace", "id"=>"typeEmail","onclick" => "messageTypeCondition()"]) !!}<span class="lbl"> E-mail</span></label>
                @include('includes.form_fields_validation_message', ['name' => 'type'])
            </div>
        </div>
        @if(isset($data['roles']) && $data['roles']->count() > 0)
            <span class="label label-warning arrowed-right arrowed-in">Message Send Groups</span>
            <div class="form-group">
                <div class="checkbox">
                    @foreach($data['roles'] as $role)
                        <label>
                            {!! Form::checkbox('role[]', $role->name, false, ['class' => 'ace role']) !!}
                            <span class="lbl"> {{ $role->display_name }} </span>
                        </label>
                        <hr class="hr-4">
                    @endforeach
                </div>
                <div class="control-group">
                </div>
            </div>
        @endif
    </div>
    <div class="col-md-8 sms">
        <div class="form-group">
            {!! Form::label('message', 'Message', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('message', null, ["class" => "form-control border-form", "id"=>"smsmessage","rows"=>"10"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'message'])
                <span class="black" id="count"></span>
            </div>
        </div>
    </div>
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
</div>
<div class="clearfix form-actions">
    <div class="col-md-12 align-right">
        <button class="btn" type="reset">
            <i class="fa fa-undo bigger-110"></i>
            Reset
        </button>

        <button class="btn btn-info" type="submit" id="group-message-send-btn">
            <i class="fa fa-save bigger-110"></i>
            Send
        </button>
    </div>
</div>

<div class="hr hr-24"></div>