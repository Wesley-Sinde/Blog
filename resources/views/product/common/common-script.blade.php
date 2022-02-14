<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function () {

        /*link product*/
        $('select[name="product_id"]').select2({
            placeholder: 'Select Product...',
            ajax: {
                url: '{{ route('product.product-name-autocomplete') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data
                    };

                },
                cache: true
            }

        });

        $('#load-product-html-btn').click(function () {

            var products_id = $('select[name="product_id"]').val();
            if (!products_id)
                toastr.warning("Please, Find Product First.", "Warning");
            else {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('product.product-detail-html') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: products_id
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);
                        if (data.error) {
                            toastr.warning(data.message, "warning");
                        } else {

                            $('#product_wrapper').append(data.html);
                            //toastr.success(data.message, "success");
                        }
                    }
                });
            }
        });

    });

</script>