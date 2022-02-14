<h4 class="header large lighter blue" id="filterBox"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Filter Transaction</h4>
<div class="form-horizontal" id="filterDiv">
    <div class="form-group">
        <label for="tr_head" class="col-sm-1 control-label">Ledger</label>
        <div class="col-sm-4">
            <select name="tr_head" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Ledger..." >
                <option value="">  </option>
                @foreach( $data['th'] as $key => $th)
                    <option value="{{ $key }}">{{ $th }}</option>
                @endforeach
            </select>
        </div>
        {!! Form::label('tr_date', 'Date Range', ['class' => 'col-sm-2 control-label']) !!}
        <div class=" col-sm-4">
            <div class="input-group">
                {!! Form::text('tr_start_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                <span class="input-group-addon">
                        <i class="fa fa-exchange"></i>
                </span>
                {!! Form::text('tr_end_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}

            </div>
        </div>
        <button class="btn btn-info btn-sm" type="submit" id="filter-btn">
            <i class="fa fa-filter"></i>
            Filter
        </button>
    </div>
</div>
<hr>