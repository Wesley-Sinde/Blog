<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Hostel History</h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead >
                <tr>
                    <th>S.N.</th>
                    <th>Certificate</th>
                    <th>History</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['certificate_history']) && $data['certificate_history']->count() > 0)
                    @php($i=1)
                    @foreach($data['certificate_history'] as $history)
                        <tr>
                            <td>{{ $i }}</td>
                            <td class="text-uppercase">{{ $history->certificate }} </td>
                            <td>
                                <label class="label label-primary">{{$history->history_type}}</label>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($history->created_at)->format('Y-m-d')}} </td>

                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="11">No Certificate data found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>