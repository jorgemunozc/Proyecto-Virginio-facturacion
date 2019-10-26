    <script>
        $(document).ready(function(){
            $('.lista-servicios .btn').click(function (e){
                e.preventDefault();
                var rut = $(this).data('rut');
                var servicio = $(this).data('servicio');
                $.ajax({
                    url: '<?php echo base_url().'facturas/facturar'?>',
                    type: 'POST',
                    data: {'rut': rut, 'servicio': servicio},
                    dataType: 'json',
                    success: function (data){
                        if(data.status == 'success'){
                            var $url = "<?php echo base_url().'pdf/mostrar_factura/'?>" + data.folio;
                            var win = window.open($url, '_blank');
                            // win.focus();
                            var clienteSeleccionado = $("#clientes-opt :selected").val();
                            $("#clientes-opt").load(window.location.href + "#clientes-opt");
                        }else{
                            alert(data.msg);
                        }
                    }
                });
            });

            $("#clientes-opt").change(function (){
                var selected = $(this).val();
                
                $('.table') .each(function(){
                    if(selected == 0){
                        $('.visible').removeClass('visible').addClass('hidden');
                    }
                    if($(this).data('cliente') == selected){
                        $('.visible').removeClass('visible').addClass('hidden');
                        $(this).addClass('visible').removeClass('hidden');
                    }
                })
            });
        });
    </script>
</div>