<h4 class="header large lighter blue" id="filterBox"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Books</h4>
<div class="form-horizontal" id="filterDiv">
    <div class="form-group">
        {!! Form::label('bank_name', 'Bank', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('bank_name', null, ["class" => "form-control border-form","autofocus"]) !!}
        </div>

        {!! Form::label('ac_name', 'Account Name', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('ac_name', null, ["class" => "form-control border-form"]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('ac_number', 'Account Number', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('ac_number', null, ["class" => "form-control border-form"]) !!}
        </div>

        {!! Form::label('tr_date', 'Transaction Date', ['class' => 'col-sm-2 control-label']) !!}
        <div class=" col-sm-4">
            <div class="input-group ">
                {!! Form::text('tr_start_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                <span class="input-group-addon">
                        <i class="fa fa-exchange"></i>
                    </span>
                {!! Form::text('tr_end_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}

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
</div>