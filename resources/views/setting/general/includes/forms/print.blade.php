<div class="form-group">
    <label class="col-sm-2 control-label">
        <i class="fa fa-print bigger-120 white" aria-hidden="true"></i> Header Text
    </label>
    <div class="col-sm-8">
        {!! Form::textarea('print_header', null, ["class" => "form-control border-form","id"=>"summernote"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'print_header'])
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">
        <i class="fa fa-print bigger-120 white" aria-hidden="true"></i> Footer Text
    </label>
    <div class="col-sm-8">
        {!! Form::textarea('print_footer', null, ["class" => "form-control border-form summernote"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'print_footer'])
    </div>
</div>