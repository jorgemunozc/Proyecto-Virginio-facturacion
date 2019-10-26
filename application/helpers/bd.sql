
CREATE TABLE cliente
(
    rut VARCHAR(15),
    razon_social VARCHAR(100) NOT NULL,
    giro VARCHAR(100) NOT NULL,
    direccion VARCHAR(50) NOT NULL,
    comuna VARCHAR(25) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    rango_cobros FLOAT,

    PRIMARY KEY(rut)
);

CREATE TABLE servicio
(
    tipo_servicio VARCHAR(45),
    razon_social VARCHAR(100) NOT NULL,
    rut VARCHAR(15) NOT NULL,
    giro    VARCHAR(100) NOT NULL,
    direccion VARCHAR(50) NOT NULL,
    comuna VARCHAR(25) NOT NULL,
    fono    VARCHAR(15) DEFAULT '',
    url_logo VARCHAR(300) DEFAULT '',

    PRIMARY KEY(tipo_servicio)
);

CREATE TABLE factura
(
    folio INT AUTO_INCREMENT UNIQUE,
    cliente__rut VARCHAR(45),
    servicio__tipo_servicio VARCHAR(45),
    dia_emision TINYINT,
    mes_emision TINYINT,
    anio_emision SMALLINT,
    dia_vencimiento TINYINT,
    mes_vencimiento TINYINT,
    anio_vencimiento SMALLINT,
    neto INT NOT NULL,
    exento INT DEFAULT 0,
    iva INT NOT NULL,
    total INT NOT NULL,
    PRIMARY KEY(cliente__rut, servicio__tipo_servicio, mes_emision, anio_emision),

    FOREIGN KEY (servicio__tipo_servicio) 
        REFERENCES servicio(tipo_servicio)
        ON UPDATE CASCADE,
    FOREIGN KEY (cliente__rut) 
        REFERENCES cliente(rut)
        ON UPDATE CASCADE
);

CREATE TABLE tarifa 
(
    cliente__rut VARCHAR(15),
    servicio__tipo_servicio VARCHAR(45),
    monto_tarifa INT NOT NULL,

    PRIMARY KEY(cliente__rut, servicio__tipo_servicio),

    FOREIGN KEY (cliente__rut) 
        REFERENCES cliente(rut)
        ON UPDATE CASCADE,
    FOREIGN KEY (servicio__tipo_servicio) 
        REFERENCES servicio(tipo_servicio)
        ON UPDATE CASCADE
);

CREATE TABLE configuracion_factura
(
    servicio__tipo_servicio VARCHAR(45),
    detalles VARCHAR(450),
    cantidades VARCHAR(100),
    porcen_del_valor_total VARCHAR(100),

    PRIMARY KEY(servicio__tipo_servicio),

    FOREIGN KEY(servicio__tipo_servicio) 
        REFERENCES servicio(tipo_servicio)
        ON UPDATE CASCADE
);