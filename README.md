# TFG-Final - Tienda Online

Este proyecto es una aplicación web de comercio electrónico (Tienda Online) desarrollada como Trabajo de Fin de Grado. Está construida con PHP nativo y MySQL, y totalmente contenerizada con Docker para facilitar su despliegue.

## 🚀 Características Principales

- **Gestión de Usuarios**: Registro e inicio de sesión seguro.
- **Catálogo de Productos**: Visualización de productos disponibles.
- **Carrito de Compras**: Funcionalidad para agregar productos y gestionar el pedido.
- **Proceso de Compra**: Flujo completo de checkout.
- **Base de Datos**: Integración con MySQL y administración vía phpMyAdmin.

## 🛠️ Tecnologías

- **Backend**: PHP (Apache)
- **Base de Datos**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Infraestructura**: Docker, Docker Compose
- **Herramientas**: ngrok (para tunelizar localhost)

## 📋 Requisitos Previos

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) instalado y en ejecución.

## ⚙️ Instalación y Despliegue

1. **Clonar o descargar el proyecto**.

2. **Navegar al directorio del proyecto**:
   Se asume que estás en la carpeta raíz `TFG-Final`.

3. **Iniciar los servicios con Docker Compose**:
   ```bash
   docker-compose up -d
   ```
   Este comando descargará las imágenes necesarias y levantará los contenedores en segundo plano.

4. **Verificar el estado**:
   ```bash
   docker ps
   ```
   Deberías ver los contenedores `tfg-final-web-1` (web), `mydatabase` (mysql) y `phpmyadmin` corriendo.

## 🔗 Acceso

Una vez desplegado, puedes acceder a los servicios en las siguientes URLs:

- **Tienda Web**: [http://localhost](http://localhost)
- **phpMyAdmin**: [http://localhost:8080](http://localhost:8080)
    - **Servidor**: `mysql`
    - **Usuario**: `user_name`
    - **Contraseña**: `user_password`

## 📂 Estructura del Proyecto

- `html/`: Contiene todo el código fuente de la aplicación (PHP, CSS, JS, imágenes).
- `database/`: Scripts SQL para inicializar la base de datos (`tienda.sql`).
- `docker-compose.yml`: Definición de los servicios y redes de Docker.
- `Dockerfile`: Configuración para construir la imagen del servidor web con extensiones PHP necesarias.

## 🛑 Detener el Proyecto

Para detener y eliminar los contenedores:
```bash
docker-compose down
```
