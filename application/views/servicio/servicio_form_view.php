<div class="main-content">
    <h1>Nuevo Servicio</h1>
    <form id="servicioData" class="form" method="post" action="<?php echo base_url().'servicios/guardar_servicio';?>" enctype="multipart/form-data">
        <div class="form__field">
            <label class="form__label" for="">Tipo Servicio</label>
            <input class="form__input" type="text" name="tipo_servicio" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="">Razón Social</label>
            <input class="form__input" type="text" name="razon_social" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="">Rut</label>
            <input class="form__input" type="text" name="rut" placeholder="Ej: 1.234.567-8" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="">Giro</label>
            <input class="form__input" type="text" name="giro" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="">Dirección</label>
            <input class="form__input" type="text" name="direccion" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="">Comuna</label>
            <input class="form__input" type="text" name="comuna" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="">Fono</label>
            <input class="form__input" type="text" name="fono" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="">Logo Servicio</label>
<<<<<<< HEAD
            <input class="form__input" type="file" name="logo" accept=".png" required>
            <span class="leyenda">Peso máx: 1024KB</span>
        </div>
        <div class="form__field">
            <div>
                <input type="checkbox" name="exento" id="exento"><label for="exento">Servicio exento de impuesto</label>
            </div>
        </div>
        <div class="form__field">
=======
            <input class="form__input" type="file" name="logo" accept=".png, .svg" required>
            <span class="leyenda">Peso máx: 1024KB</span>
        </div>
        <div class="form__field">
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
            <fieldset>
                <legend>Detalle Factura</legend>
                <div class="table">
                    <div class="table__row table__header">
                        <div class="table__cell">Detalle</div>
                        <div class="table__cell">Cantidad</div>
                        <div class="table__cell">Precio (% del total)</div>
                    </div>
                </div>
                <div class="controles">
                    <a class="btn btn--xsmall btn--square" id="addRow">+</a>
                    <a class="btn btn--xsmall btn--red btn--square" id="delRow">-</a>
                </div>
            </fieldset>
        </div>
        <input type="hidden" value="0" name="num_detalles" id="num_detalles">
        
        <div class="form__field">
            <button class="btn">Agregar Servicio</button>
            <a class="btn btn--red" href="<?php echo base_url().'servicios'?>">Cancelar</a>
        </div>
        <div class="form__field required">
            <span>*Campos requeridos.</span>
        </div>
    </form>

    <div class="template-row">
        <div class="table__cell"><input type="text" name="detalle" placeholder="Ingrese detalle..." required></div>
        <div class="table__cell"><input type="number" name="cantidad" min="0" max="9999"></div>
        <div class="table__cell"><input type="number" name="porc_precio" min="0" max="100" required></div>
    </div>
    <div class="mensaje"></div>
    <script>
        $(document).ready(function(){

            //Agrega la primera fila
                $('<div/>', {
                    'class' : 'table__row extra-row', html: getHtml()
                }).appendTo('#servicioData .table');
        
                $('#num_detalles').val(1);
                
                //Agrega una nueva fila cada vez que es clickeado
                $('#addRow').click(function () {
                    $('<div/>', {
                        'class' : 'table__row extra-row', html: getHtml()
                    }).hide().appendTo('#servicioData .table').slideDown('slow');
                    var num_items = $('.extra-row').length;
                    $('#num_detalles').val(num_items);
                });

                $('#delRow').click(function(){
                    var num_items = $('.extra-row').length;
                    if(num_items > 1){
                        $('.extra-row:last-child').slideUp('slow', (e)=>{
                            $('.extra-row:last-child').remove();
                            $('#num_detalles').val(num_items - 1);
                        });
                    }
                });
        });

        function getHtml()
        {
            var len = $('.extra-row').length;
            var $html = $('.template-row').clone();
            $html.find('[name=detalle]')[0].name="detalle" + len;
            $html.find('[name=cantidad]')[0].name="cantidad" + len;
            $html.find('[name=porc_precio]')[0].name="porc_precio" + len;
            return $html.html();    
        }

    </script>