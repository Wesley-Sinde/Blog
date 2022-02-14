<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Notes List</h4>

        <!-- div.table-responsive -->
        <div class="table-responsive">
            {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}

            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th width="5%">S.N.</th>
                    <th>Subject</th>
                    <th>Note Description</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['note']) && $data['note']->count() > 0)
                    @php($i=1)
                    @foreach($data['note'] as $note)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $note->subject }}</td>
                            <td>{{ $note->note }}</td>
                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">

                                    <a href="{{ route('vendor.note.edit', ['id' => encrypt($note->id)]) }}" class="btn btn-primary btn-minier btn-success">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>

                                    <a href="{{ route('vendor.note.delete', ['id' => encrypt($note->id)]) }}" class="btn btn-primary btn-minier btn-danger bootbox-confirm" >
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="align-left" >No {{ $panel }} notes data found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
</div>