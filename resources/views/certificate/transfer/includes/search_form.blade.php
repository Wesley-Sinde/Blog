<div id="accordion" class="accordion-style1 panel-group">
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
                <div class="clearfix">
                    @include('student.includes.search_form')

                    <div class="form-group">
                        {!! Form::label('tc_num', 'Transfer Certificate No.', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('tc_num', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration", "autofocus"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'tc_num'])
                        </div>

                        {!! Form::label('issue_date', 'Issue Date', ['class' => 'col-sm-1 control-label']) !!}
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

                        {!! Form::label('leave_date', 'Leave Date', ['class' => 'col-sm-1 control-label']) !!}
                        <div class=" col-sm-3">
                            <div class="input-group ">
                                {!! Form::text('leave_start_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                <span class="input-group-addon">
                        <i class="fa fa-exchange"></i>
                    </span>
                                {!! Form::text('leave_end_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'leave_start_date'])
                                @include('includes.form_fields_validation_message', ['name' => 'leave_end_date'])
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('character', 'Character', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('character', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration", "autofocus"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'character'])
                        </div>

                        {!! Form::label('paid_fee_status', 'Fee Paid Status', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('paid_fee_status', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration", "autofocus"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'paid_fee_status'])
                        </div>

                        {!! Form::label('qualified_to_promote', 'Qualified to Promote', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('qualified_to_promote', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration", "autofocus"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'qualified_to_promote'])
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('leaving_time_class', 'Leaving Time Class', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('leaving_time_class', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration", "autofocus"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'leaving_time_class'])
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
