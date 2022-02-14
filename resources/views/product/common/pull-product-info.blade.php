<div class="row">
    <div class="col-xs-12 col-sm-3 col-print-3">
        <div>
            <span class="profile-picture">
               @if($productInfo->product_image != '')
                    <img id="avatar" class="editable img-responsive" alt="{{ $productInfo->name }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$productInfo->product_image) }}" width="300px" />
                @else
                    <img id="avatar" class="editable img-responsive" alt="{{ $productInfo->name }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
                @endif
            </span>

            <div class="space-4"></div>

        </div>
    </div>
    <div class="col-xs-12 col-sm-9 col-print-9">
        <div class="space-3"></div>
        <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">
            {{ $productInfo->code}} - {{ $productInfo->name}}
        </div>
        <div class="space-6"></div>

        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Category : </div>
                <div class="profile-info-value">
                    <span class="editable" id="category_id">{{  ViewHelper::getProductCategory( $productInfo->category_id ) }}</span>
                </div>

                <div class="profile-info-name"> Sub Category : </div>
                <div class="profile-info-value">
                    <span class="editable" id="sub_category_id">{{  ViewHelper::getProductSubCategory( $productInfo->sub_category_id ) }}</span>
                </div>
            </div>
        </div>
        <div class="profile-user-info profile-user-info-striped">
            {{--'warranty',
                    'product_image', 'cost_price', 'sale_price', 'stock', 'description','status'--}}
            <div class="profile-info-row">
                <div class="profile-info-name"> Warranty : </div>
                <div class="profile-info-value">
                    <span class="editable" id="warranty">{{ $productInfo->warranty }}</span>
                </div>

                <div class="profile-info-name"> Price : </div>
                <div class="profile-info-value">
                    <span class="editable" id="price">{{ $productInfo->sale_price }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Stock : </div>
                <div class="profile-info-value">
                    <span class="editable" id="stock">{{ $productInfo->stock }}</span>
                </div>

                <div class="profile-info-name"> Status : </div>
                <div class="profile-info-value">
                    <span class="editable" id="status">{{ $productInfo->status }}</span>
                </div>
            </div>
        </div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Description : </div>
                <div class="profile-info-value">
                    <span class="editable" id="description">{{  $productInfo->description  }}</span>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->
