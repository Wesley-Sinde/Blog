<div class="row">
    <div class="col-xs-12">
    @include('includes.data_table_header')
    <!-- div.table-responsive -->
        <div class="table-responsive">
            {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}
            <table width="100%" id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>S.N.</th>
                    <th>Reg.Num</th>
                    <th>Staff Name</th>
                    <th>Year</th>
                    <th>Month</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                    <th>12</th>
                    <th>13</th>
                    <th>14</th>
                    <th>15</th>
                    <th>16</th>
                    <th>17</th>
                    <th>18</th>
                    <th>19</th>
                    <th>20</th>
                    <th>21</th>
                    <th>22</th>
                    <th>23</th>
                    <th>24</th>
                    <th>25</th>
                    <th>26</th>
                    <th>27</th>
                    <th>28</th>
                    <th>29</th>
                    <th>30</th>
                    <th>31</th>
                    <th></th>
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
                            <td><a href="{{ route('staff.view', ['id' => $staff->staffs_id]) }}">{{ $staff->reg_no }}</a></td>
                            <td><a href="{{ route('staff.view', ['id' => $staff->staffs_id]) }}"> {{ $staff->first_name.' '.$staff->middle_name.' '. $staff->last_name }}</a></td>
                            <td>{{ ViewHelper::getYearById($staff->years_id) }} </td>
                            <td>{{ ViewHelper::getMonthById($staff->months_id) }} </td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_1) }}">{{ ViewHelper::getAttendanceStatus($staff->day_1)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_2)}}">{{ ViewHelper::getAttendanceStatus($staff->day_2)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_3)}}">{{ ViewHelper::getAttendanceStatus($staff->day_3)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_4)}}">{{ ViewHelper::getAttendanceStatus($staff->day_4)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_5)}}">{{ ViewHelper::getAttendanceStatus($staff->day_5)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_6)}}">{{ ViewHelper::getAttendanceStatus($staff->day_6)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_7)}}">{{ ViewHelper::getAttendanceStatus($staff->day_7)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_8)}}">{{ ViewHelper::getAttendanceStatus($staff->day_8)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_9)}}">{{ ViewHelper::getAttendanceStatus($staff->day_9)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_10)}}">{{ ViewHelper::getAttendanceStatus($staff->day_10)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_11)}}">{{ ViewHelper::getAttendanceStatus($staff->day_11)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_12)}}">{{ ViewHelper::getAttendanceStatus($staff->day_12)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_13)}}">{{ ViewHelper::getAttendanceStatus($staff->day_13)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_14)}}">{{ ViewHelper::getAttendanceStatus($staff->day_14)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_15)}}">{{ ViewHelper::getAttendanceStatus($staff->day_15)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_16)}}">{{ ViewHelper::getAttendanceStatus($staff->day_16)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_17)}}">{{ ViewHelper::getAttendanceStatus($staff->day_17)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_18)}}">{{ ViewHelper::getAttendanceStatus($staff->day_18)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_19)}}">{{ ViewHelper::getAttendanceStatus($staff->day_19)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_20)}}">{{ ViewHelper::getAttendanceStatus($staff->day_20)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_21)}}">{{ ViewHelper::getAttendanceStatus($staff->day_21)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_22)}}">{{ ViewHelper::getAttendanceStatus($staff->day_22)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_23)}}">{{ ViewHelper::getAttendanceStatus($staff->day_23)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_24)}}">{{ ViewHelper::getAttendanceStatus($staff->day_24)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_25)}}">{{ ViewHelper::getAttendanceStatus($staff->day_25)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_26)}}">{{ ViewHelper::getAttendanceStatus($staff->day_26)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_27)}}">{{ ViewHelper::getAttendanceStatus($staff->day_27)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_28)}}">{{ ViewHelper::getAttendanceStatus($staff->day_28)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_29)}}">{{ ViewHelper::getAttendanceStatus($staff->day_29)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_30)}}">{{ ViewHelper::getAttendanceStatus($staff->day_30)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($staff->day_31)}}">{{ ViewHelper::getAttendanceStatus($staff->day_31)}}</td>
                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a href="{{ route($base_route.'.delete', ['id' => $staff->id]) }}" class="red bootbox-confirm">
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
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="42">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                    </tr>
                @endif
                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
</div>