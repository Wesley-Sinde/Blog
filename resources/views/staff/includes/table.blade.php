<div class="row">
    <div class="col-xs-12">
        @include('includes.data_table_header')
        <!-- div.table-responsive -->
        <div class="table-responsive">
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
                    {{--<th>Image</th>--}}
                    <th>Reg.Num</th>
                    <th>Staff Name</th>
                    <th>Phone</th>
                    <th>Designation</th>
                    <th>Qualification</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Service Activation</th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($data['staff']) && $data['staff']->count() > 0)
                        @php($i=1)
                        @foreach($data['staff'] as $staff)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $staff->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ $i }}</td>
                                {{--<td>
                                    <img src="{{ asset('images'.DIRECTORY_SEPARATOR.$folder_name.DIRECTORY_SEPARATOR.$staff->staff_image) }}"
                                         alt="{{ $staff->staff_image }}" class="img-responsive" width="80px">
                                </td>--}}
                                <td><a href="{{ route($base_route.'.view', ['id' => $staff->id]) }}">{{ $staff->reg_no }}</a></td>
                                <td><a href="{{ route($base_route.'.view', ['id' => $staff->id]) }}"> {{ $staff->first_name.' '.$staff->middle_name.' '. $staff->last_name }}</a></td>
                                <td><a href="tel:{{ $staff->mobile_1 }}">{{ $staff->mobile_1 }}</a> </td>
                                <td>{{ ViewHelper::getDesignationId($staff->designation) }}</td>
                                <td>{{ $staff->qualification }}
                                </td>
                                <td class="hidden-480 ">
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $staff->status == 'active'?"btn-info":"btn-warning" }}" >
                                            {{ $staff->status == 'active'?"Active":"In Active" }}
                                            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route($base_route.'.active', ['id' => $staff->id]) }}" title="Active"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            </li>

                                            <li>
                                                <a href="{{ route($base_route.'.in-active', ['id' => $staff->id]) }}" title="In-Active"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a href="{{ route($base_route.'.view', ['id' => $staff->id]) }}" class="btn btn-primary btn-minier">
                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                        </a>

                                        <a href="{{ route($base_route.'.edit', ['id' => $staff->id]) }}" class="btn btn-success btn-minier">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>

                                        <a href="{{ route($base_route.'.delete', ['id' => $staff->id]) }}" class="btn btn-danger btn-minier bootbox-confirm" >
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
                                                    <a href="{{ route($base_route.'.view', ['id' => $staff->id]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="blue">
                                                        <i class="ace-icon fa fa-eye bigger-120"></i>
                                                    </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route($base_route.'.edit', ['id' => $staff->id]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                    </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ route($base_route.'.delete', ['id' => $staff->id]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
                                                            <span class="red ">
                                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                            </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a href="{{ route('library.member.quick-membership', ['reg_no' => $staff->reg_no,'user_type' => 2,'status' => 'active',]) }}" class="btn btn-primary btn-minier">
                                            <i class="ace-icon fa fa-book bigger-130"></i>
                                        </a>

                                        <a class="open-ActiveAgain label label-primary" data-toggle="modal"
                                           data-target="#activeAgain"
                                           data-id="{{ $staff->id }}"
                                           data-reg="{{ $staff->reg_no }}">
                                         <span>
                                             <i class="ace-icon fa fa-bed bigger-130"></i>
                                         </span>
                                        </a>

                                        <a class="open-TransportActiveAgain label label-primary" data-toggle="modal"
                                           data-target="#TransportActiveAgain"
                                           data-id="{{ $staff->id }}"
                                           data-reg="{{ $staff->reg_no }}">
                                         <span>
                                             <i class="ace-icon fa fa-bus bigger-130"></i>
                                         </span>
                                        </a>
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
            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>