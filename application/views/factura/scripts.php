    <script>
        $(document).ready(function(){
            $('.btn-facturar').click(function (e){
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
                            let $url = "<?php echo base_url().'pdf/mostrar_factura/'?>" + data.folio;
                            let win = window.open($url, '_blank');
                            window.focus();
                            // win.focus();
                            let clienteSeleccionado = $("#clientes-opt :selected").val();
                            let filaServicioSelec = $(".table[data-cliente='" + clienteSeleccionado + "'] .table__row[data-servicio='"+ data.servicio + "']")[0];
                            let colUltimaFact = filaServicioSelec.children[1];
                            let fechaUltFac = colUltimaFact.textContent.split("-").reverse().join("-");
                            let fechaFacActual = data.fecha.split("-").reverse().join("-");
                            console.log("Fila es: ");
                            console.log(filaServicioSelec);
                            if(fechaFacActual > fechaUltFac) {
                                colUltimaFact.textContent = data.fecha;
                            }
                           
                        }else{
                            alert(data.msg);
                        }
                    }
                });
            });

            $('.form-facturar').submit(function (e){
                e.preventDefault();
                inputs = $(this).serializeArray();
                fecha = inputs.find(el => el.name == 'fecha-emision');
                // console.log(fecha.value);
                fecha.value = fecha.value.split('-').reverse().join('-');//Transformacion a formato local
                // console.log(inputs);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: inputs,
                    dataType: 'json',
                    success: function (data){
                        if(data.status == 'success'){
                            let $url = "<?php echo base_url().'pdf/mostrar_factura/'?>" + data.folio;
                            let win = window.open($url, '_blank');
                            // win.focus();
                            let clienteSeleccionado = $("#clientes-opt :selected").val();
                            let filaServicioSelec = $(`.table[data-cliente="${clienteSeleccionado}" .table__row[data-servicio="${data.servicio}"]`)[0];
                            let colUltimaFact = filaServicioSelec.children[1];
                            colUltimaFact.textContent = data.fecha;

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