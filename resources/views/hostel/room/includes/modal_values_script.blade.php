<script>
    $(document).on("click", ".open-AddRooms", function () {
        //alert('ok');
        var hostelId = $(this).data('hostel-id');
        var roomId = $(this).data('room-id');
        var roomNumber = $(this).data('room-number');

        $(".modal-body #hostelId").val(hostelId);
        $(".modal-body #roomId").val(roomId);
        //$(".modal-body #hostelTitle").val(roomNumber);
        $(".modal-header").html("<button type=\"button\" class=\"close top-close\" data-dismiss=\"modal\" id=\"close-button\">" +
            "×</button><h4 class=\"modal-title title text-center hostel_title\" id=\"hostelTitle\"><b>"
            + "Room Number :" + roomNumber +"</b> | Add Beds</h4>\n" +
            "     ");
    });

    function changeStartCode(){
        start = $("#start").val();
        code = $("#Code").val();
        $('.modal-body #start_preview').val(code + start);
        $('.modal-body #end').val(start);
        $('.modal-body #end_preview').val(code + start);
        if(start == 0 || end== 0){
            alert('Attention!, Please Enter Value Greater Than 0');
        }
        end = parseInt(start);
        if(start == end){
            totalBeds = 1;
        }else{
            totalBeds = (end - start) + 1;
        }
        $('.modal-body #total_beds').val(totalBeds);
    }

    function changeEndCode(){
        start = $("#start").val();
        end = $("#end").val();
        code = $("#Code").val();
        if(start == 0 || end == 0){
            alert('Attention!, Please Enter Value Greater Than 0');
        }
        //$('#errorShow').text('');
        if(start > end){
            alert('Attention!, Yo have enter End Value is Less than Starting. Correct It.');
        }
        $('#errorShow').text('');

        $(':input[type="submit"]').prop('disabled', false);
        if(start == end){
            totalBeds = 1;
        }else{
            totalBeds = (end - start) + 1;
        }
        $('.modal-body #end_preview').val(code + end);
        $('.modal-body #total_beds').val(totalBeds);
    }


</script>