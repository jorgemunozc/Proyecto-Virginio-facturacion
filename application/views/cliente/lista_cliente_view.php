<div class="main-content">
    <div class="table">
        <div class="table__row table__header">
            <div class="table__cell">Razón Social</div>
            <div class="table__cell">Rut</div>
            <div class="table__cell">Giro</div>
            <div class="table__cell">Dirección</div>
            <div class="table__cell">Comuna</div>
            <!-- <div class="table__cell">Activo</div> -->
            <div class="table__cell">Variabilidad de Cobro</div>
            <div class="table__cell"></div>
            <div class="table__cell"></div>
        </div>
        <?php if(empty($clientes)):?>
        <div class="table__row">
            <div class="table__cell">Sin clientes aún.</div>
        </div>
        <?php endif;?>
        <?php foreach ($clientes as $cliente):?>
        <div class="table__row">
            <div class="table__cell"><?php echo $cliente->razon_social;?></div>
            <div class="table__cell"><?php echo $cliente->rut;?></div>
            <div class="table__cell"><?php echo $cliente->giro;?></div>
            <div class="table__cell"><?php echo $cliente->direccion;?></div>
            <div class="table__cell"><?php echo $cliente->comuna;?></div>
            <!-- <div class="table__cell"><?php echo $cliente->is_active;?></div> -->
            <div class="table__cell"><?php echo $cliente->rango_cobros * 100;?>%</div>
            <div class="table__cell"><a class="btn btn--md" href="<?php echo base_url().'clientes/edit/'.$cliente->rut;?>">Editar</a></div>
            <div class="table__cell"><a class="btn btn--md" href="<?php echo base_url().'tarifas/info/'.$cliente->rut;?>">Ver servicios</a></div>
        </div>
        <?php endforeach;?>
<<<<<<< HEAD
=======
        <!-- <?php phpinfo();?> -->
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
    </div>

    <div class="">
        <a class="btn btn--md" href="<?php echo base_url().'clientes/new';?>">Nuevo</a>
    </div>
