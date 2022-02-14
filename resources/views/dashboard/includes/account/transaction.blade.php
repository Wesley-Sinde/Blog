<div class="table-responsive">
    <table class="table table-bordered table-striped">
    <thead class="thin-border-bottom">
    <tr>
        <th>
            <i class="ace-icon fa fa-caret-right blue"></i>SN
        </th>

        <th>
            <i class="ace-icon fa fa-caret-right blue"></i>TrHead
        </th>

        <th>
            <i class="ace-icon fa fa-calendar blue"></i>Date
        </th>

        <th>
            <i class="ace-icon fa fa-dollar blue"></i>Dr.Amount
        </th>

        <th>
            <i class="ace-icon fa fa-dollar blue"></i>Cr.Amount
        </th>
    </tr>
    </thead>

    <tbody>

    @if (isset($data['recent_transaction']) && $data['recent_transaction']->count() > 0)
        @php($i=1)
        @foreach($data['recent_transaction'] as $recentTransaction)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $recentTransaction->tr_head }}</td>
                <td>{{ \Carbon\Carbon::parse($recentTransaction->date)->format('Y-m-d') }}</td>
                <td>
                    <b>{{ $recentTransaction->dr_amount }}</b>
                </td>
                <td>
                    <b>{{ $recentTransaction->cr_amount }}</b>
                </td>
            </tr>
            @php($i++)
        @endforeach
        <tr>
            <td class="center" colspan="5">
                <a class="green" href="{{ route('account.transaction') }}">More</a>
            </td>
        </tr>
    @else
        <tr>
            <td colspan="5">No data found.</td>
        </tr>
    @endif

    </tbody>
</table>
</div>