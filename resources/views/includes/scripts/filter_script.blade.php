<script>
    jQuery(document).ready(function($){
        $("form").submit(function() {
            $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
            return true; // ensure form still submits
        });

        // Un-disable form fields when page loads, in case they click back after submission
        $( "form" ).find( ":input" ).prop( "disabled", false );

    });
</script>