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
                        <th>Hostel</th>
                        <th>Day</th>
                        <th>Eating Time</th>
                        <th>Food Item</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data['food_schedule']) && $data['food_schedule']->count() > 0)
                        @php($i=1)
                        @foreach($data['food_schedule'] as $foodSchedule)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $foodSchedule->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ $i }}</td>
                                <td>{{ ViewHelper::getHostelNameById($foodSchedule->hostels_id) }}</td>
                                <td>{{ ViewHelper::getDayById($foodSchedule->days_id) }}</td>
                                <td>{{ ViewHelper::getFoodTimeById($foodSchedule->eating_times_id) }}</td>
                                <td>
                                    <table class="table-responsive">
                                        @if($foods = $foodSchedule->foodItems)
                                            @foreach($foods as $food)
                                            <tr>
                                                <td>
                                                    {{ $food->title  }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </table>
                                </td>
                                {{--<td>{{ $foodSchedule->foodSchedule }}</td>--}}
                                {{--<td>
                                    @if(isset($foodSchedule->subjects))
                                        @foreach($foodSchedule->subjects as $subject)
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ $subject->title }}
                                            </div>
                                            <hr class="hr-2">
                                        @endforeach
                                    @endif
                                </td>--}}
                                <td class="hidden-480 ">
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $foodSchedule->status == 'active'?"btn-info":"btn-warning" }}" >
                                            {{ $foodSchedule->status == 'active'?"Active":"In Active" }}
                                            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route($base_route.'.active', ['id' => $foodSchedule->id]) }}"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            </li>

                                            <li>
                                                <a href="{{ route($base_route.'.in-active', ['id' => $foodSchedule->id]) }}"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="green" href="{{ route($base_route.'.edit', ['id' => $foodSchedule->id]) }}">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>

                                        <a href="{{ route($base_route.'.delete', ['id' => $foodSchedule->id]) }}" class="red bootbox-confirm">
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
                                                    <a href="{{ route($base_route.'.edit', ['id' => $foodSchedule->id]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ route($base_route.'.delete', ['id' => $foodSchedule->id]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
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
