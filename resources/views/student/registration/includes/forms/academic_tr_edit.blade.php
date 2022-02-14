@foreach($academicInfos as $academicInfo)
<tr class="option_value">
        <td>
            <div class="btn-group">
                <span class="btn btn-xs btn-primary" >
                    <i class="fa fa-arrows" aria-hidden="true"></i>
                </span>
            </div>
        </td>
        <td>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th class="align-right" style="border: none !important; background: none !important;">
                        Institution
                    </th>
                    <td>
                        {!! Form::hidden('academic_info_id[]', $academicInfo->id, ["class" => "col-xs-10 col-sm-11"]) !!}
                        {!! Form::text('institution[]', $academicInfo->institution, ["class" => "col-xs-10 col-sm-11"]) !!}
                    </td>
                </tr>
                <tr>
                    <th class="align-right" style="border: none !important; background: none !important;">
                        Board/Training
                    </th>
                    <td>
                        {!! Form::text('board[]', $academicInfo->board, ["class" => "col-xs-10 col-sm-11"]) !!}
                    </td>
                </tr>
                <tr>
                    <th class="align-right" style="border: none !important; background: none !important;">
                        Pass Year
                    </th>
                    <td>
                        {!! Form::text('pass_year[]', $academicInfo->pass_year, ["class" => "col-xs-10 col-sm-11"]) !!}
                    </td>
                </tr>
                <tr>
                    <th class="align-right" style="border: none !important; background: none !important;">
                        Symbol Number
                    </th>
                    <td>
                        {!! Form::text('symbol_no[]', $academicInfo->symbol_no, ["class" => "col-xs-10 col-sm-11"]) !!}
                    </td>
                </tr>
                <tr>
                    <th class="align-right" style="border: none !important; background: none !important;">
                        Percentage
                    </th>
                    <td>
                        {!! Form::text('percentage[]', $academicInfo->percentage, ["class" => "col-xs-10 col-sm-11"]) !!}
                    </td>
                </tr>
                <tr>
                    <th class="align-right" style="border: none !important; background: none !important;">
                        Division / Grade
                    </th>
                    <td>
                        {!! Form::text('division_grade[]', $academicInfo->division_grade, ["class" => "col-xs-10 col-sm-11"]) !!}
                    </td>
                </tr>
                <tr>
                    <th class="align-right" style="border: none !important; background: none !important;">
                        Major Subject
                    </th>
                    <td>
                        {!! Form::text('major_subjects[]', $academicInfo->major_subjects, ["class" => "col-xs-10 col-sm-11"]) !!}
                    </td>
                </tr>
                <tr>
                    <th class="align-right" style="border: none !important; background: none !important;">
                        Remark
                    </th>
                    <td>
                        {!! Form::text('remark[]', $academicInfo->remark, ["class" => "col-xs-10 col-sm-11"]) !!}
                    </td>
                </tr>
            </table>
        </td>
        <td width="5%">
            <div class="btn-group">
                @ability('super-admin', 'student-delete-academic-info')
                <a href="{{ route('student.delete-academicInfo', ['id' => $academicInfo->id]) }}" class="btn btn-danger btn-minier bootbox-confirm align-right" >
                    <i class="ace-icon fa fa-trash-o bigger-130"></i> Delete
                </a>
                @endability
            </div>

        </td>
    </tr>
@endforeach


