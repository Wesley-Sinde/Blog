<div class="form-group">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        {{--class="display" cellspacing="0" width="100%"--}}
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Date</th>
            <th width="30%">Ledger</th>
            <th width="30%">Description</th>
            <th>Dr. Amount</th>
            <th>Cr. Amount</th>
            <th>
                <span class="btn btn-xs btn-primary" id="load-transaction-html">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
            </th>
        </tr>
        </thead>

        <tbody id="transaction_wrapper">
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
                {!! Form::text('date[]', null, ["class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd","required","autofocus"]) !!}
            </td>
            <td>
                <select name="tr_head[]" class=" form-control" id="form-field-select-3" data-placeholder="Choose a Ledger/Transaction Head..." required>
                    <option value="">  </option>
                    @foreach( $data['th'] as $key => $th)
                        <option value="{{ $key }}">{{ $th }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="text" class="form-control" name="description[]" id="description" required>
            </td>
            <td>
                <input type="number" class="form-control" step="any" name="dr_amount[]" id="dr_amount" min="0" placeholder="0"  autocomplete="off" required>
            </td>
            <td>
                <input type="number" class="form-control" step="any" name="cr_amount[]" id="cr_amount" min="0" placeholder="0"  autocomplete="off" required>
            </td>

            <td>
                <div class="btn-group">
                        <span class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                            <i class="fa fa-trash bigger-120" aria-hidden="true"></i>
                        </span>
                </div>
            </td>
        </tr>
        </tbody>
        {{--<tfoot>
            <tr>
                <td colspan="7">
                    <button type="button" class="btn btn-primary" id="load-transaction-html">
                        <i class="fa fa-plus" aria-hidden="true"></i> More Transaction
                    </button>
                </td>
            </tr>
        </tfoot>--}}

    </table>
</div>