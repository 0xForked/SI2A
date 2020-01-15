<script type="text/javascript">
    $('input[type=search]').on('search', function () {
        if($(this).val().length < 1){
            window.location='{{ route('admin.customers.index') }}'
        }
    });
    function showCustomer(id) {
        var route = `{{ route('admin.customers.index') }}/${id}`
        $.ajax({
            type: 'GET',
            url: route,
            success: function(data) {
                console.log(data)
                $("#formEditCustomer input[name=id]").val(data.id);
                $("#formEditCustomer input[name=name]").val(data.name);
                $("#formEditCustomer input[name=address]").val(data.address);
                $("#formEditCustomer input[name=phone]").val(data.phone);
                $("#formEditCustomer input[name=email]").val(data.email);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>