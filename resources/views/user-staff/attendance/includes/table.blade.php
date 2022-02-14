<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Attendance Detail</h4>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table width="100%" id="dynamic-table" class="table table-striped table-bordered table-hover">
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
                </tr>
                </thead>
                <tbody>
                @if (isset($data['attendance']) && $data['attendance']->count() > 0)
                    @php($i=1)
                    @foreach($data['attendance'] as $staff)
                        <tr>
                            <td>{{ $i }}</td>
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
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="42">data not found. </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>