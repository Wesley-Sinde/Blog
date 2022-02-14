<script>
    $(document).on("click", ".open-AddSalMasterDialog");

    $(document).on("click", ".open-AddSalDialog", function () {
        var StaffId = $(this).data('staff-id');
        var PayrollMasterId = $(this).data('id');
        var salAmount = $(this).data('amount');
        var MasterTitle = $(this).data('head');
        var TagLine = $(this).data('tag-line');
        /*date*/
        /*var today = new Date();
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
        $(".modal-body #date").val( today );*/
        /*enddate*/
        $(".modal-body #StaffId").val( StaffId );
        $(".modal-body #MasterId").val( PayrollMasterId );
        $(".modal-body #salAmount").val( salAmount );
        $(".modal-header").html("<button type=\"button\" class=\"close top-close\" data-dismiss=\"modal\" id=\"close-button\">" +
            "×</button><h4 class=\"modal-title title text-center fees_title\" id=\"MasterTitle\"><b>"
            +MasterTitle +"</b> | "+TagLine+"</h4>\n" +
            "");
    });
</script>