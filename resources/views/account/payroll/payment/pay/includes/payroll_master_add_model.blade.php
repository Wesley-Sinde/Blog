<!-- Modal -->
<div class="modal fade" id="salaryMasterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => 'account.payroll.master.store', 'method' => 'POST', 'class' => 'form-horizontal',
                       'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close top-close" data-dismiss="modal" id="close-button">×</button>
                <h4 class="modal-title title text-center fees_title" id="MasterTitle"><b>Add:</b>Payroll</h4>
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body">
                        <input type="hidden" name="chkIds[]" value="{{$data['staff']->id}}"/>

                        <div class="form-group">
                            <label for="tag_line" class="col-sm-3 control-label">TagLine</label>
                            <div class="col-sm-9">
                                <input id="date" name="tag_line[]" placeholder="Jan. Salary" type="text" class="form-control" required  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="payroll_head" class="col-sm-3 control-label">Payroll Head</label>
                            <div class="col-sm-9">
                                {!! Form::select('payroll_head[]', $data['payroll_head'], null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="due_date" class="col-sm-3 control-label">Date</label>
                            <div class="col-sm-9">
                                <input id="date" name="due_date[]" placeholder="" type="text" class="form-control date-mask date-picker" required  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount" class="col-sm-3 control-label">Amount </label>
                            <div class="col-sm-9">
                                <input type="text" name="amount[]" class="form-control" value="" required >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="box-body">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn cfees save_button btn-success" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <i class="fa fa-plus" aria-hidden="true"></i> Add Salary</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>