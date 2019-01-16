<?php
$mes_act = date('m');
$anio_act = date('Y');
?>

<div class="lista-servicios">
    <?php
        foreach($servicios as $rut_cliente => $servicios_cliente):?>
    <div class="table hidden" data-cliente="<?php echo $rut_cliente;?>">
        <div class="table__row table__header">
            <div class="table__cell">Servicio</div>
            <div class="table__cell">Última facturación</div>
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
                    echo "\t<div class='table__cell' data-servicio='${serv_contratado}'/>${serv_contratado}</div>\n";
                    if(empty($facturaciones[$rut_cliente][$serv_contratado]))
                    {
                        echo "\t<div class='table__cell'>Sin facturar aún</div>\n";
                        echo "\t<div class='table__cell'><a class='btn btn--small' data-rut='${rut_cliente}' data-servicio='${serv_contratado}' href=''>Facturar</a></div>\n";
                    }else
                    {
                        echo "\t<div class='table__cell'>".$facturaciones[$rut_cliente][$serv_contratado]['mes']."-".$facturaciones[$rut_cliente][$serv_contratado]['anio']."</div>\n";
                        if( $facturaciones[$rut_cliente][$serv_contratado]['mes'] < $mes_act 
                            OR $facturaciones[$rut_cliente][$serv_contratado]['anio'] < $anio_act)
                            {
                                echo "\t<div class='table__cell'><a class='btn btn--small' data-rut='${rut_cliente}' data-servicio='${serv_contratado}' href=''>Facturar</a></div>\n";   
                            }else
                            {
                                echo "\t<div class='table__cell'><a class='btn btn--small' href=''>Facturar</a></div>\n";
                            }
                    }
                    echo "</div>";
                }
            ?>
            <?php endif;?>
    </div>
        <?php endforeach;?>
</div>