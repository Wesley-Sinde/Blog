<span class="label label-info arrowed-in arrowed-right arrowed responsive">Red mark input field are required. </span>
<hr class="hr-16">

<div class="form-group">
    @if (!isset($data['row']))
        <label class="col-sm-2 control-label">Category</label>
        <div class="col-sm-3">
            {!! Form::select('category_id', $data['category'], null, ['class' => 'form-control', 'onChange' => 'loadCategory(this);', "required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'category_id'])
        </div>
        <div class="col-sm-4">
            <select name="sub_category_id" class="form-control subcategory" required >
                <option value="0">Select Sub Category....</option>
            </select>
            @include('includes.form_fields_validation_message', ['name' => 'subcategory'])
        </div>
    @else
        <label class="col-sm-2 control-label">Category</label>
        <div class="col-sm-3">
            {!! Form::select('category_id', $data['category'], null, ['class' => 'form-control', 'onChange' => 'loadCategory(this);',"required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'category_id'])
        </div>

        <div class="col-sm-4">
            {!! Form::select('sub_category_id', $data['sub_category'], null, ['class' => 'form-control subcategory']) !!}
            @include('includes.form_fields_validation_message', ['name' => 'sub_category_id'])
        </div>
    @endif



    {!! Form::label('code', 'Code', ['class' => 'col-sm-1 control-label',]) !!}
    <div class="col-sm-2">
        {!! Form::text('code',isset($data['productCode'])?$data['productCode']:null, ["class" => "form-control border-form upper","readonly"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'code'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label',]) !!}
    <div class="col-sm-6">
        {!! Form::text('name', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'name'])
    </div>

    {!! Form::label('warranty', 'Warranty/Expire', ['class' => 'col-sm-2 control-label',]) !!}
    <div class="col-sm-2">
        {!! Form::text('warranty', null, ["class" => "form-control border-form upper"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'warranty'])
    </div>
</div>
<div class="form-group">
    {!! Form::label('stock', 'Stock', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('stock', isset($data['stock'])?$data['stock']:null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'stock'])
    </div>

    {!! Form::label('cost_price', 'Cost Price', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('cost_price', isset($data['cost_price'])?$data['cost_price']:null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'cost_price'])
    </div>

    {!! Form::label('sale_price', 'Sale Price', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('sale_price', isset($data['sale_price'])?$data['sale_price']:null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'sale_price'])
    </div>
</div>

<div class="form-group">

    {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('description', null, ["class" => "form-control border-form", "rows"=>"3"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'description'])
    </div>
</div>

