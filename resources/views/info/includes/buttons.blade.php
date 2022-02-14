<div class="clearfix hidden-print ">
    <div class="easy-link-menu align-right">
        <a class="{!! request()->is('info/notice*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('info.notice') }}"><i class="fa fa-files-o" aria-hidden="true"></i>&nbsp;Notice</a>
        <a class="{!! request()->is('info/smsemail*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('info.smsemail') }}"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Sms/Email</a>

    </div>
</div>
<hr class="hr-6">