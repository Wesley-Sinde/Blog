<div class="clearfix hidden-print ">
    <div class="easy-link-menu align-left ">
        <a class="{!! request()->is('customer')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('customer') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Detail</a>
        <a class="{!! request()->is('customer/registration*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('customer.registration') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Registration</a>
        <a class="{!! request()->is('customer/import*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('customer.import') }}"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Bulk Registration</a>
        <a class="{!! request()->is('customer/document*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('customer.document') }}"><i class="fa fa-files-o" aria-hidden="true"></i>&nbsp;Documents</a>
        <a class="{!! request()->is('customer/note*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('customer.note') }}"><i class="fa fa-sticky-note" aria-hidden="true"></i>&nbsp;Notes</a>
    </div>
    <hr class="hr-6 ">
</div>
