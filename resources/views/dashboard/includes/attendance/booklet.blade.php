<div class="table-responsive">
    <table class="table table-bordered table-striped">
    <thead class="thin-border-bottom">
    <tr>
        <th>
            <i class="ace-icon fa fa-caret-right blue"></i>SN
        </th>
        <th><i class="ace-icon fa fa-calendar blue"></i>Year</th>
        <th><i class="ace-icon fa fa-calendar blue"></i>Month</th>
        <th><i class="ace-icon fa fa-calendar blue"></i>Day in Month</th>
        <th><i class="ace-icon fa fa-calendar blue"></i>Holiday</th>
        <th><i class="ace-icon fa fa-calendar blue"></i>Open Day</th>
    </tr>
    </thead>

    <tbody>

    @if (isset($data['attendance_booklet']) && $data['attendance_booklet']->count() > 0)
        @php($i=1)
        @foreach($data['attendance_booklet'] as $booklet)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ ViewHelper::getYearById($booklet->year) }} </td>
                <td>{{ ViewHelper::getMonthById($booklet->month) }} </td>
                <td>{{ $booklet->day_in_month }} </td>
                <td>{{ $booklet->holiday }} </td>
                <td>{{ $booklet->open }} </td>
            </tr>
            @php($i++)
        @endforeach
        <tr>
            <td class="center" colspan="6">
                <a class="green" href="{{ route('attendance.master') }}">More</a>
            </td>
        </tr>
    @else
        <tr>
            <td colspan="11">No data found.</td>
        </tr>
    @endif

    </tbody>
</table>
</div>