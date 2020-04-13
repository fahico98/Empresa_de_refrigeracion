
<?php

include "Conexion.php";

class Iniciador{

   private $conexion;

   public function __construct(){
      $this->conexion = new Conexion();
   }

   public function crearTablas(){

      $query = "CREATE TABLE IF NOT EXISTS clientes (
            id                      INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            documento               INT NOT NULL,
            nombre                  VARCHAR(50) NOT NULL,
            apellido                VARCHAR(50) NOT NULL,
            edad                    INT DEFAULT 0,
            telefono                VARCHAR(50) DEFAULT NULL,
            direccion               VARCHAR(50) DEFAULT NULL,
            email                   VARCHAR(50) DEFAULT NULL,
            placa                   VARCHAR(10) DEFAULT NULL
         ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish2_ci;";
      $this->conexion->pdo->query($query);

      $query = "CREATE TABLE IF NOT EXISTS empleados (
            id                      INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            documento               INT NOT NULL,
            nombre                  VARCHAR(50) NOT NULL,
            apellido                VARCHAR(50) NOT NULL,
            telefono                VARCHAR(50) DEFAULT NULL,
            cargo                   VARCHAR(50) DEFAULT NULL,
            sueldo                  INT(11) DEFAULT 0
         ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish2_ci;";
      $this->conexion->pdo->query($query);

      $query = "CREATE TABLE IF NOT EXISTS productos (
            id                      INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nombre                  VARCHAR(200) NOT NULL,
            clase                   VARCHAR(50) DEFAULT NULL,
            marca                   VARCHAR(50) DEFAULT NULL,
            cantidad                INT DEFAULT 0,
            costo_unitario          INT DEFAULT 0,
            observaciones           TEXT DEFAULT NULL
         ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish2_ci;";
      $this->conexion->pdo->query($query);

      $query = "CREATE TABLE IF NOT EXISTS servicios (
            id                      INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nombre                  VARCHAR(200) NOT NULL,
            tipo                    VARCHAR(50) DEFAULT NULL,
            costo                   INT DEFAULT 0,
            observaciones           TEXT DEFAULT NULL
         ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish2_ci;";
      $this->conexion->pdo->query($query);

      $query = "CREATE TABLE IF NOT EXISTS registro_vehiculos (
            id                      INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            cliente_id              INT(6) NOT NULL,
            placa                   VARCHAR(10) DEFAULT NULL,
            modelo                  VARCHAR(50) DEFAULT NULL,
            fecha_hora              DATETIME DEFAULT CURRENT_TIMESTAMP
         ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish2_ci;";
      $this->conexion->pdo->query($query);

      $query = "CREATE TABLE IF NOT EXISTS login (
            id                      INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            empleado_id             INT(6) NOT NULL,
            rol                     VARCHAR(50) NOT NULL,
            usuario                 VARCHAR(50) NOT NULL,
            contrasena              VARCHAR(250) NOT NULL
         ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish2_ci;";
      $this->conexion->pdo->query($query);

      $query = "CREATE TABLE IF NOT EXISTS compras (
            id                      INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            producto_id             INT(6) DEFAULT 0,
            servicio_id             INT(6) DEFAULT 0,
            empleado_id             INT(6) DEFAULT 0,
            factura_id              INT(6) DEFAULT 0,
            cantidad_producto       INT DEFAULT NULL,
            costo_compra            INT DEFAULT NULL,
            fecha_hora              DATETIME NOT NULL
         ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish2_ci;";
      $this->conexion->pdo->query($query);

      $query = "CREATE TABLE IF NOT EXISTS facturas (
            id                      INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            cliente_id              INT(6) NOT NULL,
            fecha_hora              DATETIME NOT NULL,
            costo_factura           INT DEFAULT 0
         ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish2_ci;";
      $this->conexion->pdo->query($query);

      $query = "ALTER TABLE login
         ADD CONSTRAINT c_1 FOREIGN KEY (empleado_id) REFERENCES empleados (id) ON UPDATE CASCADE;";
      $this->conexion->pdo->query($query);

      $query = "ALTER TABLE registro_vehiculos
         ADD CONSTRAINT c_2 FOREIGN KEY (cliente_id) REFERENCES clientes (id) ON UPDATE CASCADE;";
      $this->conexion->pdo->query($query);

      $query = "ALTER TABLE compras
         ADD CONSTRAINT c_3 FOREIGN KEY (producto_id) REFERENCES productos (id) ON UPDATE CASCADE,
         ADD CONSTRAINT c_4 FOREIGN KEY (servicio_id) REFERENCES servicios (id) ON UPDATE CASCADE,
         ADD CONSTRAINT c_5 FOREIGN KEY (empleado_id) REFERENCES empleados (id) ON UPDATE CASCADE,
         ADD CONSTRAINT c_6 FOREIGN KEY (factura_id) REFERENCES facturas (id) ON UPDATE CASCADE;";
      $this->conexion->pdo->query($query);

      $query = "ALTER TABLE facturas
         ADD CONSTRAINT c_7 FOREIGN KEY (cliente_id) REFERENCES clientes (id) ON UPDATE CASCADE;";
      $this->conexion->pdo->query($query);
   }

   public function llenarTablas(){
      
      $query = "INSERT INTO empleados (documento, nombre, apellido, telefono, cargo, sueldo) VALUES
         (1143830484, 'yurani andrea', 'duque santa', '3117717780', 'ingeniera de procesos y sistemas', 2000000),
         (1057583923, 'jeinner herley', 'gomez escamilla', '3143049585', 'ingeniero electrico y mecanico', 2000000),
         (16788787, 'juan carlos', 'luna', '3127335675', 'gerente general', 4000000),
         (1143830134, 'oscar', 'velosa', '3103930256', 'auxiliar tecnico', 1250000);";
      $this->conexion->pdo->query($query);

      $query = "INSERT INTO login (empleado_id, rol, usuario, contrasena) VALUES 
         (1, 'administrador', 'yurani123', '" . password_hash("12345678", PASSWORD_DEFAULT) . "'),
         (2, 'general', 'jeinner009', '" . password_hash("12345678", PASSWORD_DEFAULT) . "'),
         (3, 'administrador', 'juanca1990', '" . password_hash("12345678", PASSWORD_DEFAULT) . "'),
         (4, 'general', 'oscar2019', '" . password_hash("12345678", PASSWORD_DEFAULT) . "')";
      $this->conexion->pdo->query($query);

      $query = "INSERT INTO productos (nombre, clase, cantidad) VALUES 
         ('compresor de maquinaria amarilla',                           'compresores', 12),
         ('compresor',                                                  'compresores', 6),
         ('cluds y bobinas para compresor',                             'compresores', 12),
         ('repuesto para compresor',                                    'compresores', 12),
         ('valvula de expansión',                                       'valvulas', 48),
         ('valvula de control',                                         'valvulas', 48),
         ('motor de compuertas',                                        'motores', 6),
         ('motor de ventilador',                                        'motores', 6),
         ('blower',                                                     'motores', 6),
         ('ventilador',                                                 'eléctricos', 12),
         ('electroventilador',                                          'eléctricos', 12),
         ('evaporador universal',                                       'soldadura', 60),
         ('evaporador original',                                        'soldadura', 45),
         ('electrodos',                                                 'soldadura', 120),
         ('refrigerante tipo A',                                        'refrigerantes', 45),
         ('aceite',                                                     'refrigerantes', 12),
         ('filtro acumulador',                                          'filtros', 12),
         ('filtro corriente',                                           'filtros', 10),
         ('filtro de cabina',                                           'filtros', 10),
         ('fiting y tuberia especial',                                  'tubería', 150),
         ('tapas compresor',                                            'accesorios', 30),
         ('switch de control de termostato',                            'accesorios', 28),
         ('sello compresor',                                            'accesorios', 115),
         ('presostato',                                                 'accesorios', 50),
         ('polea tensora',                                              'accesorios', 50),
         ('gusanillo de valvula de servicio',                           'accesorios', 30),
         ('condensador',                                                'elementos de circuito', 50),
         ('resistencia',                                                'elementos de circuito', 60),
         ('fusible',                                                    'elementos de circuito', 60),
         ('cinta de esponja',                                           'miselaneos', 112),
         ('rejilla de recirculacion',                                   'miselaneos', 25),
         ('ye para ducto de 2 y 1/2 pulgada',                           'miselaneos', 45),
         ('boton',                                                      'miselaneos', 50),
         ('temperatura y aire',                                         'miselaneos', 45),
         ('actuador de vacio',                                          'miselaneos', 60),
         ('galon de aceite con viscocidad 125 de uso automotriz',       'miselaneos', 6),                                
         ('cinta cor tape',                                             'miselaneos', 10),
         ('mangera 6 - 8 - 10 - 12',                                    'miselaneos', 12),       
         ('rejilla redonda',                                            'miselaneos', 100),
         ('miniatura para ducto flexible de 2 pulgadas',                'miselaneos', 100),                    
         ('paso de gas fujy koki japones',                              'miselaneos', 16),              
         ('rejilla frente euro',                                        'miselaneos', 60);";
      $this->conexion->pdo->query($query);
      
      $query = "INSERT INTO servicios (nombre, tipo) VALUES 
         ('mantenimiento preventivo', 'mantenimiento'),
         ('revición de rutina', 'mantenimiento'),
         ('reparación de sistema eléctrico', 'reparación'),
         ('cambio de aceite', 'mantenimiento'),
         ('reemplazo de filtros', 'reparación');";
      $this->conexion->pdo->query($query);

      $query = "INSERT INTO clientes (documento, nombre, apellido, edad, telefono, direccion, email, placa) VALUES
         (1130525723, 'alexander', 'duque poveda', 36, '3043548394', 'calle 13 No 47-28', 'alexanderd@hotmail.com', 'CFR231K'),
         (1110543821, 'andres felipe', 'martinez', 21, '3128299659', 'calle 14 No 41-36', 'felipe12@gmail.com', 'VES254D'),
         (16888787, 'juan carlos', 'luna', 48, '3127335675', 'cra 17 bis No 25-18', 'juankl17@hotmail.com', 'KVA20B'),
         (28015447, 'nohelia patricia', 'hernandez', 45, '3101112355', 'cra 23A No 11-34', 'mohel_2304@gmail.com', 'ERK211A'),
         (1100991212, 'juan camilo', 'moreno heredia', 24, '3210912231', 'calle 15 No 90-01', 'camilohere@yahoo.com', 'OPP452');";
      $this->conexion->pdo->query($query);

      $query = "INSERT INTO registro_vehiculos (cliente_id, placa, modelo) VALUES 
         (2, 'VES254D', 'chevrolet aveo'),
         (4, 'ERK211A', 'renault symbol'),
         (5, 'VES254D', 'mazda 3');";
      $this->conexion->pdo->query($query);
   }
   
   public function cerrarConexion(){
      $this->conexion->cerrarConexion();
   }
}
