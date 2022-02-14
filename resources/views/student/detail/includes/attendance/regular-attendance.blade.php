<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Attendance Detail</h4>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>S.N.</th>
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
                    <th>32</th>
                    @foreach($data['attendanceStatus'] as $attenStatus)
                        <th>{{$attenStatus->title}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody class="text-center">
                @if (isset($data['attendance']) && $data['attendance']->count() > 0)
                    @php($i=1)
                    @foreach($data['attendance'] as $attendance)
                        <tr>
                            <td>{{ $i }}</td>
                           <td>{{ ViewHelper::getYearById($attendance->years_id) }} </td>
                            <td>{{ ViewHelper::getMonthById($attendance->months_id) }} </td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_1) }}">{{ ViewHelper::getAttendanceStatus($attendance->day_1)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_2)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_2)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_3)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_3)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_4)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_4)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_5)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_5)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_6)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_6)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_7)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_7)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_8)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_8)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_9)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_9)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_10)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_10)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_11)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_11)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_12)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_12)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_13)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_13)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_14)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_14)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_15)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_15)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_16)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_16)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_17)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_17)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_18)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_18)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_19)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_19)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_20)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_20)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_21)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_21)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_22)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_22)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_23)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_23)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_24)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_24)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_25)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_25)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_26)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_26)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_27)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_27)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_28)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_28)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_29)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_29)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_30)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_30)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_31)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_31)}}</td>
                            <td class="{{ ViewHelper::getAttendanceDisplayClass($attendance->day_32)}}">{{ ViewHelper::getAttendanceStatus($attendance->day_32)}}</td>
                            <td>{{ $attendance->PRESENT?$attendance->PRESENT:0 }} </td>
                            <td>{{ $attendance->ABSENT?$attendance->ABSENT:0 }} </td>
                            <td>{{ $attendance->LATE?$attendance->LATE:0 }} </td>
                            <td>{{ $attendance->LEAVE?$attendance->LEAVE:0 }} </td>
                            <td>{{ $attendance->HOLIDAY?$attendance->HOLIDAY:0 }} </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="40"  class="align-left">No attendance data found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>