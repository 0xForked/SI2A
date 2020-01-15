<script type="text/javascript">
    $('input[type=search]').on('search', function () {
        if($(this).val().length < 1){
            window.location='{{ route('admin.suppliers.index') }}'
        }
    });
    function showSupplier(id) {
        var route = `{{ route('admin.suppliers.index') }}/${id}`
        $.ajax({
            type: 'GET',
            url: route,
            success: function(data) {
                console.log(data)
                $("#formEditSupplier input[name=id]").val(data.id);
                $("#formEditSupplier input[name=name]").val(data.name);
                $("#formEditSupplier input[name=address]").val(data.address);
                $("#formEditSupplier input[name=city]").val(data.city);
                $("#formEditSupplier input[name=phone]").val(data.phone);
                $("#formEditSupplier input[name=email]").val(data.email);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>