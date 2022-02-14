<div class="form-group">
    {!! Form::label('name', 'Select Product', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
    <div class="col-sm-9">
        {!! Form::select('product_id', [], null, ["placeholder" => "Type Product Name...", "class" => "col-xs-10 col-sm-5"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'name'])

        <p>&nbsp;</p>
        <hr>
        <button type="button" class="btn btn-xs btn-primary" id="load-html-btn">
            <i class="icon-plus bigger-120"></i>
        </button>
    </div>
</div>

<div class="space-4"></div>

<!-- Option Values -->
@include($view_path.'.includes.book_detail')


