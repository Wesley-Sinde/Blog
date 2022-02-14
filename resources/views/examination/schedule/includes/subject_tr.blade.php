@foreach($subjects as $subject)
    <tr class="option_value">
    <td>
        <div class="btn-group">
            <label class="btn btn-xs btn-primary">
                <i class="ace-icon fa fa-arrows bigger-120"></i>
            </label>
        </div>
    </td>
    <td>
        <input type="hidden" name="sem_subject_id[]" value="{{ $subject->id }}">
        {!! Form::text('subjects_id[]', $subject->title, ['class' => 'form-control',"disabled"]) !!}
    </td>
    <td>
        {!! Form::text('date[]', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "required"]) !!}
    </td>
    <td>
        {!! Form::time('start_time[]', null, ["class" => "form-control border-form", "required"]) !!}
    </td>
    <td>
        {!! Form::time('end_time[]', null, ["class" => "form-control border-form", "required"]) !!}
    </td>
    <td>
        {!! Form::text('full_mark_theory[]', $subject->full_mark_theory, ["class" => "form-control border-form upper"]) !!}
    </td>
    <td>
        {!! Form::text('pass_mark_theory[]', $subject->pass_mark_theory, ["class" => "form-control border-form upper"]) !!}
    </td>
    <td>
        {!! Form::text('full_mark_practical[]', $subject->full_mark_practical, ["class" => "form-control border-form upper"]) !!}
    </td>
    <td>
        {!! Form::text('pass_mark_practical[]', $subject->pass_mark_practical, ["class" => "form-control border-form upper"]) !!}
    </td>
    <td>
        <div class="btn-group">
            <button type="button" class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                <i class="ace-icon fa fa-trash-o bigger-120"></i>
            </button>
        </div>
    </td>
</tr>
    @endforeach
@include('includes.scripts.inputMask_script')
@include('includes.scripts.datepicker_script')