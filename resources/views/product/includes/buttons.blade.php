<div class="clearfix hidden-print ">
    <div class="easy-link-menu align-left ">
        <a class="{!! request()->is('product')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('product') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Detail</a>
        <a class="{!! request()->is('product/registration*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('product.registration') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Registration</a>
        <a class="{!! request()->is('product/import*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('product.import') }}"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Bulk Registration</a>
        <a class="{!! request()->is('product/category*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('product.category') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Category</a>
    </div>
    <hr class="hr-6 ">
</div>
