<form action="" class="factura">
    <div class="factura__datos-cliente">
        <label for="">Fecha</label><input type="number" name="dia" value="<?php echo date("d");?>"><input type="number" name="mes" value="<?php echo date("m");?>"><input type="number" name="anio" value="<?php echo date("Y");?>">
        <label for="">Señor(es)</label><input type="text" name="razon_social" value="" disabled>
        <label for="">Rut</label><input type="text" name="rut" disabled>
        <label for="">Direccion</label><input type="text" name="direccion" value="" disabled>
        <label for="">Comuna</label><input type="text" name="comuna" value="" disabled>
        <label for="">Giro</label><input type="text" name="giro" value="" disabled>
        <label for="">Fecha Vencimiento</label><input type="number" name="dia_venc"><input type="number" name="mes_venc"><input type="number" name="anio_venc">
    </div>

    <div class="factura__detalles-factura">
        <div class="table">
            <div class="table__row">
                <div class="table__cell">Detalle</div>
                <div class="table__cell">Cantidad</div>
                <div class="table__cell">Precio Unitario</div>
                <div class="table__cell">Precio Total</div>
            </div>
        </div>
    </div>

    <div class="factura__totales">
        <div class="table">
            <div class="table__row">
                <div class="table__cell">Neto</div>
                <div class="table__cell"><input type="number" name="neto" value="" hidden></div>
            </div>
            <div class="table__row">
                <div class="table__cell">Exento</div>
                <div class="table__cell"><input type="number" name="exento" value="" hidden></div>
            </div>
            <div class="table__row">
                <div class="table__cell">IVA</div>
                <div class="table__cell"><input type="number" name="iva" value="" hidden></div>
            </div>
            <div class="table__row">
                <div class="table__cell">Total</div>
                <div class="table__cell"><input type="number" name="total" value="" hidden></div>
            </div>
        </div>
    </div>
</form>