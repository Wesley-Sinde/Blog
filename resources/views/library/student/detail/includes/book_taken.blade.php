<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Book Taken List</h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
       {{-- <div class="table-header">
            Book Taken List  Record list on table. Filter list using the search box as you wish.
        </div>--}}
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="" class="table table-striped table-bordered table-hover ">
                <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Ref. No.</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Issued On</th>
                    <th>Due Date</th>
                    <th>Day</th>
                    <th>Fine</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['books_taken']) && $data['books_taken']->count() > 0)
                    @php($i=1)
                    @foreach($data['books_taken'] as $book_taken)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $book_taken->book_code }} </td>
                            <td>
                                @if($book_taken->image)
                                    <img id="avatar" class="editable img-responsive" alt="{{ $book_taken->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$book_taken->image) }}" style="width: 35px;" />
                                @endif
                            </td>
                            <td>{{ $book_taken->title }} </td>
                            <td>{{ ViewHelper::getBookCategoryById($book_taken->categories) }} </td>
                            <td>{{ \Carbon\Carbon::parse($book_taken->issued_on)->format('Y-m-d') }} </td>
                            <td>{{ \Carbon\Carbon::parse($book_taken->due_date)->format('Y-m-d') }}<br>
                                @if($book_taken->due_date >  Carbon\Carbon::now())
                                    <div class="label label-success label-sm arrowed-in arrowed-right arrowed">
                                        {{ \Carbon\Carbon::parse($book_taken->due_date)->diffForHumans(\Carbon\Carbon::now()) }}<br>
                                    </div>
                                @else
                                    <div class="label label-danger label-sm arrowed-in arrowed-right arrowed">
                                        {{ \Carbon\Carbon::parse($book_taken->due_date)->diffForHumans(\Carbon\Carbon::now()) }}<br>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @php($day = (\Carbon\Carbon::parse($book_taken->return_date)
                                        ->diffInDays(\Carbon\Carbon::parse($book_taken->issued_on))))
                                @if($day>0)
                                    <div class="label label-info label-lg">
                                        {{ $day }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($day > $data['circulation']->issue_limit_days)
                                    {{ ($day - $data['circulation']->issue_limit_days) * $data['circulation']->fine_per_day }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('library.return', ['id' => $book_taken->book_id, 'member_id' => $data['student']->id]) }}" class="btn btn-xs btn-primary">
                                    <i class="fa fa-backward"></i> Return
                                </a>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">Book Taken Data Not Found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


