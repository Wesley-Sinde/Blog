<table class="tab-content">
    <tr>
        <td class="text-right">Name</td>
        <td> : </td>
        <td>{{ $data['student']->first_name.' '.$data['student']->middle_name.' '.$data['student']->last_name }}</td>

        <td class="text-right">Reg No.</td>
        <td> : </td>
        <td>{{ $data['student']->reg_no }}</td>
    </tr>
    <tr>
        <td colspan="6">
            <hr class="hr hr-2">
        </td>
    </tr>
    <tr>
        <td class="text-right">Faculty/Class</td>
        <td> : </td>
        <td>{{ ViewHelper::getFacultyTitle($data['student']->faculty) }}</td>
        <td class="text-right">Sem./Sec.</td>
        <td> : </td>
        <td>{{ ViewHelper::getSemesterTitle($data['student']->semester) }}</td>
    </tr>
</table>
<hr class="hr hr-2">
