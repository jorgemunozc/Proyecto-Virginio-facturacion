<?php
$fecha_act = new DateTime();
$url_action = base_url().'facturas/facturar';
?>

<div class="lista-servicios">
    <?php
        foreach($servicios as $rut_cliente => $servicios_cliente):?>
    <div class="table hidden" data-cliente="<?php echo $rut_cliente;?>">
        <div class="table__row table__header">
            <div class="table__cell">Servicio</div>
            <div class="table__cell">Última facturación</div>
            <div class="table__cell"></div>
            <div class="table__cell"></div>
        </div>
            <?php if(empty($servicios_cliente)):?>
        <div class="table__row">
            <div class="table__cell">Sin servicios para facturar</div>
        </div>
    
            <?php else:
                foreach($servicios_cliente as $serv_contratado)
                {
                    echo "<div class='table__row' data-servicio='${serv_contratado}'>\n";
                    echo "\t<div class='table__cell' data-servicio='${serv_contratado}'>${serv_contratado}</div>\n";
                    if(empty($facturaciones[$rut_cliente][$serv_contratado]))
                    {
                        echo "\t<div class='table__cell'>Sin facturar aún</div>\n";
                        echo "\t<div class='table__cell'><a class='btn btn--small btn-facturar' data-rut='${rut_cliente}' data-servicio='${serv_contratado}' href=''>Facturar</a></div>\n";
                    }else
                    {
                        printf("\t<div class='table__cell'>%02d-%4d</div>\n", $facturaciones[$rut_cliente][$serv_contratado]['mes'], $facturaciones[$rut_cliente][$serv_contratado]['anio']);
                        $mes_fac = $facturaciones[$rut_cliente][$serv_contratado]['mes'];
                        $anio_fac = $facturaciones[$rut_cliente][$serv_contratado]['anio'];
                        $fecha_fac = \DateTime::createFromFormat("m-Y", $mes_fac."-".$anio_fac);
                        if($fecha_act->format("Y-m") > $fecha_fac->format("Y-m"))
                        {
                            // echo "<div fecha-actual='".$fecha_act->format("y-M")."' fecha-fac='".$fecha_fac->format('y-M')."'></div>";
                            echo "\t<div class='table__cell'><a class='btn btn--small btn-facturar' data-rut='${rut_cliente}' data-servicio='${serv_contratado}' href=''>Facturar</a></div>\n";   
                        }else
                        {
                            echo "\t<div class='table__cell'><div class='btn btn--small disabled'>Facturar</div></div>\n";
                        }
                    }
                    $facturacion_perso = "<div class='table__cell'>
                                            <form class='form-facturar' method='post' action='${url_action}'>
                                                <input type='date' name='fecha-emision' required>
                                                <input type='hidden' name='rut' value='${rut_cliente}'>
                                                <input type='hidden' name='servicio' value='${serv_contratado}'>
                                                <button class='btn btn--small btn-facturar-perso btn--square' type='submit' value='Facturar'>Facturar</button>
                                            </form>
                                        </div>\n";
                    echo $facturacion_perso;
                    echo "</div>";
                }
            ?>
            <?php endif;?>
    </div>
        <?php endforeach;?>
</div>