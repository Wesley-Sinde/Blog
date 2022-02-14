<div class="table-responsive">
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>S.N.</th>
            <th>Faculty/Class</th>
            <th>Sem./Sec.</th>
            <th>Reg.Num</th>
            <th>Student Name</th>
            <th>DateofBirth</th>
            {{--<th>Age</th>--}}
        </tr>
        </thead>
        <tbody>
        @if (isset($data['student_birthday']) && $data['student_birthday']->count() > 0)
            @php($i=1)
            @foreach($data['student_birthday'] as $student)
                <tr>
                    <td>{{ $i }}</td>
                    <td> {{  ViewHelper::getFacultyTitle( $student->faculty ) }}</td>
                    <td> {{  ViewHelper::getSemesterTitle( $student->semester ) }}</td>
                    {{--<td>{{ \Carbon\Carbon::parse($student->reg_date)->format('Y-m-d')}} </td>--}}
                    <td><a href="{{ route('student.view', ['id' => $student->id]) }}">{{ $student->reg_no }}</a></td>
                    <td><a href="{{ route('student.view', ['id' => $student->id]) }}"> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</a></td>
                    <td>{{\Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d')}}</td>
                    {{--<td>{{\Carbon\Carbon::parse($student->date_of_birth)->age}}</td>--}}
                </tr>
                @php($i++)
            @endforeach
        @else
            <tr>
                <td colspan="7">No Birthday data found.</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
