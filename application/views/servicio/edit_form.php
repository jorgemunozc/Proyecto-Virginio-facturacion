<div class="main-content">
    <div class="info-empresa">
        <h1 class="title">Información Servicio</h1>
        <a class="btn" href="<?php echo base_url().'servicios'?>">Volver a Servicios</a>
    </div>
<?php if(isset($servicio)):?>
<div class="logo"><img src="<?php echo base_url().'/public/images/'.$servicio->url_logo?>" alt="Logo <?php echo $servicio->tipo_servicio;?>"></div>
<form id="editServicioData" class="form" method="post" action="<?php echo base_url().'servicios/editar_servicio';?>">
    <div class="form__field">
        <label class="form__label" for="">Tipo Servicio</label>
        <input class="form__input" type="text" name="tipo_servicio" value="<?php echo $servicio->tipo_servicio;?>" required>
        <input type="hidden" name="old_tipo_serv" value="<?php echo $servicio->tipo_servicio;?>">
    </div>
    <div class="form__field">
        <label class="form__label" for="">Razón Social</label>
        <input class="form__input" type="text" name="razon_social" value="<?php echo $servicio->razon_social;?>" required>
    </div>
    <div class="form__field">
        <label class="form__label" for="">Rut</label>
        <input class="form__input" type="text" name="rut" value="<?php echo $servicio->rut;?>" placeholder="Ej: 1.234.567-8" required>
    </div>
    <div class="form__field">
        <label class="form__label" for="">Giro</label>
        <input class="form__input" type="text" name="giro"  value="<?php echo $servicio->giro;?>" required>
    </div>
    <div class="form__field">
        <label class="form__label" for="">Dirección</label>
        <input class="form__input" type="text" name="direccion" value="<?php echo $servicio->direccion;?>" required>
    </div>
    <div class="form__field">
        <label class="form__label" for="">Comuna</label>
        <input class="form__input" type="text" name="comuna" value="<?php echo $servicio->comuna;?>" required>
    </div>
    <div class="form__field">
        <label class="form__label" for="">Fono</label>
        <input class="form__input" type="text" name="fono" value="<?php echo $servicio->fono;?>" required>
    </div>
    <div class="form__field">
            <div>
                <input type="checkbox" name="exento" id="exento" checked="<?php echo $servicio->exento == 1? "true" : "false"?>"><label for="exento">Servicio exento de impuesto</label>
            </div>
    </div>
    <div class="form__field">
        <button class="btn">Actualizar Datos</button>
    </div>
    <div class="form__field required">
        <span>*Campos requeridos.</span>
    </div>
</form>
<form id="editServicioLogo" class="form" method="post" action="<?php echo base_url().'servicios/editar_logo'?>" enctype="multipart/form-data">
    <input type="hidden" name="tipo_servicio" value="<?php echo $servicio->tipo_servicio;?>">
    <input class="form__input" type="file" name="logo" accept=".png" required>
    <span class="leyenda">Peso máx: 1024KB</span>
    <button class="btn">Actualizar Logo</button>
</form>
<div class="mensaje"></div>
<?php else:?>
    <div>Servicio no existe.</div>
    <a class="btn btn--red" href="<?php echo base_url().'servicios';?>">Volver</a>
<?php endif;?>

