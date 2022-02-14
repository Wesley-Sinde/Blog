<div id="accordion" class="accordion-style1 panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                    <h3 class="header large lighter blue">
                        <i class="bigger-110 ace-icon fa fa-angle-double-right" data-icon-hide="ace-icon fa fa-angle-double-down" data-icon-show="ace-icon fa fa-angle-double-right"></i>
                        Filter Certificate History
                        <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;
                    </h3>
                </a>
            </h4>
        </div>

        <div class="panel-collapse collapse" id="collapseOne" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                <div class="clearfix">
                    @include('student.includes.search_form')
                    <div class="form-group">
                        {!! Form::label('reg_no', 'REG No.', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form","autofocus"]) !!}
                        </div>

                        {!! Form::label('history_type', 'History Type', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::select('history_type', [""=>"Select History...", "Created"=>"Created", "Updated"=>"Updated","Delete"=>"Delete"], null, ['class' => 'form-control']) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'history_type'])
                        </div>

                        {!! Form::label('date', 'Date', ['class' => 'col-sm-2 control-label']) !!}
                        <div class=" col-sm-3">
                            <div class="input-group ">
                                {!! Form::text('start_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                <span class="input-group-addon">
                        <i class="fa fa-exchange"></i>
                    </span>
                                {!! Form::text('end_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'start_date'])
                                @include('includes.form_fields_validation_message', ['name' => 'end_date'])
                            </div>
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
