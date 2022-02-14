<div id="accordion" class="accordion-style1 panel-group hidden-print">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                    <h3 class="header large lighter blue">
                        <i class="bigger-110 ace-icon fa fa-angle-double-right" data-icon-hide="ace-icon fa fa-angle-double-down" data-icon-show="ace-icon fa fa-angle-double-right"></i>
                        Filter {{$panel}}
                        <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;
                    </h3>
                </a>
            </h4>
        </div>

        <div class="panel-collapse collapse" id="collapseOne" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                {{--{!! Form::open(['route' => $base_route,'method' => 'GET', 'class' => 'form-horizontal', "enctype" => "multipart/form-data"]) !!}--}}
                <div class="clearfix">
                    <div class="form-horizontal" id="filterDiv">
                        <div class="form-group">
                            {!! Form::label('isbn_number', 'ISBN Number', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('isbn_number', null, ["class" => "form-control border-form","autofocus"]) !!}
                            </div>

                            {!! Form::label('code', 'Code', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::text('code', null, ["class" => "form-control border-form"]) !!}
                            </div>

                            {!! Form::label('categories', 'Category', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-3">
                                {{--{!! Form::select('categories', $data['categories'], null, ['class' => 'form-control', 'onChange' => 'loadSemesters(this);']) !!}--}}
                                <select name="categories" class="form-control chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Category..." >
                                    <option value="">  </option>
                                    @foreach( $data['categories'] as $key => $category)
                                        <option value="{{ $key }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('title', 'Book Name', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('title', null, ["class" => "form-control border-form"]) !!}
                            </div>


                            {!! Form::label('author', 'Author', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::text('author', null, ["class" => "form-control border-form"]) !!}
                            </div>

                            {!! Form::label('rack_location', 'Rack Location', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::text('rack_location', null, ["class" => "form-control border-form"]) !!}
                            </div>

                        </div>

                        <div class="form-group">
                            {!! Form::label('language', 'Language', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('language', null, ["class" => "form-control border-form"]) !!}
                            </div>

                            {!! Form::label('publisher', 'Publisher', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::text('publisher', null, ["class" => "form-control border-form"]) !!}
                            </div>

                            {!! Form::label('publish_year', 'Publish Year', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::text('publish_year', null, ["class" => "form-control border-form"]) !!}
                            </div>
                        </div>

                        <div class="form-group">

                            {!! Form::label('edition', 'Edition', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('edition', null, ["class" => "form-control border-form"]) !!}
                            </div>

                            {!! Form::label('series', 'Series', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::text('series', null, ["class" => "form-control border-form"]) !!}
                            </div>

                            {!! Form::label('edition_year', 'Edition Year', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::text('edition_year', null, ["class" => "form-control border-form"]) !!}
                            </div>
                        </div>
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
                {{--{!! Form::close() !!}--}}

            </div>
        </div>
    </div>
</div>