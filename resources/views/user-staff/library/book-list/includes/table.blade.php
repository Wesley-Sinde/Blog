<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        {{--<div class="table-header">
            {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
        </div>--}}
    <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    {{--<th class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>--}}
                    <th>S.N.</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    {{--<th>Total</th>
                    <th>Issued</th>--}}
                    <th>Available?</th>
                    <th>Request?</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['books']) && $data['books']->count() > 0)
                    @php($i=1)
                    @foreach($data['books'] as $books)
                        <tr>
                            {{--<td class="center first-child">
                                <label>
                                    <input type="checkbox" name="chkIds[]" value="{{ $books->id }}" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>--}}
                            <td>{{ $i }}</td>
                            <td>
                                <a href="{{ route('user-staff.library.book-list') }}?categories={{$books->categories}}">
                                    {{ ViewHelper::getBookCategoryById( $books->categories) }}
                                </a>
                            </td>
                            <td>
                                @if($books->image)
                                    <img src="{{ asset('images'.DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$books->image) }}"
                                         class="img-responsive" width="40px">
                                @endif
                            </td>
                            <td>{{ $books->title }}</td>
                            <td>
                                <a href="{{ route('user-staff.library.book-list') }}?author={{$books->author}}">
                                    {{ $books->author }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('user-staff.library.book-list') }}?publisher={{$books->publisher}}">
                                    {{ $books->publisher }}
                                </a>
                            </td>
                            <td>
                                @php($availableCount = $books->bookCollection()->where('book_status','=',1)->count())
                                @if($availableCount > 0)
                                    <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle btn-success" >
                                        Available-{{ $books->bookCollection()->where('book_status','=',1)->count() }}
                                    </button>
                                @else
                                    <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle btn-warning" >
                                        Not Available
                                    </button>
                                @endif

                            </td>
                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    @if(!in_array($books->id,$data['book_request_ids']))
                                        <a href="{{ route('user-staff.library.request-book', ['id' => encrypt($books->id)]) }}" class="btn btn-primary btn-minier">
                                            <i class="ace-icon fa fa-arrow-left bigger-130"></i> Request
                                        </a>
                                    </div>
                                    @else
                                        {{--<button data-toggle="dropdown" class="btn btn-success btn-minier dropdown-toggle btn-success" >
                                            Requested
                                        </button>--}}
                                        <a href="#" class="btn btn-success btn-minier">
                                            <i class="ace-icon fa fa-check bigger-130"></i> Requested
                                        </a>
                                        <a href="{{ route('library.request-cancel', ['id' => encrypt($books->id),'member' => encrypt($data['lib_member']->id)]) }}" class="btn btn-danger btn-minier">
                                            <i class="ace-icon fa fa-trash bigger-130"></i> Cancel
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="12">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


