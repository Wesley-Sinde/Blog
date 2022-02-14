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
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Type</th>
                    <th>SendTo</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['rows']) && $data['rows']->count() > 0)
                    @php($i = 1)
                    @foreach($data['rows'] as $row)
                        <tr>
                            <td class="center" width="3%">
                                <label>
                                    <input type="checkbox" name="chkIds[]" value="{{ $row->id }}" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td width="4%">{{ $i }}</td>

                            <td width="20%"> {{ $row->subject }} </td>
                            <td>{!! $row->message !!}</td>
                            <td width="5%">
                                @if($row->sms == 1 && $row->email == 1)
                                    <div class="label label-info arrowed-right arrowed-in">
                                        SMS
                                    </div>
                                <hr class="hr-2">
                                    <div class="label label-primary arrowed-right arrowed-in">
                                        Email
                                    </div>
                                @elseif($row->sms == 1)
                                    <div class="label label-info arrowed-right arrowed-in">
                                        SMS
                                    </div>
                                @elseif($row->email == 1)
                                    <div class="label label-primary arrowed-right arrowed-in">
                                        Email
                                    </div>
                                @endif
                            </td>
                            <td width="10%">
                                @if(isset($row->group) && $row->group != 0)
                                    @php($groups = explode(',',$row->group))
                                    @foreach($groups as $group)
                                        <div class="label label-info arrowed-right arrowed-in">
                                            {{\App\Facades\ViewHelperFacade::getRoleNameId($group)}}
                                        </div>
                                        <hr class="hr-2">
                                        @endforeach
                                @else
                                    <div class="label label-info arrowed-right arrowed-in">
                                        Individuals
                                    </div>
                                @endif
                            </td>
                            <td width="5%">
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a href="{{ route($base_route.'.delete', ['id' => $row->id]) }}" class="red bootbox-confirm">
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
                                                <a href="{{ route($base_route.'.delete', ['id' => $row->id]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
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
                    {!! Form::close() !!}

                @else
                    <tr><td colspan="7">No data found.</td></tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>