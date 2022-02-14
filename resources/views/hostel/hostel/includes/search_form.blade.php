{{--
<h4 class="header large lighter blue" id="filterBox"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Books</h4>
<div class="form-horizontal" id="filterDiv">
    <div class="form-group">
        {!! Form::label('isbn_number', 'ISBN Number', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('isbn_number', null, ["class" => "form-control border-form","autofocus"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'isbn_number'])
        </div>

        {!! Form::label('code', 'Code', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('code', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'code'])
        </div>

        {!! Form::label('categories', 'Category', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::select('categories', $data['categories'], null, ['class' => 'form-control', 'onChange' => 'loadSemesters(this);']) !!}
            @include('includes.form_fields_validation_message', ['name' => 'faculty'])
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('title', 'Book Name', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('title', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'title'])
        </div>


        {!! Form::label('author', 'Author', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('author', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'author'])
        </div>

        {!! Form::label('rack_location', 'Rack Location', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('rack_location', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'rack_location'])
        </div>

    </div>

    <div class="form-group">
        {!! Form::label('language', 'Language', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('language', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'language'])
        </div>

        {!! Form::label('publisher', 'Publisher', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('publisher', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'publisher'])
        </div>

        {!! Form::label('publish_year', 'Publish Year', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('publish_year', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'publish_year'])
        </div>
    </div>

    <div class="form-group">

        {!! Form::label('edition', 'Edition', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('edition', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'edition'])
        </div>

        {!! Form::label('series', 'Series', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('series', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'series'])
        </div>

        {!! Form::label('edition_year', 'Edition Year', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('edition_year', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'edition_year'])
        </div>


    </div>

    <div class="clearfix form-actions">
                    <div class="align-right">
                        <button class="btn btn-info" type="submit" id="filter-btn">
                            <i class="fa fa-filter bigger-110"></i>
                            Filter
                        </button>
                    </div>
                </div>
</div>--}}
