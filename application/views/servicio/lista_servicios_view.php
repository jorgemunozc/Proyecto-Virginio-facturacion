<div class="main-content">
    <div class="table">
        <div class="table__row table__header">
            <div class="table__cell">Empresa</div>
            <div class="table__cell">Servicio</div>
            <div class="table__cell">Rut</div>
            <div class="table__cell">Giro</div>
            <div class="table__cell">Comuna</div>
            <div class="table__cell">Fono</div>
<<<<<<< HEAD
            <div class="table__cell">Servicio Exento</div>
            <!-- <div class="table__cell">Logo</div> -->
            <div class="table__cell"></div>
            <div class="table__cell"></div>
=======
            <!-- <div class="table__cell">Logo</div> -->
            <div class="table__cell"></div>
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
        </div>
        <?php if(empty($servicios)):?>
        <div class="table__row">
            <div class="table__cell">Sin Servicios aún.</div>
        </div>
            <?php endif;?>
        <?php foreach ($servicios as $servicio):?>
        <div class="table__row">
            <div class="table__cell"><?php echo $servicio->razon_social;?></div>
            <div class="table__cell"><?php echo $servicio->tipo_servicio;?></div>
            <div class="table__cell"><?php echo $servicio->rut;?></div>
            <div class="table__cell"><?php echo $servicio->giro;?></div>
            <div class="table__cell"><?php echo $servicio->comuna;?></div>
            <div class="table__cell"><?php echo $servicio->fono;?></div>
<<<<<<< HEAD
            <div class="table__cell"><?php echo $servicio->exento == 0 ? "No": "Sí";?></div>
            <div class="table__cell"><a class="btn btn--md" href="<?php echo base_url().'servicios/edit/'.rawurlencode($servicio->tipo_servicio)?>">Editar</a></div>
            <div class="table__cell"><a href="#" data-servicio="<?php echo $servicio->tipo_servicio;?>" class="delete-btn btn btn--red btn--small">X</a></div>
=======
            <!-- <div class="table__cell"><?php echo $servicio->url_logo;?></div> -->
            <div class="table__cell"><a class="btn btn--md" href="<?php echo base_url().'servicios/edit/'.rawurlencode($servicio->tipo_servicio)?>">Editar</a></div>
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
        </div>
        <?php endforeach;?>
    </div>

    <a class="btn btn--md" href="<?php echo base_url();?>servicios/new">Nuevo</a>
<<<<<<< HEAD
    <div class="mensaje"></div>
=======
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
