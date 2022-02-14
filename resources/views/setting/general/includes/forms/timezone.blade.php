<div class="form-group">
    <label class="col-sm-2 control-label">TimeZone</label>
    <div class="col-sm-6">
        {{-- {!! Form::select('faculty', $data['timezones'], null, ['class' => 'form-control', 'onChange' => 'loadSemesters(this);', "required"]) !!}--}}
        @if(isset($data['row']))
        <select name="time_zones_id" class="form-control chosen-select" id="form-field-select-3" data-placeholder="Choose a Time Zone...">
            @foreach( $data['timezones'] as $key => $timezone)
                <option value="{{ $key }}" {{ ($data['row']->time_zones_id == $key)?"selected":"" }} >{{ $timezone }}</option>
            @endforeach
        </select>
        @else
            <select name="time_zones_id" class="form-control chosen-select" id="form-field-select-3" data-placeholder="Choose a Time Zone...">
                @foreach( $data['timezones'] as $key => $timezone)
                    <option value="{{ $key }}" >{{ $timezone }}</option>
                @endforeach
            </select>
        @endif
    </div>
</div>
