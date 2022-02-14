<div class="form-horizontal">
    <div class="row">
        <div class="col-xs-12">
            @include('includes.data_table_header')
            <!-- div.table-responsive -->
                <div class="table-responsive">
                    {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th class="center">
                                        <label class="pos-rel">
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </th>
                                    <th>S.N.</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Ref</th>
                                    <th>From</th>
                                    <th>To </th>
                                    <th>Subject</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($data['postal-exchange']) && $data['postal-exchange']->count() > 0)
                                    @php($i=1)
                                    @foreach($data['postal-exchange'] as $exchange)
                                        <tr>
                                            <td class="center first-child">
                                                <label>
                                                    <input type="checkbox" name="chkIds[]" value="{{ encrypt($exchange->id) }}" class="ace" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td>{{ $i }}</td>
                                            <td class="text-uppercase"> {{$exchange->type}} </td>
                                            <td> {{\Carbon\Carbon::parse($exchange->date)->format('Y-M-d')}} </td>
                                            <td> {{$exchange->ref_no}} </td>
                                            <td> {{$exchange->from}} </td>
                                            <td> {{$exchange->to}} </td>
                                            <td> {{$exchange->subject}} </td>
                                            <td>
                                                @if(isset($exchange->attachment) && $exchange->attachment !=='')
                                                    <a href="{{ asset('postalExchange'.DIRECTORY_SEPARATOR.$exchange->attachment) }}" target="_blank">
                                                        <i class="ace-icon fa fa-download bigger-130"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="hidden-sm hidden-xs action-buttons">
                                                    <a class="green" href="{{ route($base_route.'.edit', ['id' => encrypt($exchange->id)]) }}">
                                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                    </a>

                                                    <a href="{{ route($base_route.'.delete', ['id' => encrypt($exchange->id)]) }}" class="red bootbox-confirm">
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
                                                                <a href="{{ route($base_route.'.edit', ['id' => encrypt($exchange->id)]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                    <span class="green">
                                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="{{ route($base_route.'.delete', ['id' => encrypt($exchange->id)]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
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
                                        <td colspan="10">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    {!! Form::close() !!}
                </div>
        </div>
    </div>
</div>

