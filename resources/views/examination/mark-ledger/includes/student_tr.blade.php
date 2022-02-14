@foreach($students as $student)
    <tr class="option_value">
        <td>
            <div class="btn-group">
                <label class="btn btn-xs btn-primary">
                    <i class="ace-icon fa fa-arrows bigger-120"></i>
                </label>
            </div>
        </td>
        <td>
            <input type="hidden" name="students_id[]" value="{{ $student->id }}">
            {{ $student->reg_no }}
        </td>
        <td>
            {{ $student->first_name.' '.$student->middle_name.' '.$student->last_name }}
        </td>
        <td>
            {!! Form::checkbox('absent_theory[]', $student->id, false, ['class' => 'form-control']) !!}
        </td>
        <td>
            {!! Form::number('obtain_mark_theory[]', null, ["class" => "form-control border-form","min"=>"0",'step'=>'any']) !!}
        </td>
        <td>
            {!! Form::checkbox('absent_practical[]', $student->id, false, ['class' => 'form-control']) !!}
        </td>
        <td>
            {!! Form::number('obtain_mark_practical[]', null, ["class" => "form-control border-form","min"=>"0",'step'=>'any']) !!}
        </td>

        <td>
            <div class="btn-group">
                <label class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                </label>
            </div>
        </td>
    </tr>
 @endforeach
