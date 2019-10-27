<<<<<<< HEAD
CREATE DATABASE servicios;
=======
CREATE DATABASE servicios_simulados;
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
CREATE USER 'test_user'@'localhost' IDENTIFIED BY 'kPr2QxWNTVxX93wwgj35';
GRANT SELECT, INSERT, UPDATE ON servicios_simulados.* TO 'test_user'@'localhost';
GRANT DELETE ON servicios_simulados.tarifa TO 'test_user'@'localhost';
CREATE TABLE servicios_simulados.admin (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    password CHAR(128) NOT NULL
);

<<<<<<< HEAD
INSERT INTO servicios.admin VALUES(1, 'jaime',
=======
INSERT INTO servicios_simulados.admin VALUES(1, 'jaime',
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
'$2y$10$orL5oz21gAQ3Upswbl6VpunejXXHpDZcn7gkRXd8O9w6DBmfnoePe');