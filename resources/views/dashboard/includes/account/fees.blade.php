<div class="table-responsive">
    <table class="table table-bordered table-striped">
    <thead class="thin-border-bottom">
    <tr>
        <th>
            <i class="ace-icon fa fa-caret-right blue"></i>SN
        </th>

        <th>
            <i class="ace-icon fa fa-caret-right blue"></i>Reg.No.
        </th>

        <th>
            <i class="ace-icon fa fa-caret-right blue"></i>Fees Title
        </th>

        <th>
            <i class="ace-icon fa fa-calendar blue"></i>Date
        </th>

        <th>
            <i class="ace-icon fa fa-dollar blue"></i>Amount
        </th>
    </tr>
    </thead>

    <tbody>

        @if (isset($data['recent_fees_collection']) && $data['recent_fees_collection']->count() > 0)
            @php($i=1)
            @foreach($data['recent_fees_collection'] as $fee_collection)
                <tr>
                    <td>{{ $i }}</td>
                    <td>
                        <a class="blue" href="{{ route('account.fees.collection.view', ['id' => $fee_collection->students_id]) }}">
                            {{ $fee_collection->reg_no }}
                        </a>
                    </td>
                    <td>{{ $fee_collection->fee_head_title }}</td>
                    <td>{{ \Carbon\Carbon::parse($fee_collection->date)->format('Y-m-d') }}</td>
                    <td>
                        <b>{{ $fee_collection->paid_amount }}</b>
                    </td>
                </tr>
                @php($i++)
            @endforeach
            <tr>
                <td class="center" colspan="5">
                    <a class="green" href="{{ route('account.fees.balance') }}">More</a>
                </td>
            </tr>
        @else
            <tr>
                <td colspan="11">No data found.</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
