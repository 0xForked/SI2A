<script type="text/javascript">
    $('input[type=search]').on('search', function () {
        if($(this).val().length < 1){
            window.location='{{ route('admin.items.units.index') }}'
        }
    });
    function showUnit(id) {
        var route = `{{ route('admin.items.units.index') }}/${id}`
        $.ajax({
            type: 'GET',
            url: route,
            success: function(data) {
                $("#formEditUnit input[name=id]").val(data.id);
                $("#formEditUnit input[name=name]").val(data.name);
                $("#formEditUnit textarea[name=description]").val(data.description);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>