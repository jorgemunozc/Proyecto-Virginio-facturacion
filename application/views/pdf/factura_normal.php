<?php 
    $f = new \NumberFormatter('es', NumberFormatter::SPELLOUT);
    
    //parsing nombre cliente
    $nombre_cli = $datos_cliente->razon_social;
    $nombre_cli = str_replace(" ", "-", $nombre_cli);
    $nombre_cli = str_replace(".", "%2E", $nombre_cli); 
    
    //parsing tipo_servicio
    $tipo_servicio = $datos_factura->servicio__tipo_servicio;
    $tipo_servicio = str_replace(" ", "-", $tipo_servicio);
    //Determinando si es o no factura exenta
    $tipo_factura = "Factura Electrónica";
    if ($datos_servicio->exento == 1)
    {
        $tipo_factura = "Factura Exenta Electrónica";
    }

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
    <link rel="stylesheet" href="<?php echo base_url().'public/css/factura.css'?>">
    <link rel="shortcut icon" href="<?php echo base_url();?>public/favicon.ico">
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
                    <div class="timbre__titulo-doc"><?php echo $tipo_factura;?></div>
                    <div class="timbre__folio">N° <?php printf("%05d", $datos_factura->folio);?></div>
                </div>
                <div class="sii">S.S.I.I. - CHILE</div>
            </div>
        </div>
    
        <!-- DATOS CLIENTE -->
        <div class="cliente">
            <div class="row">
                <div class="cell">
                    <div class="row">
                        <div class="cell cell--bolder">Fecha Emisión</div>
                        <div class="cell"><?php printf("%02d/%02d/%4d", $datos_factura->dia_emision, $datos_factura->mes_emision, $datos_factura->anio_emision);?></div>
                    </div>
                </div>
                <div class="cell"></div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="row">
                        <div class="cell cell--bolder">Señor(es)</div>
                        <div class="cell"><?php echo $datos_cliente->razon_social;?></div>
                    </div>
                </div>
                <div class="cell">
                    <div class="row">
                        <div class="cell cell--bolder">R.U.T.</div>
                        <div class="cell"><?php echo $datos_cliente->rut;?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="row">
                        <div class="cell cell--bolder">Dirección</div>
                        <div class="cell"><?php echo $datos_cliente->direccion?></div>
                    </div>
                </div>
                <div class="cell">
                    <div class="row">
                        <div class="cell cell--bolder">Comuna</div>
                        <div class="cell"><?php echo $datos_cliente->comuna;?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="row">
                        <div class="cell cell--bolder">Giro</div>
                        <div class="cell"><?php echo $datos_cliente->giro;?></div>
                    </div>
                </div>
                <div class="cell">
                    <div class="row">
                        <div class="cell cell--bolder"></div>
                        <div class="cell"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="row">
                        <div class="cell cell--bolder">Fecha Vencimiento</div>
                        <div class="cell"><?php printf("%02d/%02d/%4d", $datos_factura->dia_vencimiento, $datos_factura->mes_vencimiento, $datos_factura->anio_vencimiento);?></div>
                    </div>
                </div>
                <div class="cell"></div>
            </div>
        </div>
    
        <!-- DETALLE FACTURA -->
        <div class="cuerpo-factura">
            <div class="detalles">
                <div class="row header">
                    <div class="cell descripcion">Descripción</div>
                    <div class="cell">Cantidad</div>
                    <div class="cell">Precio Unitario</div>
                    <div class="cell">Total</div>
                </div>
                <div class="row">
                    <div class="cell descripcion">
                        <?php foreach($config_fac->detalles as $detalle):?>
                        <div class="item"><?php echo $detalle;?></div>
                        <?php endforeach;?>
                    </div>
                    <div class="cell">
                        <?php foreach($config_fac->cantidades as $cantidad):?>
                        <div class="item"><?php echo $cantidad;?></div>
                        <?php endforeach;?>
                    </div>
                    <div class="cell">
                    <?php for($i = 0; $i < count($config_fac->cantidades); $i++):?>
                        <div class="item">
                        <?php 
                        if(! empty($config_fac->cantidades[$i]) OR ((int)$config_fac->cantidades[$i] != 0))
                        {
                            $prec_total = (float)$datos_factura->neto*(float)$config_fac->porcen_del_valor_total[$i]/100;    
                            $prec_unit = $prec_total/(float)$config_fac->cantidades[$i];
                            echo number_format($prec_unit);
                        }
                        ?>
                        </div>
                        <?php endfor;?>
                    </div>
                    <div class="cell">
                        <?php foreach($config_fac->porcen_del_valor_total as $porcentaje):?>
                        <div class="item txt--right"><?php echo number_format((float)($datos_factura->neto)*(float)$porcentaje/100);?></div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <div class="row totales">
                <div class="cell total-en-nro">Son: <?php echo $f->format($datos_factura->total).' pesos';?></div>
                <!-- <div class="cell"></div> -->
                <!-- <div class="cell"></div> -->
                <!-- <div class="cell"></div> -->
                <div class="cell">
                    <div class="row">
                        <div class="cell cell--bolder">Neto</div>
                        <div class="cell txt--right"><?php echo number_format($datos_factura->neto);?></div>
                    </div>
                    <div class="row">
                        <div class="cell cell--bolder">Exento</div>
                        <div class="cell txt--right"><?php echo number_format($datos_factura->exento);?></div>
                    </div>
                    <div class="row">
                        <div class="cell cell--bolder">IVA</div>
                        <div class="cell txt--right"><?php echo number_format($datos_factura->iva);?></div>
                    </div>
                    <div class="row">
                        <div class="cell cell--bolder">Total</div>
                        <div class="cell txt--right"><?php echo number_format($datos_factura->total);?></div>
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
    <!-- <div class="button" id="generarPDF">Generar PDF</div>
    <img id="foto" src="" alt="Foto del PDF"> -->
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
                // pdf.output('dataurlnewwindow');
            });
        }
    </script>
</body>
</html>