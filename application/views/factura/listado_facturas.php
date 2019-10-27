<div class="lista-facturas">
    <?php foreach($clientes as $cliente):?>
    <div class="table hidden" data-cliente="<?php echo $cliente->rut?>">
        <div class="table__row table__header">
            <div class="table__cell">Servicio</div>
            <div class="table__cell">Nro. Factura</div>
            <div class="table__cell">Fecha Emisión</div>
            <div class="table__cell">Neto</div>
            <div class="table__cell">IVA</div>
            <div class="table__cell">Total</div>
            <div class="table__cell"></div>
        </div>
        <?php if(empty($facturas[$cliente->rut])):?>
            <div class="table__row"><div class="table__cell">Sin Facturas.</div></div>
            <?php endif;?>
        <?php foreach($facturas[$cliente->rut] as $factura): ?>
        <div class="table__row">
            <div class="table__cell"><?php echo $factura->servicio__tipo_servicio;?></div>
            <div class="table__cell"><?php echo $factura->folio;?></div>
            <div class="table__cell"><?php printf('%02d/%02d/%4d', $factura->dia_emision, $factura->mes_emision, $factura->anio_emision);?></div>
            <div class="table__cell"><?php echo number_format($factura->neto);?></div>
            <div class="table__cell"><?php echo number_format($factura->iva);?></div>
            <div class="table__cell"><?php echo number_format($factura->total);?></div>
            <div class="table__cell"><a class="btn btn--md" href="<?php echo base_url().'pdf/mostrar_factura/'.$factura->folio;?>" target="_blank">Ver Factura</a></div>
        </div>
        <?php endforeach;?>
    </div>
    <?php endforeach;?>
    
</div>