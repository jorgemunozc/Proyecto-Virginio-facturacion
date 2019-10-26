<?php 
    $f = new \NumberFormatter('es', NumberFormatter::SPELLOUT);
    $neto = $datos_factura->neto;
    // $interes = floor($neto*mt_rand(1,5)/100);
    $interes = floor($datos_factura->neto*0.02);
    $subtotal = $neto - $interes;

    //procesamiento fechas lecturas
    $mes_ant = $datos_factura->mes_emision - 1;
    $anio = (int)$datos_factura->anio_emision;
    if((int)$datos_factura->mes_emision == 1)
    {
        $mes_ant = 12;
        $anio = (int)$datos_factura->anio_emision - 1;
    }

    //lecturas
    $lect_ant = $datos_factura->total/30;
    $lect_actual = $lect_ant + floor($lect_ant*0.02);
    $consumo = number_format($lect_actual - $lect_ant, 2);

    //Calculo nro Servicio
    $rut = $datos_cliente->rut;
    $partes_rut = explode('.', $rut);
    if(count($partes_rut) == 3)
    {
        $nro_cliente = $partes_rut[0].$partes_rut[2];
    }else 
    {
        $nro_rand = mt_rand(123456, 999999);
        $digito_rand = mt_rand(1,9);
        $nro_cliente = $nro_rand.'-'.$digito_rand;
    }

    //parsing nombre cliente
    $nombre_cli = $datos_cliente->razon_social;
    $nombre_cli = str_replace(" ", "-", $nombre_cli);
    $nombre_cli = str_replace(".", "%2E", $nombre_cli);

    //parsing tipo_servicio
    $tipo_servicio = $datos_factura->servicio__tipo_servicio;
    $tipo_servicio = str_replace(" ", "-", $tipo_servicio);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url('public/css/factura_table.css')?>">
    <title>Factura</title>
</head>
<body>
    <div id="factura">
    <table class="heading">
        <tr>
        <!-- DATOS SERVICIO -->
            <td class="servicio">
                <table>
                    <tr>
                        <td class="servicio__datos">
                            <div class="servicio__titulo">
                                
                                <?php echo $datos_servicio->razon_social;?>
                            
                            </div>
                            <div class="servicio__subtitulo">
                                
                                <?php echo $datos_servicio->giro;?>
                            
                            </div>
                            <div class="servicio__h3">
                                
                                <?php echo $datos_servicio->direccion;?> - <?php echo $datos_servicio->comuna;?>
                            
                            </div>
                        </td>
                        <td>
                            <img class="servicio__logo" src="<?php echo base_url().'public/images/'.$datos_servicio->url_logo;?>" alt="" srcset="">
                        </td>
                    </tr>
                
                </table>
            </td>
    
            <!-- TIMBRE -->
            <td class="wrapper-timbre">
                <div class="timbre">
                    <div class="timbre__rut">R.U.T.: <?php echo $datos_servicio->rut;?></div>
                    <div class="timbre__titulo-doc">Factura electronica</div>
                    <div class="timbre__folio">N° <?php printf("%05d", $datos_factura->folio);?></div>
                </div>
                <div class="sii">S.S.I.I. - CHILE</div>
            </td>
        </tr>
    </table>
    
    <!-- DATOS CLIENTE -->
    
    
    <table class="cliente">
        <tr>
            <td>
                <div class="cell"><?php echo $datos_cliente->razon_social;?></div>
                <div class="cell"><?php echo $datos_cliente->direccion?></div>
                <div class="cell"><?php echo $datos_cliente->comuna;?></div>
                <div class="cell">RUT: <?php echo $datos_cliente->rut;?></div>
                <div class="cell">GIRO: <?php echo $datos_cliente->giro;?></div>
            </td>
            <td>
                <table>
                    <tr>
                        <td>Fecha Emisión</td>
                        <td><?php printf("%2d/%02d/%4d", $datos_factura->dia_emision, $datos_factura->mes_emision, $datos_factura->anio_emision);?></td>
                    </tr>
                    <tr>
                        <td>Grupo Tarifario</td>
                        <td>B7T</td>
                    </tr>
                    <tr>
                        <td>Tipo Facturación</td>
                        <td>NORMAL</td>
                    </tr>
                    <tr>
                        <td>Fecha Vencimiento</td>
                        <td><?php printf("%2d/%02d/%4d", $datos_factura->dia_vencimiento, $datos_factura->mes_vencimiento, $datos_factura->anio_vencimiento);?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>



    <!-- NRO CLIENTE -->
    <table>
        <tr>
            <td>Nro Cliente</td>
            <td>1234567-9</td>
        </tr>
    </table>



    <!-- DETALLE FACTURA -->
    <table class="cuerpo-factura">
        <tr>
            <td class="col left">
                    <div class="header">Su consumo de este mes:</div>
                    <table class="table lecturas">
                        <tr class="row">
                            <td class="cell">Lectura Actual</td>
                            <td class="cell"><?php printf("%02d/%02d/%4d", "03", $datos_factura->mes_emision, $datos_factura->anio_emision);?></td>
                            <td class="cell"><?php echo number_format($lect_actual);?></td>
                        </tr>
                        <tr class="row">
                            <td class="cell">Lectura Anterior</td>
                            <td class="cell"><?php printf("%02d/%02d/%4d", "03", $mes_ant, $anio);?></td>
                            <td class="cell"><?php echo number_format($lect_ant);?></td>
                        </tr>
                        <tr class="row"></tr>
                        <tr class="row">
                            <td class="cell">Consumo Calculado</td>
                            <td class="cell"></td>
                            <td class="cell"><?php echo $consumo;?></td>
                        </tr>
                        <tr class="row"></tr>
                        <tr class="row"></tr>
                        <tr class="row"></tr>
                        <tr class="row"></tr>
                        <tr class="row">
                            <td class="cell">Consumo Facturado</td>
                            <td class="cell"></td>
                            <td class="cell"><?php echo $consumo;?></td>
                        </tr>

                        <tr class="table">
                            <td>
                                <div class="row">
                                    <div class="cell cell--bolder">Su consumo en los últimos meses:</div>
                                </div>
                                <div class="row">
                                    <div class="cell">
                                        <img class="grafico" src="<?php echo base_url().'public/images/grafica_consumo.png'?>" alt="Gráfica consumo">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
            </td>
            <td class="col right">
                <div class="cell">Su consumo en $ de este mes se calcula así:</div>
            
                <table class="detalles">
                    <tr>
                        <td>
                            <table class="table desglose">
                                <tr>
                                    <td>
                                        <table class="table descripciones">
                                            <?php for($i = 0; $i < count($config_fac->detalles); $i++):?>
                                            <tr class="row">
                                                <td class="cell"><?php echo $config_fac->detalles[$i];?></td>
                                                <td class="cell txt--right">
                                                <?php
                                                    $porcentaje = $config_fac->porcen_del_valor_total[$i]; 
                                                    echo number_format($subtotal*(float)$porcentaje/100);
                                                ?>
                                                </td>
                                            </tr>
                                            <?php endfor;?>   
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table class="table subtotal">
                                            <tr class="row">
                                                <td class="cell">Subtotal Consumo Mes</td>
                                                <td class="cell txt--right"><?php echo number_format($subtotal);?></td>
                                            </tr>
                                            <tr class="row">
                                                <td class="cell">Intereses</td>
                                                <td class="cell txt--right"><?php echo number_format($interes);?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                
                                <tr>
                                    <td>
                                        <table class="table totales">
                                            <tr class="row">
                                                <td class="cell">Monto Neto</td>
                                                <td class="cell txt--right"><?php echo number_format($datos_factura->neto);?></td>
                                            </tr>
                                            <tr class="row">
                                                <td class="cell">IVA</td>
                                                <td class="cell txt--right"><?php echo number_format($datos_factura->iva);?></td>
                                            </tr>
                                            <tr class="row">
                                                <td class="cell">Monto Total</td>
                                                <td class="cell txt--right"><?php echo number_format($datos_factura->total);?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <div class="table a-pagar">
                                <table class="table txt--bigger">
                                    <tr class="row">
                                        <td class="cell cell--bolder">TOTAL A PAGAR</td>
                                        <td class="cell cell--bolder txt--right"><?php echo number_format($datos_factura->total);?></td>
                                    </tr>
                                </table>
                                <div class="cell total-en-nro">Son: <?php echo $f->format($datos_factura->total).' pesos';?></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        <div class="codigo"><img src="<?php echo base_url().'public/images/timbre_electronico.png'?>" alt="" srcset=""></div>
        <div class="leyenda">Documento docente sin valor a efectos legales</div>
    </div>
    </div>
</body>
</html>