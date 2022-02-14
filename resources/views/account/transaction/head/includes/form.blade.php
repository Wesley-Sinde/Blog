<div class="form-group">
    {!! Form::label('tr_head', 'Ledger', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('tr_head', null, ["placeholder" => "e.g. Room Rent", "class" => "form-control border-form upper"]) !!}
    </div>

    {!! Form::label('acc_id', 'Group', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-5">
        @if(isset($data['row']))
            <select name="acc_id" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Group..." >
                <option value="">  </option>
                @foreach( $data['ac'] as $key => $aCat)
                    <option value="{{ $key }}" {{ ($key == $data['row']->acc_id)?"selected":'' }}>{{ $aCat }}</option>
                @endforeach
            </select>
        @else
            <select name="acc_id" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Group..." >
                <option value="">  </option>
                @foreach( $data['ac'] as $key => $aCat)
                    <option value="{{ $key }}">{{ $aCat }}</option>
                @endforeach
            </select>
        @endif
    </div>
</div>
@if(request()->is('account/transaction-head'))
    <div class="form-group">
        <label for="account_type" class="col-sm-4 control-label">Opening Balance <i class="text-danger">*</i></label>
        <div class="col-sm-4">
            <select class="form-control" id="account_type" name="account_type" autocomplete="off">
                <option value="dr_amt">Debit (+)</option>
                <option value="cr_amt">Credit (-)</option>
            </select>
        </div>
        <div class="col-sm-4">
            <input type="number" class="form-control" step="any" name="amount" id="amount" placeholder="Amount"  autocomplete="off">
        </div>
    </div>
@endif

