<form action="" id="delete_form" style="display: none;" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE">
</form>
<script type="application/javascript">
    function handleDeleteBtn(url) {
        if (confirm("确定要删除吗？")){
            $('#delete_form').attr('action', url).submit();
        }
    }
</script>