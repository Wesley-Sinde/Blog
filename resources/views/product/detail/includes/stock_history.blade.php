<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>  STOCK in HAND - {{$data['product']->getProductStock()}}</h4>
        {{--<div class="clearfix">--}}
            {{--<span class="pull-right tableTools-container"></span>--}}
        {{--</div>--}}
        {{--<div class="table-header">--}}
            {{--History List Record list on table. Filter list using search box as your Wish.--}}
        {{--</div>--}}
    <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table " class="table table-striped table-bordered table-hover ">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>QTY_IN</th>
                        <th>QTY_OUT</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                @if (isset($data['product']->stock) && $data['product']->stock->count() > 0)
                    @php($i=1)
                    @foreach($data['product']->stock as $history)
                        <tr>
                            <td>{{ $i }}</td>
                            <td> {{  \Carbon\Carbon::parse($history->day)->format('Y-m-d') }} </td>
                            <td>{{ $history->transaction_type }} </td>
                            <td>{{ $history->qty_in }} </td>
                            <td>{{ $history->qty_out }} </td>
                            <td>{{ $history->created_by_name }} </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="10"> Issued History Not Found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>



