<script>

    $(document).on("click", ".open-AddFeeDialog", function () {
        var PaymentId = $(this).data('id');
        var StudentsId = $(this).data('students-id');
        var Amount = $(this).data('amount');
        var Date = $(this).data('date');
        var Gateway = $(this).data('gateway');

        /*enddate*/
        $(".modal-body #StudentsId").val( StudentsId );
        $(".modal-body #PaymentId").val( PaymentId );
        $(".modal-body #amount").val( Amount );
        $(".modal-body #date").val( Date );
        $(".modal-body #Gateway").val( Gateway );
    });

</script>
