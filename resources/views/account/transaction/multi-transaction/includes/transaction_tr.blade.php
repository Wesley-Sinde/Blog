<tr>
    <td>
        <div class="btn-group">
            <span class="btn btn-xs btn-primary" >
                <i class="fa fa-arrows" aria-hidden="true"></i>
            </span>
        </div>
    </td>
    <td>
        {!! Form::hidden('chkIds[]', 1, ["class" => "input-sm form-control border-form"]) !!}
        {!! Form::text('date[]', null, ["class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd","required"]) !!}
    </td>
    <td>
        <select name="tr_head[]" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Ledger/Transaction Head..." required>
            <option value="">  </option>
            @foreach( $tr_heads as $key => $th)
                <option value="{{ $key }}">{{ $th }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <text class="form-control" placeholder="Description" name="description[]" autocomplete="off" required></text>
    </td>
    <td>
        <input type="number" class="form-control" step="any" name="dr_amount[]" min="0" placeholder="0" autocomplete="off" required>
    </td>
    <td>
        <input type="number" class="form-control" step="any" name="cr_amount[]" min="0" placeholder="0"  autocomplete="off" required>
    </td>

    <td>
        <div class="btn-group">
            <span class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                <i class="fa fa-trash bigger-120" aria-hidden="true"></i>
            </span>
        </div>
    </td>
</tr>

@include('account.transaction.multi-transaction.includes.common-script')
@include('includes.scripts.inputMask_script')
@include('includes.scripts.table_tr_sort')
@include('includes.scripts.datepicker_script')
