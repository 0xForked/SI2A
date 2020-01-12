<script type="text/javascript">
    $('input[type=search]').on('search', function () {
        if($(this).val().length < 1){
            window.location='{{ route('admin.items.subcategories.index') }}'
        }
    });
    function showSubcategory(id) {
        var route = `{{ route('admin.items.subcategories.index') }}/${id}`
        $.ajax({
            type: 'GET',
            url: route,
            success: function(data) {
                $("#formEditSubcategory input[name=id]").val(data.id);
                $("#formEditSubcategory input[name=name]").val(data.name);
                $("#formEditSubcategory textarea[name=description]").val(data.description);
                $("#formEditSubcategory select[name=category_id]").val(data.category_id);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>