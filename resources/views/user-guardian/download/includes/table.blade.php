<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;Available Download </h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Files</th>
                    <th>Description</th>
                    <th><i class="ace-icon fa fa-download bigger-120"></i> &nbsp;Download</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['download']) && $data['download']->count() > 0)
                    @php($i=1)
                    @foreach($data['download'] as $download)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <a href="{{ asset('downloads'.DIRECTORY_SEPARATOR.$download->file) }}" target="_blank">
                                    {{ $download->title }}
                                </a>
                            </td>
                            <td>{{ $download->description }}</td>
                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a href="{{ asset('downloads'.DIRECTORY_SEPARATOR.$download->file) }}" target="_blank" class="btn btn-primary btn-minier">
                                        <i class="ace-icon fa fa-download bigger-130"></i> Download
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
</div>