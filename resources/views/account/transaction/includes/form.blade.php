<div class="form-group row">
    <label for="date" class="col-sm-3 control-label">Date <i class="text-danger">*</i></label>
    <div class="col-sm-6">
        {!! Form::text('date', null, ["class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd","id"=>"tr_date","required"]) !!}
    </div>
</div>

<div class="form-group row">
    <label for="tr_head" class="col-sm-3 control-label">Ledger/Transaction Head <i class="text-danger">*</i></label>
    <div class="col-sm-6">
        <select name="tr_head" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Ledger/Transaction Head..." required>
            <option value="">  </option>
            @foreach( $data['th'] as $key => $th)
                <option value="{{ $key }}">{{ $th }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="account_type" class="col-sm-3 control-label">Account Type <i class="text-danger">*</i></label>
    <div class="col-sm-6">
        <select class="form-control" id="account_type" name="account_type" autocomplete="off" required>
            <option value="dr_amt">Debit (+)</option>
            <option value="cr_amt">Credit (-)</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="amount" class="col-sm-3 control-label">Amount <i class="text-danger">*</i></label>
    <div class="col-sm-6">
        <input type="number" class="form-control" step="any" name="amount" id="amount" placeholder="Amount"  autocomplete="off" required>
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-sm-3 control-label">Description <i class="text-danger">*</i></label>
    <div class="col-sm-6">
        <textarea class="form-control" placeholder="Description" name="description" autocomplete="off" required></textarea>
    </div>
</div>
