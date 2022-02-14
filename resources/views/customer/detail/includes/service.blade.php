<div class="col-xs-12">
    <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Service List</h4>
    <div class="clearfix">

        <span class="pull-right tableTools-container"></span>
    </div>
    <div class="table-header">
        Service Record list on table. Filter list using search box as your Wish.
    </div>
<!-- div.table-responsive -->
    <!-- div.table-responsive -->
    <div class="table-responsive">
        <table id="" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Code</th>
                    <th>Category</th>
                    <th>DeviceName</th>
                    <th >Status</th>
                    <th >Amount</th>
                </tr>
            </thead>
            <tbody>
            @if (isset($data['service']) && $data['service']->count() > 0)
                @php($i=1)
                @foreach($data['service'] as $service)
                    <tr>
                        <td> {{ \Carbon\Carbon::parse($service->date)->format('Y-m-d') }} </td>
                        <td><a href="{{ route('service.view', ['id' => encrypt($service->id)]) }}"> {{ $service->code }}</a> </td>
                        <td>{{  ViewHelper::getServiceCategory( $service->category_id ) }} </td>
                        <td> {{ $service->device_name }} </td>
                        <td> {{  ViewHelper::getServiceStatus( $service->service_status ) }} </td>
                        <td> {{  $service->getServiceInvoiceGrandTotal()  }} </td>
                    </tr>
                    @php($i++)
                @endforeach
            @else
                <tr>
                    <td colspan="6">No {{ $panel }} data found.</td>
                </tr>
            @endif
            </tbody>
        </table>
        {!! Form::close() !!}

    </div>
</div>
