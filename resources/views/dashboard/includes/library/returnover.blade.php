<div class="table-responsive">
    <table class="table table-bordered table-striped">
    <thead class="thin-border-bottom">
    <tr>
        <th>
            <i class="ace-icon fa fa-caret-right blue"></i>SN
        </th>

        <th>
            <i class="ace-icon fa fa-caret-right blue"></i>Reg.No.
        </th>

        <th>
            <i class="ace-icon fa fa-book blue"></i>Book
        </th>

        <th>
            <i class="ace-icon fa fa-calendar blue"></i>Issueon
        </th>

        <th>
            <i class="ace-icon fa fa-calendar blue"></i>DueDate
        </th>

        <th>
            <i class="ace-icon fa fa-calendar blue"></i>DayOver
        </th>
    </tr>
    </thead>

    <tbody>

    @if (isset($data['book_return_over']) && $data['book_return_over']->count() > 0)
        @php($i=1)
        @foreach($data['book_return_over'] as $return_over)
            <tr>
                <td>{{ $i }}</td>
                <td>
                    @if($return_over->user_type == 1)
                        <a href="{{ route('library.student.view', ['id' => $return_over->member_id]) }}">
                            {{ $return_over->reg_no }}
                            <span class="label label-info arrowed-right arrowed-in">Student</span>
                        </a>
                    @else
                        <a href="{{ route('library.staff.view', ['id' => $return_over->member_id]) }}">
                            {{ $return_over->reg_no }}
                            <span class="label label-success arrowed-right arrowed-in">Staff</span>
                        </a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('library.book.view', ['id' => $return_over->bookmaster_id]) }}">
                        {{ $return_over->title }}
                    </a>
                </td>

                <td>{{ \Carbon\Carbon::parse($return_over->issued_on)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($return_over->due_date)->format('Y-m-d') }}</td>
                <td>
                    <div class="label label-danger label-lg ">
                        {{ \Carbon\Carbon::parse($return_over->due_date)->diffForHumans(\Carbon\Carbon::now()) }}
                    </div>
                </td>
            </tr>
            @php($i++)
        @endforeach
        <tr>
            <td class="center" colspan="6">
                <a class="green" href="{{ route('library.return-over') }}">More</a>
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