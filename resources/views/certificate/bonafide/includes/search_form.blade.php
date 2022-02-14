<div id="accordion" class="accordion-style1 panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                    <h4 class="header large lighter blue">
                        <i class="bigger-110 ace-icon fa fa-angle-double-right" data-icon-hide="ace-icon fa fa-angle-double-down" data-icon-show="ace-icon fa fa-angle-double-right"></i>
                        Filter {{$panel}}
                        <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;
                    </h4>
                </a>
            </h4>
        </div>

        <div class="panel-collapse collapse" id="collapseOne" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                <div class="clearfix">
                    @include('student.includes.search_form')

                    <div class="form-group">
                        {!! Form::label('issue_date', 'Issue Date', ['class' => 'col-sm-2 control-label']) !!}
                        <div class=" col-sm-3">
                            <div class="input-group ">
                                {!! Form::text('issue_start_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                <span class="input-group-addon">
                                    <i class="fa fa-exchange"></i>
                                </span>
                                {!! Form::text('issue_end_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'issue_start_date'])
                                @include('includes.form_fields_validation_message', ['name' => 'issue_end_date'])
                            </div>
                        </div>

                        {!! Form::label('period', 'Period', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('period', null, ["placeholder" => "YYYY-YYYY", "class" => "form-control border-form "]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'period'])
                        </div>

                        {!! Form::label('character', 'Character', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-3">
                            {!! Form::text('character', null, ["class" => "form-control border-form upper","required"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'character'])
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('course', 'Course', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('course', null, ["class" => "form-control border-form upper","required"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'course'])
                        </div>
                    </div>
                </div>
                <div class="clearfix form-actions">
                    <div class="col-md-12 align-right">        &nbsp; &nbsp; &nbsp;
                        <button class="btn btn-info" type="submit" id="filter-btn">
                            <i class="fa fa-filter bigger-110"></i>
                            Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
