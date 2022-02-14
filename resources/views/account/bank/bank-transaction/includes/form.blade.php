<div class="form-group row">
    <label for="date" class="col-sm-3 control-label">Date <i class="text-danger">*</i></label>
    <div class="col-sm-6">
        {!! Form::text('date', null, ["class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd","id"=>"tr_date","required"]) !!}
    </div>
</div>

<div class="form-group row">
    <label for="banks_id" class="col-sm-3 control-label">Bank Name <i class="text-danger">*</i></label>
    <div class="col-sm-6">
        <select name="banks_id" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Bank..." >
            <option value="">  </option>
            @foreach( $data['banks'] as $key => $bank)
                <option value="{{ $key }}">{{ $bank }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="account_type" class="col-sm-3 control-label">Account Type <i class="text-danger">*</i></label>
    <div class="col-sm-6">
        <select class="form-control" id="account_type" name="account_type" autocomplete="off">
            <option value="dr_amt">Debit (+)</option>
            <option value="cr_amt">Credit (-)</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="deposit_id" class="col-sm-3 control-label">Withdraw / Deposite ID <i class="text-danger">*</i></label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="deposit_id" id="deposit_id"  placeholder="Withdraw / Deposite ID"  autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <label for="amount" class="col-sm-3 control-label">Amount <i class="text-danger">*</i></label>
    <div class="col-sm-6">
        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount"  autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-sm-3 control-label">Description </label>
    <div class="col-sm-6">
        <textarea class="form-control" placeholder="Description" name="description" autocomplete="off"></textarea>
    </div>
</div>
