<h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
<div class="clearfix hidden-print">
            <span>
                <a class="btn-danger btn-sm bulk-action-btn" attr-action-type="delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</a>
                <a type="button" class="btn-primary btn-sm open-AddBookCopy" data-toggle="modal"
                        data-target="#addBookCopies"
                        data-id="{{ $data['books']->id }}"
                        data-book-title = "{{ $data['books']->title }}"
                        data-book-code = "{{ $data['books']->code }}" >
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp Add Copies
                </a>
            </span>
    <span class="pull-right tableTools-container"></span>
</div>
<div class="table-header hidden-print">
    {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
</div>
<div>
    {!! Form::open(['route' => $base_route.'.bulk-copies-delete', 'id' => 'bulk_action_form']) !!}
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr >
                    <th class="center" width="5%" >
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th width="5%" >S.N.</th>
                    <th width="50%">Book Code</th>
                    <th width="30%">Status</th>
                    <th width="10%"></th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($data['books_collection']) && $data['books_collection']->count() > 0)
                        @php($i=1)
                        @foreach($data['books_collection'] as $books)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $books->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ $i }}</td>
                                <td>{{ $books->book_code }}</td>
                                <td><div class="label {{ ViewHelper::getBookStatusClassById($books->book_status) }}">{{ ViewHelper::getBookStatusById($books->book_status) }} </div></td>
                                <td class="hidden-480 ">
                                    <div class="btn-group hidden-print ">
                                        <button data-toggle="dropdown" class="btn btn-minier btn-primary dropdown-toggle" >
                                            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                        </button>
                                        <ul class="dropdown-menu " >
                                            @if (isset($data['books_status']) && $data['books_status']->count() > 0)
                                                @foreach($data['books_status'] as $books_status)
                                                    <li>
                                                        <a href="{{ route($base_route.'.book-status', ['id' => $books->id,'status' => $books_status->id ]) }}">
                                                            {{ $books_status->title }}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                @else
                                                    <li>
                                                        No Status
                                                    </li>
                                            @endif
                                        </ul>

                                    </div>

                                </td>
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
    {!! Form::close() !!}
</div>