-- Crear tabla de productos
CREATE TABLE `productos` (
  `id_producto` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(50) NOT NULL,
  `precio` DECIMAL(10, 2) NOT NULL,
  `descripcion` TEXT,
  `stock` INT NOT NULL DEFAULT 0,
  `imagen_url` VARCHAR(255) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar datos de prueba en la tabla de productos
INSERT INTO `productos` (`nombre`, `precio`, `descripcion`, `stock`, `imagen_url`) VALUES
('Filtro de aire Bosch S0222', 19.99, 'Filtro de aire de alta calidad Bosch S0222, disenado para mejorar la eficiencia del motor y prolongar la vida util del vehiculo. Compatible con una amplia gama de modelos. Facil de instalar y fabricado con materiales duraderos.', 100, 'https://m.media-amazon.com/images/I/81DG9ltPomL._AC_UF894,1000_QL80_.jpg'),
('Filtro de aire K&N', 31.98, 'Filtro de aire K&N de alto rendimiento, lavable y reutilizable. Proporciona una excelente proteccion contra contaminantes mientras mejora el flujo de aire y el rendimiento del motor. Ideal para entusiastas de los automoviles que buscan la mejor calidad.', 80, 'https://motoadventure.es/3534-large_default/filtro-aire-kn-de-alto-rendimiento-lavable.jpg'),
('Filtro de aceite Mann-Filter HU 716/2 X', 14.99, 'Filtro de aceite Mann-Filter HU 716/2 X, ofrece una excelente proteccion del motor, capturando particulas nocivas y garantizando un flujo de aceite limpio. Facil de instalar y compatible con varios modelos de vehiculos.', 120, 'https://m.media-amazon.com/images/I/81sKDO3Y9CL._AC_SX679_.jpg'),
('Filtro de combustible Mahle KL 145', 25.50, 'Filtro de combustible Mahle KL 145, asegura un suministro de combustible limpio y eficiente, eliminando contaminantes y prolongando la vida util del motor. Compatible con una amplia variedad de vehiculos.', 90, 'https://media.autoteileprofi.de/360_photos/321625/preview.jpg'),
('Aceite de motor Castrol EDGE 5W-30 LL', 29.99, 'Aceite de motor sintetico Castrol EDGE 5W-30 LL, formulado para ofrecer la maxima proteccion y rendimiento en condiciones extremas. Reduce la friccion y mejora la eficiencia del combustible. Compatible con una amplia gama de vehiculos.', 50, 'https://www.ubricarmotos.com/23460-large_default/aceite-castrol-20w50-power-1-actevo-4t-4lts.jpg'),
('Aceite de motor Mobil 1 5W-30', 27.99, 'Aceite de motor sintetico Mobil 1 5W-30, proporciona una proteccion excepcional contra el desgaste, la suciedad y los depositos. Ideal para mantener el motor en condiciones optimas durante mas tiempo.', 60, 'https://www.racinglubes.fr/16608-large_default/aceite-de-motor-nuevo-mobil-1-esp-5w30.jpg'),
('Aceite de motor Shell Helix HX7 10W-40', 22.99, 'Aceite de motor semisintetico Shell Helix HX7 10W-40, ayuda a limpiar y proteger el motor, mejorando el rendimiento y la eficiencia del combustible. Compatible con una amplia gama de vehiculos.', 70, 'https://lubricantes-online.com/259914-large_default/shell-helix-hx7-10w40-1l.jpg'),
('Pastillas de freno Brembo P 85 020', 39.99, 'Pastillas de freno Brembo P 85 020, conocidas por su alto rendimiento y durabilidad. Proporcionan una excelente capacidad de frenado en todas las condiciones de conduccion. Ideales para conductores que buscan seguridad y calidad.', 75, 'https://media.autodoc.de/360_photos/1660847/h-preview.jpg'),
('Pastillas de freno Bosch BC905', 34.99, 'Pastillas de freno Bosch BC905, disenadas para ofrecer un rendimiento de frenado superior y una mayor durabilidad. Funcionan silenciosamente y son compatibles con una amplia gama de vehiculos.', 80, 'https://media.autodoc.de/360_photos/7886432/preview.jpg'),
('Pastillas de freno ATE 13.0460-7184.2', 29.99, 'Pastillas de freno ATE 13.0460-7184.2, ofrecen una excelente capacidad de frenado y una alta resistencia al desgaste. Proporcionan una conduccion segura y confiable en diversas condiciones.', 85, 'https://media.autodoc.de/360_photos/956271/preview.jpg'),
('Neumatico Michelin Pilot Sport 4', 150.00, 'Neumatico Michelin Pilot Sport 4, disenado para ofrecer un agarre excepcional y una respuesta precisa en condiciones secas y mojadas. Ideal para conductores deportivos que buscan un rendimiento superior.', 40, 'https://www.gruposadeco.com/imagenes/modelos/109693_n_MICHELIN_pilot-sport-4S.jpg'),
('Neumatico Pirelli Cinturato P7', 135.00, 'Neumatico Pirelli Cinturato P7, combina un alto rendimiento con un bajo consumo de combustible y una larga duracion. Excelente agarre y comodidad de conduccion en diversas condiciones climaticas.', 50, 'https://i.ebayimg.com/images/g/efgAAOSwp9RlTLLr/s-l1200.jpg'),
('Neumatico Bridgestone Turanza T005', 120.00, 'Neumatico Bridgestone Turanza T005, ofrece un rendimiento excepcional en mojado y una excelente durabilidad. Disenado para una conduccion confortable y segura en viajes largos.', 60, 'https://cdn-img1.pneus-online.com/produit/pneu-auto/1000/BRIDGESTONE_TURANZA_T005_L.jpg'),
('Bombilla H7 Philips X-tremeVision', 20.99, 'Bombilla H7 Philips X-tremeVision, proporciona hasta un 130% mas de vision en carretera. Ideal para conductores que buscan una mayor visibilidad y seguridad durante la conduccion nocturna.', 150, 'https://www.todoparatucoche.com/140920-large_default/set-lamparas-h7-philips-x-tremevision-pro150.jpg'),
('Bombilla H4 OSRAM Night Breaker Laser', 25.99, 'Bombilla H4 OSRAM Night Breaker Laser, ofrece una luz hasta un 150% mas brillante. Proporciona una mayor visibilidad y tiempo de reaccion en situaciones de conduccion nocturna.', 140, 'https://m.media-amazon.com/images/I/71AKt8JanqL.jpg'),
('Bombilla LED H11 Sylvania ZEVO', 30.99, 'Bombilla LED H11 Sylvania ZEVO, emite una luz blanca brillante y clara, mejorando la visibilidad y la apariencia del vehiculo. Larga vida util y facil instalacion.', 130, 'https://images-na.ssl-images-amazon.com/images/I/81YAjT8wP-L._MCnd_AC_SR462,462_.jpg');



-- Crear tabla de usuarios
CREATE TABLE `usuarios` (
  `usuario_id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar datos de prueba en la tabla de usuarios
INSERT INTO `usuarios` (`username`, `password`, `email`) VALUES
('usuario1', 'contrasena1234', 'usuario1@example.com'),
('usuario2', 'contrasena1234', 'usuario2@example.com');


CREATE TABLE `direcciones` (
    direccion_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nombre VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    poblacion VARCHAR(255) NOT NULL,
    provincia VARCHAR(255) NOT NULL,
    codigo_postal INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id)
);

-- Insert a direction for user 1
INSERT INTO `direcciones` (usuario_id, nombre, apellidos, direccion, poblacion, provincia, codigo_postal) VALUES
(1, 'John', 'Doe', '123 Main St', 'Springfield', 'Illinois', '62701'),
(2, 'Jane', 'Smith', '456 Elm St', 'Rivertown', 'California', '90210'),
(2, 'Jane', 'Smith', '789 Oak St', 'Lakeview', 'California', '90211');

CREATE TABLE `metodos_pago` (
    met_pago_id INT AUTO_INCREMENT PRIMARY KEY,
    metodo_pago VARCHAR(50) NOT NULL
);

INSERT INTO `metodos_pago` (metodo_pago) VALUES
('tarjeta credito'),
('tarjeta debito'),
('paypal');


CREATE TABLE `transacciones` (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    direccion_id INT,
    met_pago_id INT,
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id),
    FOREIGN KEY (direccion_id) REFERENCES direcciones(direccion_id),
    FOREIGN KEY (met_pago_id) REFERENCES metodos_pago(met_pago_id)
);

INSERT INTO transacciones (usuario_id, direccion_id, met_pago_id) VALUES
(1, 1, 1);

-- Crear tabla de pedidos
CREATE TABLE `pedidos` (
    entry_id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT NOT NULL,
    id_producto INT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    cantidad INT NOT NULL,
    FOREIGN KEY (transaction_id) REFERENCES transacciones(transaction_id),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);

INSERT INTO pedidos (transaction_id, id_producto, precio, cantidad) VALUES
(1, 2, 31.0, 1), -- Buying 1 of product 2.
(1, 4, 25.0, 1), -- Buying 1 of product 4.
(1, 6, 28.0, 4); -- Buying 4 of product 6.

