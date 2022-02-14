<script>
    $(document).on("click", ".open-AddBookCopy", function () {
        var bookId = $(this).data('id');
        var bookTitle = $(this).data('book-title');
        var Code = $(this).data('book-code');

        $(".modal-body #bookId").val(bookId);
        $(".modal-body #Code").val(Code);
        $(".modal-body #bookTitle").val(bookTitle);
        $(".modal-header").html("<button type=\"button\" class=\"close top-close\" data-dismiss=\"modal\" id=\"close-button\">" +
            "×</button><h4 class=\"modal-title title text-center fees_title\" id=\"bookTitle\"><b>"
            +bookTitle +"</b> | Add Copies</h4>\n" +
            "                ");
    });

    function changeStartCode(){
        start = $("#start").val();
        code = $("#Code").val();
        $('.modal-body #start_preview').val(code + start);
        $('.modal-body #end').val(start);
        $('.modal-body #end_preview').val(code + start);
        if(start == 0 || end== 0){
            //alert('Attention!, Please Enter Value Greater Than 0');
        }
        end = parseInt(start);
        if(start == end){
            totalCopy = 1;
        }else{
            totalCopy = (end - start) + 1;
        }
        $('.modal-body #total_copy').val(totalCopy);
    }

    function changeEndCode(){
        start = $("#start").val();
        end = $("#end").val();
        code = $("#Code").val();
        if(start == 0 || end == 0){
            //alert('Attention!, Please Enter Value Greater Than 0');
            toastr.warning('Attention!, Please Enter Value Greater Than 0','Warning:');
        }
        //$('#errorShow').text('');
        if(start > end){
            //alert('Attention!, Yo have enter End Value is Less than Starting. Correct It.');
            toastr.warning('Attention!, Yo have enter End Value is Less than Starting. Correct It.','Warning:');
        }
        $('#errorShow').text('');

        $(':input[type="submit"]').prop('disabled', false);
        if(start == end){
            totalCopy = 1;
        }else{
            totalCopy = (end - start) + 1;
        }
        $('.modal-body #end_preview').val(code + end);
        $('.modal-body #total_copy').val(totalCopy);
    }


</script>