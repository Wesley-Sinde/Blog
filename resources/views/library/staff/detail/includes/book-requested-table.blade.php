<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i> Requested Book List</h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        {{--<div class="table-header">
            {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
        </div>--}}
    <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>RequestOn</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['book_request']) && $data['book_request']->count() > 0)
                    @php($i=1)
                    @foreach($data['book_request'] as $requestedBook)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                @if($requestedBook->image)
                                    <img src="{{ asset('images'.DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$requestedBook->image) }}"
                                         class="img-responsive" width="40px">
                                @endif
                            </td>
                            <td>{{ $requestedBook->title }}</td>
                            <td>
                                {{ $requestedBook->author }}
                            </td>
                            <td>
                                {{ $requestedBook->requested_date }}
                            </td>
                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a type="button" class="label label-primary label-lg white add-request-book-list" data-bookid="{{$requestedBook->id}}">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add On Issue List
                                    </a>

                                    <a href="{{ route('library.request-cancel', ['id' => encrypt($requestedBook->id),'member' => encrypt($data['staff']->id)]) }}" class="btn btn-danger btn-minier">
                                        <i class="ace-icon fa fa-trash bigger-130"></i> Cancel
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="12">No any book requested yet.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


