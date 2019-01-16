<?php //$f = new \NumberFormatter('es', NumberFormatter::SPELLOUT);?>
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
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
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
</body>
</html>