<script type="text/javascript">
    $('input[type=search]').on('search', function () {
        if($(this).val().length < 1){
            window.location='{{ route('admin.general.maritals.index') }}'
        }
    });
    function showMarital(id) {
        var route = `{{ route('admin.general.maritals.index') }}/${id}`
        $.ajax({
            type: 'GET',
            url: route,
            success: function(data) {
                $("#formEditMarital input[name=id]").val(data.id);
                $("#formEditMarital input[name=name]").val(data.name);
                $("#formEditMarital textarea[name=description]").val(data.description);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>