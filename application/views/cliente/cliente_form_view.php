<div class="main-content">
<?php 
        $path = "clientes/";
        $razon_social = $rut = $giro = $direccion = $comuna = '';
        $rango_cobros = 0;
        if(isset($mode) && $mode === 'edit')
        {
            $path .= "actualizar_datos_cliente";
            $title = "Editar Cliente";

        }else{
            $path .= "agregar_cliente";
            $title = "Nuevo Cliente";
        }
        if(isset($cliente))
        {
            $razon_social = $cliente->razon_social;
            $rut = $cliente->rut;
            $giro = $cliente->giro;
            $direccion = $cliente->direccion;
            $comuna = $cliente->comuna;
            $rango_cobros = $cliente->rango_cobros;
        }
?>
    <h1 class="title"><?php echo $title;?></h1>
    <form class="form" method="post" action="<?php echo base_url().$path;?>">
        <div class="form__field">
            <label class="form__label" for="">Razón Social</label>
            <input class="form__input" type="text" name="razon_social" value="<?php echo $razon_social;?>" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="">Rut</label>
            <input type="text" name="rut" maxlength="15" value="<?php echo $rut;?>" required>
            <?php if(isset($cliente)):?>
            <input type="text" name="old-rut" value="<?php echo $rut;?>" hidden>
            <?php endif;?>
        </div>
        <div class="form__field">
            <label class="form__label" for="">Giro</label>
            <input type="text" name="giro" value="<?php echo $giro;?>" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="">Dirección</label>
            <input type="text" name="direccion" value="<?php echo $direccion;?>" required>
        </div>
        <div class="form__field">
            <label class="form__label" for="">Comuna</label>
            <input type="text" name="comuna" value="<?php echo $comuna;?>" required>
        </div>
        <!-- <div class="form__field">
            <label for="">Cliente activo?</label>
            <input type="text" name="is_active" value="1" required>
        </div> -->
        <div class="form__field">
            <label class="form__label" for="">Variablidad Cobros (%)</label>
            <input type="number" name="rango_cobros" min="1" max="100" value="<?php echo $rango_cobros * 100;?>" required>
        </div>

        <div class="form__field">
            <button class="btn">Ingresar</button>
            <a class="btn btn--red" href="<?php echo base_url().'clientes'?>">Cancelar</a>
        </div>

        <div class="form__field required">
            <span>*Campos requeridos.</span>
        </div>
    </form>
    <div class="mensaje"></div>