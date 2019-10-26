ALTER TABLE servicio
    ADD COLUMN exento bit DEFAULT 0;
ALTER TABLE `tarifa` 
    ADD `rango_cobros` FLOAT NULL DEFAULT NULL AFTER `monto_tarifa`;

