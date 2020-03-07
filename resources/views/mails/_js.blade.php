<script>
    var editor = document.getElementById("editor");
        CKEDITOR.replace(editor,{
        language:'en-gb'
    });
    CKEDITOR.config.allowedContent = true;
    $.get(`{{$file}}`)
        .done(response=>{CKEDITOR.instances['editor'].setData(response);})
        .fail(/** process error here **/);
</script>