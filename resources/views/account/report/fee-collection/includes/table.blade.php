@if($data['tag'] =='daily' || $data['tag'] =='weekly' || $data['tag'] =='monthly' || $data['tag'] =='yearly')
    @include($view_path.'.includes.daily-table-data')

@elseif(isset($data['print_head']))
    @include('account.report.fee-collection.includes.table-data')
@else
@endif