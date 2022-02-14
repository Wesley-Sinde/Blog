<script>
    $(document).on("click", ".open-feeMasterDialog", function () {
        /*date*/
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd;
        }
        if(mm<10){
            mm='0'+mm;
        }
        var today = yyyy +'-'+mm+'-'+ dd;
        $(".modal-body #date").val( today );
        /*enddate*/
        $(".modal-header").html("<button type=\"button\" class=\"close top-close\" data-dismiss=\"modal\" id=\"close-button\">" +
            "×</button><h4 class=\"modal-title title text-center fees_title\" id=\"MasterTitle\"><b>"
            +"Fee Add" +"</b> | "+"Student Ledger"+"</h4>\n" +
            "                ");
    });

    $(document).on("click", ".open-AddFeeDialog", function () {
        var FeeMasterkId = $(this).data('id');
        var StudentsId = $(this).data('students-id');
        var feeAmount = $(this).data('amount');
        var MasterTitle = $(this).data('head');
        var Semester = $(this).data('semester');

        /*enddate*/
        $(".modal-body #MasterId").val( FeeMasterkId );
        $(".modal-body #StudentsId").val( StudentsId );
        $(".modal-body #feeAmount").val( feeAmount );
        $(".modal-body #dueAmount").val( feeAmount );
        $(".modal-header").html("<button type=\"button\" class=\"close top-close\" data-dismiss=\"modal\" id=\"close-button\">" +
            "×</button><h4 class=\"modal-title title text-center fees_title\" id=\"MasterTitle\"><b>"
            +MasterTitle +"</b> | "+Semester+"</h4>\n" +
            "                ");
    });


    function setAmount($this){
        $('input.feeAmount').val($($this.options[$this.selectedIndex]).attr('data-feeHead-amount'));
    }
</script>
