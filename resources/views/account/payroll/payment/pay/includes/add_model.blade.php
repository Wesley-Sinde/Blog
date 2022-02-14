<!-- Modal -->
<div class="modal fade" id="salaryPayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => $base_route.'.store', 'method' => 'POST', 'class' => 'form-horizontal',
                       'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

        <div class="modal-content">
            <div class="modal-header">
                {{--<button type="button" class="close top-close" data-dismiss="modal" id="close-button">×</button>
                <h4 class="modal-title title text-center fees_title" id="MasterTitle"><b>Class 6 General:</b> admission-fees</h4>--}}
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body">
                        <input type="hidden" name="staff_id" id="StaffId" value=""/>
                        <input type="hidden" name="salary_masters_id" id="MasterId" value=""/>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Date</label>
                            <div class="col-sm-9">
                                <input id="date" name="date" placeholder="" type="text" class="form-control date-mask date-picker" required {{--readonly="readonly"--}} >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Amount </label>
                            <div class="col-sm-9">

                                <input type="text" name="paid_amount" class="form-control modal_amount" id="salAmount"  value="" required >

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>

                        <div class="form-group mb0">
                            <div class="col-sm-12">
                                <label for="inputPassword3" class="col-sm-3 control-label">Allowance</label>
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="allowance" class="form-control" id="amountAllowance" value="0" autofocus>

                                        <span class="text-danger" id="amount_error"></span></div>
                                </div>
                                <label for="inputPassword3" class="col-sm-3 control-label">Fine</label>
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="fine" class="form-control" id="amount_fine" value="0">

                                        <span class="text-danger" id="amount_error"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Payment Mode</label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode" value="Cash" checked="checked">Cash                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode" value="Cheque">Cheque                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode" value="BD">Bank Deposit                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Note</label>

                            <div class="col-sm-9">
                                <textarea name="note" class="form-control" rows="3" id="description" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="box-body">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn cfees save_button btn-success" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <i class="fa fa-money" aria-hidden="true"></i> Pay Now</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>