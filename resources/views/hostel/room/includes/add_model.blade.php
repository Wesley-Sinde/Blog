<!-- Modal -->
<div class="modal fade" id="addRooms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => 'hostel.bed.add', 'method' => 'POST', 'class' => 'form-horizontal',
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
                                    {!! Form::number('total',null, ['class' => 'form-control', "required", "readonly", "id"=>"total_beds", "min"=>"0" ]) !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="box-body">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn cfees save_button btn-success" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <i class="fa fa-bed" aria-hidden="true"></i> Add Beds </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>