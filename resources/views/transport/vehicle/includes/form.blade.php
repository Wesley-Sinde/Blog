<div class="form-group">
    {!! Form::label('number', "Number", ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('number', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'number'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('type', "Type", ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('type', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'type'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('model', "Model", ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('model', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'model'])
    </div>
</div>


<div class="form-group">
    {!! Form::label('description', "Desc.", ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::textarea('description', null, ["class" => "form-control border-form","rows"=>"2"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'description'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('find_staffs', 'Find Staff & Add', ['class' => 'col-sm-12 control-label align-center']) !!}
    <div class="col-sm-12">
        {!! Form::select('find_staffs', [], null, ["placeholder" => "Type Vehicle Name...", "class" => "col-xs-12 col-sm-12", "style" => "width: 100%;"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'find_staffs'])

        <hr>
        <div class="align-right">
            <button type="button" class="btn btn-sm btn-primary" id="load-html-btn">
                <i class="fa fa-plus bigger-120"></i> Add Staff
            </button>
        </div>
    </div>
</div>
<div class="space-4"></div>
<!-- Option Values -->
@include($view_path.'.includes.staff')