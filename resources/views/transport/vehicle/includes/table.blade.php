<div class="row">
    <div class="col-xs-12">
        @include('includes.data_table_header')
        <!-- div.table-responsive -->
        <div>
            {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}

                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </th>
                            <th>S.N.</th>
                            <th>Detail</th>
                            <th>Staffs</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($data['vehicle']) && $data['vehicle']->count() > 0)
                            @php($i=1)
                            @foreach($data['vehicle'] as $vehicle)
                                <tr>
                                    <td class="center first-child">
                                        <label>
                                            <input type="checkbox" name="chkIds[]" value="{{ $vehicle->id }}" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </td>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="width-80 label label-info label-xlg arrowed-in arrowed-right">
                                                        <div class="inline position-relative">
                                                            <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                                                <span class="white">{{$vehicle->number}}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Type</td>
                                                <td>{{ $vehicle->type }}</td>
                                            </tr>
                                            <tr>
                                                <td>Model</td>
                                                <td>{{ $vehicle->model }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">{{ $vehicle->description }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-striped table-bordered table-hover">
                                            @if(isset($vehicle->staff))
                                                @foreach($vehicle->staff as $staff)
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="center">
                                                                <div>
                                                                    <span class="profile-picture">
                                                                        @if($staff->staff_image != '')
                                                                            <img class="editable img-responsive" alt="" src="{{ asset('images'.DIRECTORY_SEPARATOR.'staff'.DIRECTORY_SEPARATOR.$staff->staff_image) }}" width="100px" />
                                                                        @endif
                                                                    </span>
                                                                    <div class="space-4"></div>
                                                                    <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                                                        <div class="inline position-relative">
                                                                            <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                                                                <span class="white">{{ $staff->first_name.' '.$staff->middle_name.' '.$staff->last_name }}</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>HomePhone</td>
                                                        <td>{{ $staff->home_phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile</td>
                                                        <td>{{ $staff->mobile_1 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address</td>
                                                        <td>{{ $staff->address }}</td>
                                                    </tr>

                                                @endforeach
                                            @endif
                                        </table>
                                    </td>
                                    <td class="hidden-480 ">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $vehicle->status == 'active'?"btn-info":"btn-warning" }}" >
                                                {{ $vehicle->status == 'active'?"Active":"In Active" }}
                                                <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                            </button>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route($base_route.'.active', ['id' => $vehicle->id]) }}"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                </li>

                                                <li>
                                                    <a href="{{ route($base_route.'.in-active', ['id' => $vehicle->id]) }}"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
                                            <a class="green" href="{{ route($base_route.'.edit', ['id' => $vehicle->id]) }}">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                            </a>

                                            <a href="{{ route($base_route.'.delete', ['id' => $vehicle->id]) }}" class="red bootbox-confirm">
                                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                            </a>
                                        </div>
                                        <div class="hidden-md hidden-lg">
                                            <div class="inline pos-rel">
                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                    <li>
                                                        <a href="{{ route($base_route.'.edit', ['id' => $vehicle->id]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                            <span class="green">
                                                                <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route($base_route.'.delete', ['id' => $vehicle->id]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
                                                            <span class="red ">
                                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php($i++)
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            {!! Form::close() !!}
        </div>
    </div>
</div>