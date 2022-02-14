@if(isset($data['fee_head_tag']) && $data['fee_head_tag'] =='fee_head')
    @include($view_path.'.includes.daily-fee-head-table-data')
@elseif($data['tag'] =='daily' || $data['tag'] =='weekly' || $data['tag'] =='monthly' || $data['tag'] =='yearly')
    @include($view_path.'.includes.daily-table-data')

@elseif(isset($data['print_head']))
    @include($view_path.'.includes.tabe-data')
@else
@endif