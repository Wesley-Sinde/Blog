<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
        </div>
    <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data['roles']) && $data['roles']->count() > 0)
                        @php($i = 1)
                        @foreach($data['roles'] as $role)
                            <tr>
                                <td>{{ $i }}</td>
                                <td> {{ $role->name }} </td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="green" href="{{ route($base_route.'.edit', ['id' => $role->id]) }}">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                        @role('super-admin')
                                        <a href="{{ route($base_route.'.delete', ['id' => $role->id]) }}" class="red bootbox-confirm">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                        @endrole
                                    </div>
                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a href="{{ route($base_route.'.edit', ['id' => $role->id]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                    </span>
                                                    </a>
                                                </li>
                                                @role('super-admin')
                                                <li>
                                                    <a href="{{ route($base_route.'.delete', ['id' => $role->id]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
                                                    <span class="red ">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </span>
                                                    </a>
                                                </li>
                                                @endrole
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php($i++)
                        @endforeach
                    @else
                        <tr><td colspan="7">No data found.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>