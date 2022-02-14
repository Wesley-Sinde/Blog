<div class="table-responsive">
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>S.N.</th>
            <th>Reg.Num</th>
            <th>Staff Name</th>
            <th>Designation</th>
            <th>DateofBirth</th>
            {{--<th>Age</th>--}}
        </tr>
        </thead>
        <tbody>
        @if (isset($data['staff_birthday']) && $data['staff_birthday']->count() > 0)
            @php($i=1)
            @foreach($data['staff_birthday'] as $staff)
                <tr>
                    <td>{{ $i }}</td>
                    <td><a href="{{ route('staff.view', ['id' => $staff->id]) }}">{{ $staff->reg_no }}</a></td>
                    <td><a href="{{ route('staff.view', ['id' => $staff->id]) }}"> {{ $staff->first_name.' '.$staff->middle_name.' '. $staff->last_name }}</a></td>
                    <td>{{ ViewHelper::getDesignationId($staff->designation) }}</td>
                    <td>{{\Carbon\Carbon::parse($staff->date_of_birth)->format('Y-m-d')}}</td>
                    {{--<td>{{\Carbon\Carbon::parse($staff->date_of_birth)->age}}</td>--}}
                </tr>
                @php($i++)
            @endforeach
        @else
            <tr>
                <td colspan="11">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
