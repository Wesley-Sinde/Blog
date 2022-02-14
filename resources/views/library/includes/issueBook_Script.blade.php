<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        /*Find Book For Issue*/
        $('select[name="book_id"]').select2({
            placeholder: 'Search Book...',
            ajax: {
                url: '{{ route('library.book-name-autocomplete') }}',
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

        /*Book Add on Issue List*/

        $('#load-html-btn').click(function () {

            var book_id = $('select[name="book_id"]').val();
            if (!book_id)
                toastr.warning("Please, Choose Book.", "Warning");
            else {

                $.ajax({
                    type: 'POST',
                    url: '{{ route('library.book-detail-html') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: book_id
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);

                        if (data.error) {
                            $.notify(data.message, "warning");
                        } else {

                            $('#book_wrapper').append(data.html);
                            toastr.success('Please Select Book Copy', 'Success:')
                        }
                    }
                });

            }
        });



    });

    $(document).on("click", ".add-request-book-list", function () {
        var book_id = $(this).data('bookid');

        //var book_id = $this.value;
        if (!book_id)
            toastr.warning("Please, Choose Book.", "Warning");
        else {

            $.ajax({
                type: 'POST',
                url: '{{ route('library.book-detail-html') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: book_id
                },
                success: function (response) {
                    var data = $.parseJSON(response);

                    if (data.error) {
                        $.notify(data.message, "warning");
                    } else {

                        $('#book_wrapper').append(data.html);
                        toastr.success('Please Select Book Copy', 'Success:')
                    }
                }
            });

        }
    });
</script>