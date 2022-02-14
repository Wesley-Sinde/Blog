<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<style>
    .email .btn, .btn-default, .btn-default.focus, .btn-default:focus, .btn.focus, .btn:focus {
        background-color: #438eb9!important;
        border-color: #f8f8f8;
    }

    .email .btn-default.focus:hover, .btn-default:active:hover, .btn-default:focus:active, .btn-default:focus:hover, .btn-default:hover, .btn.focus:hover, .btn:active:hover, .btn:focus:active, .btn:focus:hover, .btn:hover, .open>.btn-default.dropdown-toggle, .open>.btn-default.dropdown-toggle.focus, .open>.btn-default.dropdown-toggle:active, .open>.btn-default.dropdown-toggle:focus, .open>.btn-default.dropdown-toggle:hover, .open>.btn.dropdown-toggle, .open>.btn.dropdown-toggle.focus, .open>.btn.dropdown-toggle:active, .open>.btn.dropdown-toggle:focus, .open>.btn.dropdown-toggle:hover {
        background-color: #f89406!important;
        border-color: #f5f5f5;
    }
</style>

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            //placeholder: 'Type Your Text Here...',
            tabsize: 2,
            height: 200,
            codemirror: { // codemirror options
                mode: 'text/html',
                htmlMode: true,
                lineNumbers: true,
                theme: 'monokai'
            }
        });

        $('.summernote').summernote({
            //placeholder: 'Type Your Text Here...',
            tabsize: 2,
            height: 200,
            codemirror: { // codemirror options
                mode: 'text/html',
                htmlMode: true,
                lineNumbers: true,
                theme: 'monokai'
            }
        });
    });
</script>