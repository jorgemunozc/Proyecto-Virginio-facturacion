<script>
$(document).ready(function ()
    {
        $('#nuevoServicioForm').submit(function(e){
            e.preventDefault();
            if($('#monto_tarifa').val().indexOf('.') != -1){
                var arr_str = $('#monto_tarifa').val().split('.');
                var str_sanitized = arr_str.join('');
                $('#monto_tarifa').val(str_sanitized);
            }
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data){
                    $('#mensaje').text(data.msg);
                    if(data.status === 'success'){
                        $('#mensaje').removeClass('error').addClass('success');
                        setTimeout(() => {
                            location.reload(false);
                        }, 1000);
                    }else{
                        $('#mensaje').removeClass('success').addClass('error');
                    }
                }
            })
        });

        $('.dlt-btn').on('click', function (e){
            e.preventDefault();
            var $rut = $(this).data('rut');
            var $servicio = $(this).data('servicio');
            $.ajax({
                url: '<?php echo base_url()."tarifas/eliminar_tarifa";?>',
                method: 'POST',
                data: {'rut': $rut, 'tipo_servicio': $servicio},
                dataType: 'json',
                success: function (data){
                    if(data.status == 'success'){
                        setTimeout(() => {
                            location.reload(false);
                        }, 1000);
                    }
                },
                error: function (){}
            });
        });
        
        $('#agregarServicioBtn').on('click', function(){
            $('#nuevoServicioForm').removeClass('hidden').addClass('visible');
        });
    }
);
</script>
</div>