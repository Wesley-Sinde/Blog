<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Student Book Return Over Period List</h4>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Reg.Num</th>
                    <th>Member Name</th>
                    <th>Ref. No.</th>
                    <th>Book Name</th>
                    <th>Issued On</th>
                    <th>Due Date</th>
                    <th>Day</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['student_return_over']) && $data['student_return_over']->count() > 0)
                    @php($i=1)
                    @foreach($data['student_return_over'] as $student_return_over)
                        <tr>
                            <td>{{ $i }}</td>
                            <td><a href="{{ route('library.student.view', ['id' => $student_return_over->stud_id]) }}"> {{ $student_return_over->reg_no }} </a></td>
                            <td><a href="{{ route('student.view', ['id' => $student_return_over->stud_id]) }}"> {{ $student_return_over->first_name.' '.$student_return_over->middle_name.' '. $student_return_over->last_name }}</a></td>
                            <td>{{ $student_return_over->book_code }} </td>

                            <td><a href="{{ route('library.book.view', ['id' => $student_return_over->bookmaster_id]) }}">{{ $student_return_over->title }}</a> </td>
                            <td>{{ \Carbon\Carbon::parse($student_return_over->issued_on)->format('Y-m-d') }} </td>
                            <td>{{ \Carbon\Carbon::parse($student_return_over->due_date)->format('Y-m-d') }} </td>
                            <td>
                                <div class="label label-danger label-lg ">
                                    {{ \Carbon\Carbon::parse($student_return_over->due_date)->diffForHumans(\Carbon\Carbon::now()) }}
                                </div>
                            </td>

                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">Student Book Return Over Period Not Found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>



