<h4 class="header large lighter blue"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Due Receive Detail</h4>
<label class="label label-info"><strong>Info: </strong> Fine & Discount Apply in One(1) Due Fees Head at a time.</label>
<div class="clearfix form-actions">
    <div class="form-group">
        <label for="date" class="col-sm-2 control-label">Receive Date</label>
        <div class="col-sm-2">
            <input id="date" name="date" placeholder="" type="text" class="form-control date-mask date-picker" id="receive_date" required>
        </div>

        <label for="receive_amount" class="col-sm-2 control-label">Receive Amount </label>
        <div class="col-sm-2">
            <input type="hidden" name="receive_amount_temp" class="form-control modal_amount" id="receive_amount_temp"  value="0" min="0">
            <input type="number" name="receive_amount" class="form-control modal_amount" id="receive_amount"  value="0" min="0" required >
            <span class="text-danger" id="amount_error"></span>
        </div>

        <label for="fine_amount" class="col-sm-1 control-label">Fine </label>
        <div class="col-sm-1">
            <input type="number" name="fine_amount" class="form-control" id="fine_amount" value="0" min="0">

            <span class="text-danger" id="fine_amount_error"></span>
        </div>

        <label for="discount_amount" class="col-sm-1 control-label">Discount </label>
        <div class="col-sm-1">
            <input type="number" name="discount_amount" class="form-control" id="discount_amount" value="0" min="0" >

            <span class="text-danger" id="amount_error"></span>
        </div>

    </div>
    <div class="form-group">
        <label for="payment_mode" class="col-sm-2 control-label">Payment Method</label>
        <div class="col-sm-8">
            <div class="checkbox">
                @if($data['payment_method'])
                    @foreach($data['payment_method'] as $pmode)
                        <label>
                            @if ($pmode !='')
                                {!! Form::radio('payment_mode', $pmode, ($pmode =='Cash')?true:false, ['class' => 'ace']) !!}
                            @endif
                            <span class="lbl"> {{ $pmode }} </span>
                        </label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="inputPassword3" class="col-sm-1 control-label">Note</label>

        <div class="col-sm-11">
            <textarea name="note" class="form-control" rows="1" id="description" placeholder=""></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-5">
            <label class="radio-inline">
                <input type="radio" name="print_receipt" value="none" checked="checked">No Print
            </label>
            <label class="radio-inline">
                <input type="radio" name="print_receipt" value="short">Print Short Receipt
            </label>
            <label class="radio-inline">
                <input type="radio" name="print_receipt" value="detail">Print Detail Receipt
            </label>
        </div>
    </div>
    <div class="clearfix form-actions">
        <div class="col-md-12 align-center">
            <button class="btn btn-block btn-success" type="submit" value="Save" name="add_collection" id="add-collection">
                <i class="fa fa-save bigger-110"></i>
                Collect Balance Fees
            </button>
        </div>
    </div>
</div>