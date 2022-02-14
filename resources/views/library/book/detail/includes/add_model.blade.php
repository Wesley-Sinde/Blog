<!-- Modal -->
<div class="modal fade" id="addBookCopies" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => $base_route.'.add.copies', 'method' => 'POST', 'class' => 'form-horizontal',
                       'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

        <div class="modal-content">
            <div class="modal-header">
                {{--<button type="button" class="close top-close" data-dismiss="modal" id="close-button">×</button>
                <h4 class="modal-title title text-center fees_title" id="MasterTitle"><b>Class 6 General:</b> admission-fees</h4>--}}
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body">
                        <input type="hidden" name="book_masters_id" id="bookId" value=""/>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Book Code </label>
                            <div class="col-sm-9">

                                <input type="text" name="code" class="form-control modal_amount" id="Code"  value="" required readonly >

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>

                        <div class="form-group mb0">
                            <div class="col-sm-12">
                                <label for="start" class="col-sm-3 control-label">Start</label>
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <input type="number" name="start" class="form-control" id="start" value="" required onkeyup="changeStartCode()">

                                        <span class="text-danger" id="amount_error"></span></div>
                                </div>
                                <label for="end" class="col-sm-3 control-label">End</label>
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <input type="number" name="end" class="form-control" id="end" required onkeyup="changeEndCode()">
                                        <span class="text-danger" id="amount_error"></span></div>
                                </div>
                            </div>
                        </div>
                        <span id="errorShow" class="error text-danger"></span>

                        <div class="form-group mb0">
                            <div class="col-sm-12">
                                <label for="start_preview" class="col-sm-3 control-label">Start Code</label>
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="start_preview" class="form-control" id="start_preview" min="1" value="" readonly>

                                        <span class="text-danger" id="amount_error"></span></div>
                                </div>
                                <label for="end_preview" class="col-sm-3 control-label">End Code</label>
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="end_preview" class="form-control" id="end_preview" min="1" value="" readonly>
                                        <span class="text-danger" id="amount_error"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="total_copy" class="col-sm-6 control-label">Total Number of Copies </label>
                            <div class="col-sm-6">

                                <input type="text" name="total_copy" class="form-control modal_amount" id="total_copy"  value="" readonly >

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="box-body">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn cfees save_button btn-success" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <i class="fa fa-book" aria-hidden="true"></i> Insert Copies </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>