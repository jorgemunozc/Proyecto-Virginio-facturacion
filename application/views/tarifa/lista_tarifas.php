<div class="tarifas"    >
    <div class="table">
        <div class="table__row table__header">
            <div class="table__cell">Servicio</div>
            <div class="table__cell">Tarifa</div>
            <div class="table__cell"></div>
        </div>
        <?php if (count($tarifas) == 0):?>
        <div class="table__row">Ningún servicio contratado.</div>
        <?php else: ?>
        <?php foreach($tarifas as $servicio):?>
        <div class="table__row">
            <div class="table__cell"><?php echo $servicio->servicio__tipo_servicio;?></div>
            <div class="table__cell">
                <span id="<?php echo $servicio->servicio__tipo_servicio;?>"><?php echo number_format($servicio->monto_tarifa);?></span>
            </div>
            <div class="table__cell"><div class="btn dlt-btn btn--red btn--small" data-rut="<?php echo $servicio->cliente__rut;?>" data-servicio="<?php echo $servicio->servicio__tipo_servicio;?>">X</div></div>
        </div>
        <?php endforeach;?>
    <?php endif;?>
    </div>
    <div class="btn btn--md" id="agregarServicioBtn">Agregar / Editar</div>
    
</div>