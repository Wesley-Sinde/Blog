<!-- Modal -->
<div class="modal fade" id="editRooms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => ['hostel.room.update', 1], 'method' => 'POST', 'class' => 'form-horizontal',
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
                        <input type="hidden" name="roomId" id="roomId" value=""/>
                        <div class="form-group mb0">
                            <div class="col-sm-12">
                                {!! Form::label('room_number', 'Room Number', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('room_number',null, ['class' => 'form-control', "id"=>"room_number"]) !!}
                                </div>
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
                                    {!! Form::number('rate_perbed',null, ['class' => 'form-control',"id"=>"rate_perbed", "required"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="box-body">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn cfees save_button btn-success" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <i class="fa fa-home" aria-hidden="true"></i> Update Rooms </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>