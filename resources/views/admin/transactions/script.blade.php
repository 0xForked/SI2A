<script type="text/javascript">
    $(function() {
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();
            $('#load a').css('color', '#dfecf6');
            $('#load').append(showLoading());
            var url = $(this).attr('href');
            getProducts(url);
            window.history.pushState("", "", url);
            location.reload();
        });

        function getProducts(url) {
            $.ajax({
                url : url
            }).done(function (data) {
                $('#products-list').html(data);
                $('#loading').hide();
            }).fail(function () {
                alert('Products could not be loaded.');
            });
        }
    });
</script>