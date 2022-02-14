<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Document List</h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            Document Record list on table. Filter list using search box as your Wish.
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr >
                    <th width="5%">S.N.</th>
                    <th>Document With Link</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($data['document']) && $data['document']->count() > 0)
                        @php($i=1)
                        @foreach($data['document'] as $document)
                            <tr>
                                <td>{{ $i }}</td>
                                <td class="text-left">
                                    <a href="{{ asset('documents'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.ViewHelper::getVendorById( $document->member_id ).DIRECTORY_SEPARATOR.$document->file) }}" target="_blank">
                                        <i class="ace-icon fa fa-download bigger-120"></i> &nbsp;{{ $document->title }}
                                    </a>
                                </td>
                                <td class="text-left">{{ $document->description }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('vendor.document.edit', ['id' => encrypt($document->id)]) }}" class="btn btn-primary btn-minier btn-success">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>

                                        <a href="{{ route('vendor.document.delete', ['id' => encrypt($document->id)]) }}" class="btn btn-primary btn-minier btn-danger bootbox-confirm" >
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @php($i++)
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="align-left">No {{ $panel }} documents data found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div><!-- /.row -->