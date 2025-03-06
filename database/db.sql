CREATE TABLE roles (
                       id_rol INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       nombre_rol VARCHAR(255) NOT NULL UNIQUE KEY,
                       fyh_creacion DATETIME NULL,
                       fyh_actualizacion DATETIME NULL,
                       estado VARCHAR(11)

)ENGINE=InnoDB;

INSERT INTO roles (nombre_rol,fyh_creacion,estado) VALUES ('ADMINISTRADOR','2025-02-11 12:35:00','1');
INSERT INTO roles (nombre_rol,fyh_creacion,estado) VALUES ('DIRECCION TECNICA','2025-02-11 12:35:00','1');
INSERT INTO roles (nombre_rol,fyh_creacion,estado) VALUES ('REGENCIA FARMACEUTICA','2025-02-11 12:35:00','1');
INSERT INTO roles (nombre_rol,fyh_creacion,estado) VALUES ('ASEGURAMIENTO DE CALIDAD','2025-02-11 12:35:00','1');

CREATE TABLE usuarios (
    id_usuario INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    rol_id INT(11) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE KEY,
    usuario VARCHAR(255) NOT NULL UNIQUE KEY,
    password TEXT NOT NULL,
    perfil TEXT NOT NULL,
    fyh_creacion DATETIME NULL,
    fyh_actualizacion DATETIME NULL,
    estado VARCHAR(11),
    FOREIGN KEY (rol_id) REFERENCES roles (id_rol) on delete no action on update cascade

)ENGINE=InnoDB;

INSERT INTO usuarios (nombres,apellidos,rol_id,email,usuario,password,perfil,fyh_creacion,estado)
VALUES ('Wilmer Waldnio','Osco Vera','1','wilmerosco37@gmail.com','WOSCOV','q90j9Y8JPDVBufjyyFtPKojkhwjIKANZgKHAhMran9G2','imagen.jpg','2025-2-11 10:29:20','1');



CREATE TABLE formasfarmaceuticas (
                       id_forma INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       nombre_forma VARCHAR(255) NOT NULL UNIQUE KEY,
                       fyh_creacion_forma DATETIME NULL,
                       fyh_actualizacion_forma DATETIME NULL,
                       estado_forma VARCHAR(11)

)ENGINE=InnoDB;

INSERT INTO formasfarmaceuticas (nombre_forma,fyh_creacion_forma,estado_forma) VALUES ('CAPSULAS','2025-02-11 12:35:00','1');
INSERT INTO formasfarmaceuticas (nombre_forma,fyh_creacion_forma,estado_forma) VALUES ('COMPRIMIDOS','2025-02-11 12:35:00','1');
INSERT INTO formasfarmaceuticas (nombre_forma,fyh_creacion_forma,estado_forma) VALUES ('LIQUIDOS','2025-02-11 12:35:00','1');




CREATE TABLE medallas (
                                     id_medalla INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                     nombre_medalla VARCHAR(255) NOT NULL UNIQUE KEY,
                                     fyh_creacion_medalla DATETIME NULL,
                                     fyh_actualizacion_medalla DATETIME NULL,
                                     estado_medalla VARCHAR(11)

)ENGINE=InnoDB;

INSERT INTO medallas (nombre_medalla,fyh_creacion_medalla,estado_medalla) VALUES ('ORO','2025-02-11 12:35:00','1');
INSERT INTO medallas (nombre_medalla,fyh_creacion_medalla,estado_medalla) VALUES ('BRONCE','2025-02-11 12:35:00','1');
INSERT INTO medallas (nombre_medalla,fyh_creacion_medalla,estado_medalla) VALUES ('PLATA','2025-02-11 12:35:00','1');



CREATE TABLE certificados (
                              id_certificado INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                              producto VARCHAR(255) NOT NULL,
                              composicion TEXT NOT NULL,
                              forma_id INT(11) NOT NULL,
                              medalla_id INT(11) NOT NULL,
                              fecha_emision DATE NOT NULL,
                              fecha_vencimiento DATE NOT NULL,
                              vigencia VARCHAR(50) NOT NULL,
                              documento TEXT NOT NULL,
                              numero_registro_sanitario VARCHAR(100) UNIQUE NOT NULL,
                              codigo_liname VARCHAR(100) UNIQUE NOT NULL,
                              ficha_tecnica VARCHAR(50) NOT NULL,
                              fyh_creacion_certificado DATETIME NULL,
                              fyh_actualizacion_certificado DATETIME NULL,

    -- Claves foráneas
                              FOREIGN KEY (forma_id)
                                  REFERENCES formasfarmaceuticas(id_forma)
                                  ON DELETE RESTRICT
                                  ON UPDATE CASCADE,

                              FOREIGN KEY (medalla_id)
                                  REFERENCES medallas(id_medalla)
                                  ON DELETE RESTRICT
                                  ON UPDATE CASCADE

) ENGINE=InnoDB;


CREATE TABLE permisos (
                                     id_permiso INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                     nombre_url VARCHAR(255) NOT NULL UNIQUE KEY,
                                     url text NOT NULL UNIQUE KEY,

                                     fyh_creacion_permiso DATETIME NULL,
                                     fyh_actualizacion_permiso DATETIME NULL,
                                     estado_permiso VARCHAR(11)

)ENGINE=InnoDB;

    CREATE TABLE roles_permisos (
                              id_rol_permiso INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                              rol_id    INT(11) NOT NULL,
                              permiso_id INT(11) NOT NULL,

                              fyh_creacion_roles_permiso DATETIME NULL,
                              fyh_actualizacion_roles_permiso DATETIME NULL,
                              estado_roles_permiso VARCHAR(11),

                                  FOREIGN KEY (rol_id) REFERENCES roles (id_rol) on delete no action on update cascade,

                                  FOREIGN KEY (permiso_id) REFERENCES permisos (id_permiso) on delete no action on update cascade

    )ENGINE=InnoDB;