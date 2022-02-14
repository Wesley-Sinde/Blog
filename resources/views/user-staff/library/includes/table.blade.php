<div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-history" aria-hidden="true"></i> Library History</h4>
            <div class="clearfix">
                <span class="pull-right tableTools-container"></span>
            </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Reference No</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Issued On</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                    <th>Day</th>
                    <th>Fine</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['books_history']) && $data['books_history']->count() > 0)
                    @php($i=1)
                    @foreach($data['books_history'] as $books_history)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $books_history->book_code }} </td>
                            <td>{{ $books_history->title }} </td>
                            <td>{{ ViewHelper::getBookCategoryById($books_history->categories) }} </td>
                            <td>{{ \Carbon\Carbon::parse($books_history->issued_on)->format('Y-m-d') }} </td>
                            <td>{{ \Carbon\Carbon::parse($books_history->due_date)->format('Y-m-d') }} </td>
                            @if(!isset($books_history->return_date) && $books_history->due_date >= \Carbon\Carbon::now()->format('Y-m-d'))
                                <td>
                                    <div class="label label-success label-lg ">
                                        {{  \Carbon\Carbon::parse($books_history->due_date)->diffForHumans(\Carbon\Carbon::now()) }}
                                    </div>
                                </td>
                            @elseif(isset($books_history->return_date))
                                <td>
                                    <div class="label label-info label-lg ">
                                        {{  \Carbon\Carbon::parse($books_history->return_date)->format('Y-m-d') }}<br>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div class="label label-danger label-lg ">
                                        {{  \Carbon\Carbon::parse($books_history->due_date)->diffForHumans(\Carbon\Carbon::now()) }}<br>
                                    </div>
                                </td>
                            @endif
                            <td>
                                <div class="label label-info label-lg ">
                                    {{ $day= (\Carbon\Carbon::parse($books_history->return_date)
                                    ->diffInDays(\Carbon\Carbon::parse($books_history->issued_on))) }}<br>
                                </div>
                            </td>
                            <td>
                                @if($day > $data['circulation']->issue_limit_days)
                                <div class="label label-danger label-lg ">
                                    {{ ($day - $data['circulation']->issue_limit_days) * $data['circulation']->fine_per_day }}
                                </div>
                                @endif
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



