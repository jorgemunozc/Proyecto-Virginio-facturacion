<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url().'public/css/factura.css'?>">
</head>
<body>
    <div class="heading">
        <div class="servicio">
            <!-- <div class="servicio__logo"><img src="<?php echo base_url().'public/images/Gas.png'?>" alt="" srcset=""></div> -->
            <div class="servicio__datos">
                <div class="servicio__titulo">Sociedad Comercializadora Libreria Rengo</div>
                <div class="servicio__subtitulo">Articulos de oficina y utiles escolares</div>
                <div class="servicios__h3">Rengo N° 555 - Los Angeles</div>
            </div>
        </div>
        <div class="wrapper-timbre">
            <div class="timbre">
                <div class="timbre__rut">R.U.T.: 76.476.176-6</div>
                <div class="timbre__titulo-doc">Factura electronica</div>
                <div class="timbre__folio">N° 0011587</div>
            </div>
            <div class="sii">S.I.I - LOS ANGELES</div>
        </div>
    </div>
    <div class="cliente">
        <div class="row">
            <div class="cell">
                <div class="row">
                    <div class="cell">Fecha</div>
                    <div class="cell">22 de Agosto de 2018</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="cell">
                <div class="row">
                    <div class="cell campo">Señor(es)</div>
                    <div class="cell">educacion profesional atenea s.a.</div>
                </div>
            </div>
            <div class="cell">
                <div class="row">
                    <div class="cell campo">R.U.T.</div>
                    <div class="cell">96.544.210-3</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="cell">
                <div class="row">
                    <div class="cell campo">Direccion</div>
                    <div class="cell">Arturo Prat 451</div>
                </div>
            </div>
            <div class="cell">
                <div class="row">
                    <div class="cell campo">Comuna</div>
                    <div class="cell">Los Angeles</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="cell">
                <div class="row">
                    <div class="cell campo">Giro</div>
                    <div class="cell">Educacion Superior</div>
                </div>
            </div>
            <div class="cell">
                <div class="row">
                    <div class="cell campo"></div>
                    <div class="cell"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="cuerpo-factura">
        <div class="row header">
            <div class="cell descripcion">Descripcion</div>
            <div class="cell">Cantidad</div>
            <div class="cell">% de descuento</div>
            <div class="cell">Precio Unitario</div>
            <div class="cell">Total</div>
        </div>
        <div class="row">
            <div class="cell descripcion">
                <div class="item">Caja papel fotografico</div>
                <div class="item">Plumones pizarra fultons azul</div>
                <div class="item">Hoja termolaminada</div>
                <div class="item">Caja de PApel autoadhesivo</div>
            </div>
            <div class="cell">
                <div class="item">1</div>
                <div class="item">10</div>
                <div class="item">100</div>
                <div class="item">2</div>
            </div>
            <div class="cell">
                <div class="item">0</div>
                <div class="item">0</div>
                <div class="item">0</div>
                <div class="item">0</div>
            </div>
            <div class="cell">
                <div class="item">6478</div>
                <div class="item">380</div>
                <div class="item">146</div>
                <div class="item">6577</div>
            </div>
            <div class="cell">
                <div class="item">6478</div>
                <div class="item">3800</div>
                <div class="item">14600</div>
                <div class="item">13154</div>
            </div>
        </div>
        <div class="row">
            <div class="cell"></div>
            <div class="cell"></div>
            <!-- <div class="cell"></div> -->
            <!-- <div class="cell"></div> -->
            <div class="cell">
                <div class="row">
                    <div class="cell">Neto</div>
                    <div class="cell">10000</div>
                </div>
                <div class="row">
                    <div class="cell">IVA</div>
                    <div class="cell">1900</div>
                </div>
                <div class="row">
                    <div class="cell">Total</div>
                    <div class="cell">11900</div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="codigo"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdsUMgw2KdI6lOrblXF8UoXaoeVz-jsLkKXWNOK8G9t4EPEZct7w" alt="" srcset=""></div>
        <div class="leyenda">Documento docente sin valor a efectos legales</div>
    </div>
</body>
</html>