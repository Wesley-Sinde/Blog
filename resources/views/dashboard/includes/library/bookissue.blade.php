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
            <i class="ace-icon fa fa-calendar blue"></i>Issued On
        </th>

        <th>
            <i class="ace-icon fa fa-calendar blue"></i>Due Date
        </th>

        <th>
            <i class="ace-icon fa fa-history blue"></i>Status
        </th>
    </tr>
    </thead>

    <tbody>

    @if (isset($data['book_issued']) && $data['book_issued']->count() > 0)
        @php($i=1)
        @foreach($data['book_issued'] as $bookIssue)
            <tr>
                <td>{{ $i }}</td>
                <td>
                    @if($bookIssue->user_type == 1)
                    <a href="{{ route('library.student.view', ['id' => $bookIssue->member_id]) }}">
                        {{ $bookIssue->reg_no }}
                        <span class="label label-info arrowed-right arrowed-in">Student</span>
                    </a>
                    @else
                        <a href="{{ route('library.staff.view', ['id' => $bookIssue->member_id]) }}">
                            {{ $bookIssue->reg_no }}
                            <span class="label label-success arrowed-right arrowed-in">Staff</span>
                        </a>
                        @endif
                </td>
                <td>
                    <a href="{{ route('library.book.view', ['id' => $bookIssue->bookmaster_id]) }}">
                        {{ $bookIssue->title }}
                    </a>
                </td>

                <td>{{ \Carbon\Carbon::parse($bookIssue->issued_on)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($bookIssue->due_date)->format('Y-m-d') }}</td>
                <td>
                    @if($bookIssue->due_date >  Carbon\Carbon::now())
                        <div class="label label-primary label-sm arrowed-in arrowed-right arrowed">
                            {{ \Carbon\Carbon::parse($bookIssue->due_date)->diffForHumans(\Carbon\Carbon::now()) }}<br>
                        </div>
                    @else
                        <div class="label label-danger label-sm arrowed-in arrowed-right arrowed">
                            {{ \Carbon\Carbon::parse($bookIssue->due_date)->diffForHumans(\Carbon\Carbon::now()) }}<br>
                        </div>
                    @endif
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