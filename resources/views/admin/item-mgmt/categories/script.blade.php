<script type="text/javascript">
    $('input[type=search]').on('search', function () {
        if($(this).val().length < 1){
            window.location='{{ route('admin.items.categories.index') }}'
        }
    });
    function showCategory(id) {
        var route = `{{ route('admin.items.categories.index') }}/${id}`
        $.ajax({
            type: 'GET',
            url: route,
            success: function(data) {
                $("#formEditCategory input[name=id]").val(data.id);
                $("#formEditCategory input[name=name]").val(data.name);
                $("#formEditCategory textarea[name=description]").val(data.description);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>