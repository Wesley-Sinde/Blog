<script>
    $(document).on("click", ".open-ActiveAgain", function () {
        var Id = $(this).data('id');
        var regNum = $(this).data('reg');

        $(".modal-body #residentId").val(Id);
        //$(".modal-body #hostelTitle").val(hostelTitle);
        $(".modal-header").html("<button type=\"button\" class=\"close top-close\" data-dismiss=\"modal\" id=\"close-button\">" +
            "×</button><h4 class=\"modal-title title text-center renew_title\" id=\"renew_title\"><b>"
            +regNum +"</b> | Renew Resident</h4>\n" +
            "     ");
    });

    $(document).on("click", ".open-ShiftResident", function () {
        var Id = $(this).data('id');
        var regNum = $(this).data('reg');

        $(".modal-body #residentId").val(Id);
        //$(".modal-body #hostelTitle").val(hostelTitle);
        $(".modal-header").html("<button type=\"button\" class=\"close top-close\" data-dismiss=\"modal\" id=\"close-button\">" +
            "×</button><h4 class=\"modal-title title text-center renew_title\" id=\"renew_title\"><b>"
            +regNum +"</b> | Shift Resident</h4>\n" +
            "     ");
    });



</script>