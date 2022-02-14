<div class="form-group">
    {!! Form::label('hostels_id', 'Hostels', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::select('hostels_id',$data['hostels'], null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'hostels_id'])
    </div>
</div>

<div class="form-group">

    {!! Form::label('days_id', 'Day', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::select('days_id',$data['days'], null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'days_id'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('eating_times_id', 'Time', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::select('eating_times_id',$data['eating_times'], null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'eating_times_id'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('food_items', 'Find Food Item & Add', ['class' => 'col-sm-12 control-label align-center']) !!}
    <div class="col-sm-12">
        {!! Form::select('food_items', [], null, ["placeholder" => "Type Food Name...", "class" => "col-xs-12 col-sm-12", "style" => "width: 100%;"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'food_items'])

        <hr>
        <div class="align-right">
            <button type="button" class="btn btn-sm btn-primary" id="load-html-btn">
                <i class="fa fa-plus bigger-120"></i> Add Food
            </button>
        </div>
    </div>
</div>
<div class="space-4"></div>
<!-- Option Values -->
@include($view_path.'.includes.food')