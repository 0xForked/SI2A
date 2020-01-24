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

        @if(!isset($transaction))
            $('#openTransactionModal').modal({backdrop: 'static', keyboard: false});
            $('#openTransactionModal').modal('show');
        @endif

        $('#customer_select_radio').click(function() {
            if($(this).prop("checked") == true) {
                $('#customer_select_description').text('Diaktifkan')
                $('#customer_container').show();
                $('#customer_select').prop("disabled", false);
                $('#customer_name_container').hide();
                $('#custumer_name_input').prop("disabled", true);
            }
            else if($(this).prop("checked") == false) {
                $('#customer_select_description').text('Dinonaktifkan')
                $('#customer_container').hide();
                $('#customer_select').prop("disabled", true);
                $('#customer_name_container').show();
                $('#custumer_name_input').prop("disabled", false);
            }
        });

        $('#supplier_pejabat_radio').click(function() {
            if($(this).prop("checked") == true) {
                $('#supplier_pejabat_description').text('Perbaharui')
                $('#site_default_people_name_assign').val('')
                $('#site_default_people_nip_assign').val('')
                $('#site_default_people_name_assign').attr('placeholder', 'Masukkan nama pejabat' );
                $('#site_default_people_nip_assign').attr('placeholder', 'Masukkan nip pejabat' );
                $("#site_default_people_name_assign").attr("readonly", false);
                $("#site_default_people_nip_assign").attr("readonly", false);


            }
            else if($(this).prop("checked") == false) {
                $('#supplier_pejabat_description').text('Default')

                $('#site_default_people_name_assign').val('{{app_settings()['site_default_people_name_assign']->value}}')
                $('#site_default_people_nip_assign').val('{{app_settings()['site_default_people_nip_assign']->value}}')
                $('#site_default_people_name_assign').attr('placeholder', '' );
                $('#site_default_people_nip_assign').attr('placeholder', '' );
                $("#site_default_people_name_assign").attr("readonly", true);
                $("#site_default_people_nip_assign").attr("readonly", true);

            }
        });

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

    function addQty(id, name, qty) {
        $('#item_id').val(id)
        $('#item_name').text(name)
        $('#add_qty').val(qty)
    }

</script>