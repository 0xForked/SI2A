<script type="text/javascript">
    $(document).ready(function() {
		$('.count').prop('disabled', true);
   		$(document).on('click','.plus',function() {
			$('.count').val(parseInt($('.count').val()) + 1 );
    	});
        $(document).on('click','.minus',function() {
    		$('.count').val(parseInt($('.count').val()) - 1 );
    		if ($('.count').val() == 0) {
				$('.count').val(1);
			}
    	});

        @if(!isset($transaction) && Request::segment(3) == "purchase")
            $('#openPurchaseTransactionModal').modal({backdrop: 'static', keyboard: false});
            $('#openPurchaseTransactionModal').modal('show');
        @endif
 	});

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