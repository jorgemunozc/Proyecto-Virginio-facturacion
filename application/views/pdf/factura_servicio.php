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
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo base_url().'public/css/factura_servicio.css'?>">
    <title>Factura</title>
</head>
<body>
    <div class="btn" id="downloadPDF">Descargar versión PDF</div>
    <div id="factura">
        <div class="heading">
        <!-- DATOS SERVICIO -->
            <div class="servicio">
                <div class="servicio__logo"><img src="<?php echo base_url().'public/images/'.$datos_servicio->url_logo;?>" alt="" srcset=""></div>
                <div class="servicio__datos">
                    <div class="servicio__titulo"><?php echo $datos_servicio->razon_social;?></div>
                    <div class="servicio__subtitulo"><?php echo $datos_servicio->giro;?></div>
                    <div class="servicio__h3"><?php echo $datos_servicio->direccion;?></div>
                    <div class="servicio__h3"><?php echo $datos_servicio->comuna;?></div>
                </div>
            </div>
    
            <!-- TIMBRE -->
            <div class="wrapper-timbre">
                <div class="timbre">
                    <div class="timbre__rut">R.U.T.: <?php echo $datos_servicio->rut;?></div>
                    <div class="timbre__titulo-doc">Factura electronica</div>
                    <div class="timbre__folio">N° <?php printf("%05d", $datos_factura->folio);?></div>
                </div>
                <div class="sii">S.S.I.I. - CHILE</div>
            </div>
        </div>
    
        <!-- DATOS CLIENTE -->
        <div class="cliente">
            <div class="row">
                <div class="cell">
                    <div class="row cell--bolder"><?php echo $datos_cliente->razon_social;?></div>
                    <div class="row"><?php echo $datos_cliente->direccion?></div>
                    <div class="row"><?php echo $datos_cliente->comuna;?></div>
                    <div class="row"> RUT: <?php echo $datos_cliente->rut;?></div>
                    <div class="cell">GIRO: <?php echo $datos_cliente->giro;?></div>
                </div>
                <div class="cell">
                    <div class="row">
                        <div class="cell cell--bolder">Fecha Emisión</div>
                        <div class="cell"><?php printf("%02d/%02d/%4d", $datos_factura->dia_emision, $datos_factura->mes_emision, $datos_factura->anio_emision);?></div>
                    </div>
                    <div class="row">
                        <div class="cell">Grupo Tarifario</div>
                        <div class="cell">B7T</div>
                    </div>
                    <div class="row">
                        <div class="cell">Tipo Facturación</div>
                        <div class="cell">NORMAL</div>
                    </div>
                    <div class="row">
                        <div class="cell cell--bolder">Fecha Vencimiento</div>
                        <div class="cell"><?php printf("%02d/%02d/%4d", $datos_factura->dia_vencimiento, $datos_factura->mes_vencimiento, $datos_factura->anio_vencimiento);?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NRO CLIENTE -->
        <div class="nro-cli">
            <div class="row">
                        <div class="cell text--md cell--bolder bg--primary-color txt--white">NÚMERO DE CLIENTE:</div>
                        <div class="cell"><?php echo $nro_cliente;?></div>
                        <div class="cell"></div>
            </div>
        </div>
        <!-- DETALLE FACTURA -->
        <div class="cuerpo-factura">
            <div class="col left">
                <div class="row header">
                    <div class="cell">Su consumo de este mes:</div>
                </div>
                <div class="table lecturas">
                    <div class="row">
                        <div class="cell">Lectura Actual</div>
                        <div class="cell"><?php printf("%02d/%02d/%4d", "03", $datos_factura->mes_emision, $datos_factura->anio_emision);?></div>
                        <div class="cell"><?php echo number_format($lect_actual);?></div>
                    </div>
                    <div class="row">
                        <div class="cell">Lectura Anterior</div>
                        <div class="cell"><?php printf("%02d/%02d/%4d", "03", $mes_ant, $anio);?></div>
                        <div class="cell"><?php echo number_format($lect_ant);?></div>
                    </div>
                    <div class="row"></div>
                    <div class="row">
                        <div class="cell">Consumo Calculado</div>
                        <div class="cell"></div>
                        <div class="cell"><?php echo $consumo;?></div>
                    </div>
                    <div class="row"></div>
                    <div class="row"></div>
                    <div class="row"></div>
                    <div class="row"></div>
                    <div class="row">
                        <div class="cell">Consumo Facturado</div>
                        <div class="cell"></div>
                        <div class="cell"><?php echo $consumo;?></div>
                    </div>

                    <div class="table">
                        <div class="row">
                            <div class="cell cell--bolder">Su consumo en los últimos meses:</div>
                        </div>
                        <div class="row">
                            <div class="cell">
                                <img class="grafico" src="<?php echo base_url().'public/images/grafica_consumo.png'?>" alt="Gráfica consumo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col right">
                <div class="row header">
                    <div class="cell">Su consumo en $ de este mes se calcula así:</div>
                </div>
                <div class="detalles">
                    <div class="table desglose">
                        <div class="table descripciones">
                            <?php for($i = 0; $i < count($config_fac->detalles); $i++):?>
                            <div class="row">
                                <div class="cell"><?php echo $config_fac->detalles[$i];?></div>
                                <div class="cell txt--right">
                                <?php
                                    $porcentaje = $config_fac->porcen_del_valor_total[$i]; 
                                    echo number_format($subtotal*(float)$porcentaje/100);
                                ?>
                                </div>
                            </div>
                            <?php endfor;?>   
                        </div>
                        <div class="table subtotal">
                            <div class="row">
                                <div class="cell">Subtotal Consumo Mes</div>
                                <div class="cell txt--right"><?php echo number_format($subtotal);?></div>
                            </div>
                            <div class="row">
                                <div class="cell">Intereses</div>
                                <div class="cell txt--right"><?php echo number_format($interes);?></div>
                            </div>
                        </div>
        
                        <div class="table totales">
                            <div class="row">
                                <div class="cell">Monto Neto</div>
                                <div class="cell txt--right"><?php echo number_format($datos_factura->neto);?></div>
                            </div>
                            <div class="row">
                                <div class="cell">IVA</div>
                                <div class="cell txt--right"><?php echo number_format($datos_factura->iva);?></div>
                            </div>
                            <div class="row">
                                <div class="cell">Monto Total</div>
                                <div class="cell txt--right"><?php echo number_format($datos_factura->total);?></div>
                            </div>
                        </div>
                    </div>
                    <div class="table a-pagar">
                        <div class="table txt--bigger">
                            <div class="row">
                                <div class="cell cell--bolder">TOTAL A PAGAR</div>
                                <div class="cell cell--bolder txt--right"><?php echo number_format($datos_factura->total);?></div>
                            </div>
                        </div>
                        <div class="cell total-en-nro">Son: <?php echo $f->format($datos_factura->total).' pesos';?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <div class="footer">
            <figure class="codigo">
                <img src="<?php echo base_url().'public/images/timbre_electronico.png'?>" alt="" srcset="">
                <figcaption>Timbre Electrónico</figcaption>
            </figure>
            <div class="leyenda">Documento educativo sin valor a efectos legales</div>
        </div>
    </div>
    <!-- SCRIPTS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script> -->
    <script src="https://unpkg.com/jspdf@1.5.2/dist/jspdf.min.js"></script>
    <script src="<?php echo base_url().'public/js/html2canvas.min.js'?>"></script>
    <script>
        $(document).ready(function(){
            $('#downloadPDF').on('click', function(e){
                printPDF(2);
            });
        })
    
        function printPDF(quality=1){
            const filename = '<?php printf("Factura_%s_%s_%04d", $nombre_cli, $tipo_servicio, $datos_factura->folio);?>';
            html2canvas(document.querySelector('#factura'), {scale: quality}).then(function (canvas){
                let pdf = new jsPDF('pdf', 'mm', 'letter');
                let width = pdf.internal.pageSize.getWidth();
                let height = pdf.internal.pageSize.getHeight();
                pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, width, height);
                pdf.save(filename);
            });
        }
    </script>
</body>
</html>