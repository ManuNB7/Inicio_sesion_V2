CREATE TABLE us_admin(
    id TINYINT unsigned PRIMARY KEY AUTO_INCREMENT,
    correo VARCHAR(50) NOT NULL UNIQUE,
    pw VARCHAR(80) NOT NULL,
    nombre VARCHAR(30) NOT NULL UNIQUE,
    perfil CHAR(2) NOT NULL
);