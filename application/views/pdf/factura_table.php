<<<<<<< HEAD
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
=======
<?php //$f = new \NumberFormatter('es', NumberFormatter::SPELLOUT);?>
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<<<<<<< HEAD
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
                
=======
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="<?php echo base_url().'public/css/factura.css'?>"> -->
    <title>Factura</title>
</head>
<body>
    <table id="factura">
    <thead>
        <tr class="header">
        <!-- DATOS SERVICIO -->
            <td class="servicio">
                <table>
                    <thead>
                        <tr class="servicio__logo">
                            <td>
                                <img src="<?php echo base_url().'public/images/'.$datos_servicio->url_logo;?>" alt="" srcset="">
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="servicio__titulo">
                            <td>
                                <?php echo $datos_servicio->razon_social;?>
                            </td>
                        </tr>
                        <tr class="servicio__subtitulo">
                            <td>
                                <?php echo $datos_servicio->giro;?>
                            </td>
                        </tr>
                        <tr class="servicios__h3">
                            <td>
                                <?php echo $datos_servicio->direccion;?> - <?php echo $datos_servicio->comuna;?>
                            </td>
                        </tr>
                    </tbody>
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
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
<<<<<<< HEAD
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
=======
    </thead>
    <tbody>
        <!-- DATOS CLIENTE -->
        <tr class="cliente">
            <td>
                <table>
                    <tr class="row">
                        <div class="cell">
                            <div class="row">
                                <div class="cell">Fecha</div>
                                <div class="cell"><?php printf("%2d/%2d/%4d", $datos_factura->dia_emision, $datos_factura->mes_emision, $datos_factura->anio_emision);?></div>
                            </div>
                        </div>
                    </tr>
                    <td class="row">
                        <div class="cell">
                        <div class="row">
                        <div class="cell campo">Señor(es)</div>
                        <div class="cell"><?php echo $datos_cliente->razon_social;?></div>
                        </div>
                        </div>
                        <div class="cell">
                        <div class="row">
                        <div class="cell campo">R.U.T.</div>
                        <div class="cell"><?php echo $datos_cliente->rut;?></div>
                        </div>
                        </div>
                    </td>
                    <td class="row">
                        <div class="cell">
                        <div class="row">
                        <div class="cell campo">Direccion</div>
                        <div class="cell"><?php echo $datos_cliente->direccion?></div>
                        </div>
                        </div>
                        <div class="cell">
                        <div class="row">
                        <div class="cell campo">Comuna</div>
                        <div class="cell"><?php echo $datos_cliente->comuna;?></div>
                        </div>
                        </div>
                    </td>
                    <td class="row">
                        <div class="cell">
                        <div class="row">
                        <div class="cell campo">Giro</div>
                        <div class="cell"><?php echo $datos_cliente->giro;?></div>
                        </div>
                        </div>
                        <div class="cell">
                        <div class="row">
                        <div class="cell campo"></div>
                        <div class="cell"></div>
                        </div>
                        </div>
                    </td>
                </table>
            </td>
        </tr>
    
        <!-- DETALLE FACTURA -->
        <tr class="cuerpo-factura">
            <td>
                <table>
                    <tr class="row header">
                        <th class="cell descripcion">Descripcion</th>
                        <!-- <?php if( ! empty($config_fac->cantidades)):?> -->
                        <th class="cell">Cantidad</th>
                        <!-- <?php endif;?> -->
                        <th class="cell">Precio Unitario</th>
                        <th class="cell">Total</th>
                    </tr>
                    
                    <?php for($i = 0; $i < count($config_fac->detalles); $i++):?>
                    <tr>
                        <td><?php echo $config_fac->detalles[$i];?></td>
                        <td><?php echo $config_fac->cantidades[$i];?></td>
                        <td>
                        <?php  if(! empty($config_fac->cantidades[$i]) OR ((int)$config_fac->cantidades[$i] != 0))
                        {
                            $prec_total = (float)$config_fac->neto*(float)$config_fac->porcen_del_valor_total[$i]/100;    
                            $prec_unit = $precio_total/(float)$config_fac->cantidades[$i];
                            echo number_format($prec_unit);
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        $porcentaje = $config_fac->porcen_del_valor_total[$i]; 
                        echo number_format((float)($datos_factura->neto)*(float)$porcentaje/100);?>
                        </td>
                    </tr>
                    <?php endfor;?>             
                    <tr class="row">
                        <td class="cell">Son: <?php //echo $f->format($datos_factura->total);?></td>
                        <td class="cell"></td>
                        <td class="cell"></td>
                        <!-- <div class="cell"></div> -->
                        <td class="cell">
                            <table>
                                <tr class="row">
                                    <td class="cell">Neto</td>
                                    <td class="cell"><?php echo number_format($datos_factura->neto);?></td>
                                </tr>
                                <tr class="row">
                                    <td class="cell">IVA</td>
                                    <td class="cell"><?php echo number_format($datos_factura->iva);?></td>
                                </tr>
                                <tr class="row">
                                    <td class="cell">Total</td>
                                    <td class="cell"><?php echo number_format($datos_factura->total);?></td>
                                </tr>
                            </table>
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
<<<<<<< HEAD
    </table>

    <!-- FOOTER -->
    <div class="footer">
        <div class="codigo"><img src="<?php echo base_url().'public/images/timbre_electronico.png'?>" alt="" srcset=""></div>
        <div class="leyenda">Documento docente sin valor a efectos legales</div>
    </div>
    </div>
=======
    </tbody>
    <tfoot>
        <!-- FOOTER -->
        <tr>
            <td class="codigo"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdsUMgw2KdI6lOrblXF8UoXaoeVz-jsLkKXWNOK8G9t4EPEZct7w" alt="" srcset=""></td>
        </tr>
        <tr>
            <td class="leyenda">Documento docente sin valor a efectos legales</td>
        </tr>
    </tfoot>
    </table>
    <!-- <div class="button" id="generarPDF">Generar PDF</div>
    <img id="foto" src="" alt="Foto del PDF"> -->
    <!-- SCRIPTS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script> -->
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    <script src="<?php echo base_url().'public/js/html2canvas.min.js'?>"></script>
    <script>
        $(window).on("load", function(){
            // $('#generarPDF').click(function(){
            //     alert('clicked');
            //     printPDF();
            // });
            // printPDF();
        });
        function printPDF(){
            const filename = '<?php echo $datos_factura->folio.".pdf";?>';
            html2canvas(document.body).then(function (canvas){
                let pdf = new jsPDF('pdf', 'mm', 'a4');
                let width = pdf.internal.pageSize.getWidth();
                let height = pdf.internal.pageSize.getHeight();
                pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, width, height);
                pdf.save(filename);
            });
        }
    </script>
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
</body>
</html>