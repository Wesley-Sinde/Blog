<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;History List</h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            History Record list on table. Filter list using the search box as you wish.
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover ">
                <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Reg. Num.</th>
                    <th>Reference No</th>
                    <th>Book</th>
                    <th>Category</th>
                    <th>Issued On</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                    <th>Day</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['history']) && $data['history']->count() > 0)
                    @php($i=1)
                    @foreach($data['history'] as $history)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                @if($history->libMember['user_type'] == 1)
                                    <a href="{{ route('library.student.view', ['id' => $history['member_id']]) }}">
                                        {{ ViewHelper::getStudentById($history->libMember['member_id']) }}
                                        <span class="label label-info arrowed-right arrowed-in">Student</span>
                                    </a>
                                @else
                                    <a href="{{ route('library.staff.view', ['id' => $history['member_id']]) }}">
                                        {{ ViewHelper::getStaffById($history->libMember['member_id']) }}
                                        <span class="label label-success arrowed-right arrowed-in">Staff</span>
                                    </a>
                                @endif

                            </td>
                            <td>{{ $history->book_code }} </td>
                            <td>
                                <a href="{{ route('library.book.view', ['id' => $history->book_masters_id]) }}">
                                    {{ $history->title }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('library.book') }}?categories={{$history->categories}}">
                                    {{ ViewHelper::getBookCategoryById($history->categories) }}
                                </a>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($history->issued_on)->format('Y-m-d') }} </td>
                            <td>{{ \Carbon\Carbon::parse($history->due_date)->format('Y-m-d') }} </td>
                            @if(!isset($history->return_date) && $history->due_date >= \Carbon\Carbon::now()->format('Y-m-d'))
                                <td>
                                    <div class="label label-success label-lg ">
                                        {{  \Carbon\Carbon::parse($history->due_date)->diffForHumans(\Carbon\Carbon::now()) }}
                                    </div>
                                </td>
                            @elseif(isset($history->return_date))
                                <td>
                                    <div class="label label-info label-lg ">
                                        {{  \Carbon\Carbon::parse($history->return_date)->format('Y-m-d') }}<br>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div class="label label-danger label-lg ">
                                        {{  \Carbon\Carbon::parse($history->due_date)->diffForHumans(\Carbon\Carbon::now()) }}<br>
                                    </div>
                                </td>
                            @endif
                            <td>
                                <div class="label label-info label-lg ">
                                    {{ $day=  (\Carbon\Carbon::parse($history->return_date)
                                    ->diffInDays(\Carbon\Carbon::parse($history->issued_on))) }}<br>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">Book Issued History Not Found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>



