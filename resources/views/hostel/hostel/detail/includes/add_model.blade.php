<!-- Modal -->
<div class="modal fade" id="addRooms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => $base_route.'.room.add', 'method' => 'POST', 'class' => 'form-horizontal',
                       'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

        <div class="modal-content">
            <div class="modal-header">
                {{--<button type="button" class="close top-close" data-dismiss="modal" id="close-button">×</button>
                <h4 class="modal-title title text-center fees_title" id="MasterTitle"><b>Class 6 General:</b> admission-fees</h4>--}}
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body">
                        <input type="hidden" name="hostelId" id="hostelId" value=""/>
                        <div class="form-group mb0">
                            <div class="col-sm-12">
                                {!! Form::label('start', 'Start', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-2">
                                    {!! Form::number('start',null, ['class' => 'form-control', "required", "onkeyup"=>"changeStartCode()", "id"=>"start", "min"=>"1"]) !!}
                                </div>

                                {!! Form::label('end', 'End', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-2">
                                    {!! Form::number('end',null, ['class' => 'form-control', "required","onkeyup"=>"changeEndCode()", "id"=>"end", "min"=>"1" ]) !!}
                                </div>

                                {!! Form::label('total', 'Total', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-2">
                                    {!! Form::number('total',null, ['class' => 'form-control', "required", "readonly", "id"=>"total_room", "min"=>"0" ]) !!}
                                </div>

                                {{--<label for="start" class="col-sm-2 control-label">Start</label>
                                <div class="col-md-2 col-sm-2">
                                    <div class="form-group">
                                        <input type="number" name="start" class="form-control" id="start" value="" required onkeyup="changeStartCode()">

                                        <span class="text-danger" id="amount_error"></span></div>
                                </div>
                                <label for="end" class="col-sm-2 control-label">End</label>
                                <div class="col-md-2 col-sm-2">
                                    <div class="form-group">
                                        <input type="number" name="end" class="form-control" id="end" required >
                                        <span class="text-danger" id="amount_error"></span></div>
                                </div>
                                <label for="total_copy" class="col-sm-2 control-label">Total</label>
                                <div class="col-sm-2">
                                    <input type="text" name="total_room" class="form-control modal_amount" id="total_room"  value="" readonly >
                                    <span class="text-danger" id="amount_error"></span>
                                </div>--}}
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-sm-12">
                                {!! Form::label('room_type', 'RoomType', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-6">
                                    {!! Form::select('room_type', $data['room_type'], null, ['class' => 'form-control', "required"]) !!}
                                </div>

                                {!! Form::label('rate_perbed', 'Rate/Bed', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-2">
                                    {!! Form::number('rate_perbed',null, ['class' => 'form-control', "required"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="box-body">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn cfees save_button btn-success" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <i class="fa fa-home" aria-hidden="true"></i> Add Rooms </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>