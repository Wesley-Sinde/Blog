<script src="{{ asset('assets/js/jquery-ui.min.js')  }}"></script>
<script>
    $(document).ready(function () {

        $('table tbody').sortable({
            helper: fixWidthHelper
        }).disableSelection();

        function fixWidthHelper(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        }

    });
</script>