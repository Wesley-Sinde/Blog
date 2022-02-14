@if($data['notice_disaplay'] && $data['notice_disaplay']->count() >0)
    @foreach($data['notice_disaplay'] as $notice)
        @php($displayGroup = explode(',',$notice->display_group))
        @php($role = auth()->user()->roles[0]->id)
        @if(in_array($role, $displayGroup))
           <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <h3>{{$notice->title}}</h3>
                <hr class="hr-2">
                {!! $notice->message !!}
            </div>
       @endif
    @endforeach
@endif