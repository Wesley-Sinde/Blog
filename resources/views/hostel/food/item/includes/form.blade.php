<div class="form-group">
    {!! Form::label('title', 'Category', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::select('category', $data['food_category'], null , ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'category'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('title', 'Item', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('title', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'title'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('price', 'Price', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('price', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'price'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', 'Desc.', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::textarea('description', null, ["class" => "form-control border-form","rows"=>"1"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'description'])
    </div>
</div>

<div class="form-control">
    {!! Form::label('main_image', 'Image', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::file('main_image', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'main_image'])
    </div>
</div>
@if (isset($data['row']))
    <div class="space-4"></div>
    <div class="form-group">
        <div class="col-sm-12 align-right">
            @if ($data['row']->image)
                <img src="{{ asset('images/'.$folder_name.'/'.$data['row']->image) }}" width="100">
            @else
                <p>No image.</p>
            @endif

        </div>
    </div>
@endif


