@if($data['tag'] =='daily' || $data['tag'] =='weekly' || $data['tag'] =='monthly' || $data['tag'] =='yearly')
    @include('account.report.cash-book.includes.daily-table-data')

@elseif(isset($data['print_head']))
    @include('account.report.cash-book.includes.table-data')
@else
@endif