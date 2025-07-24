# Tienda de Maquillaje - Sistema de Gestión de Citas y Usuarios

Este proyecto es una aplicación web desarrollada en PHP para la gestión de una tienda de maquillaje. Permite a los usuarios registrarse, iniciar sesión, agendar citas, visualizar y administrar sus citas, así como consultar productos y servicios ofrecidos por la tienda.

## ¿Qué es?
Es un sistema web que facilita la administración de citas y usuarios para una tienda de maquillaje, integrando funcionalidades de registro, inicio de sesión, gestión de citas y visualización de productos.

## ¿Para qué sirve?
- **Clientes:** Pueden crear una cuenta, iniciar sesión, agendar y consultar sus citas, y ver los productos y servicios disponibles.
- **Administradores:** Pueden gestionar las citas, editar o eliminar registros y mantener actualizada la información de productos y servicios.

## ¿Cómo funciona?
1. **Registro de usuarios:** Los clientes pueden registrarse mediante un formulario que solicita nombre, correo y contraseña.
2. **Inicio de sesión:** Los usuarios registrados pueden acceder al sistema usando su correo y contraseña.
3. **Agendar citas:** Los usuarios pueden solicitar una cita completando un formulario con los datos requeridos.
4. **Gestión de citas:** Los usuarios pueden ver, editar o eliminar sus citas desde la sección correspondiente.
5. **Visualización de productos y servicios:** El sistema muestra los productos y servicios disponibles, con imágenes y descripciones.

## Estructura del proyecto
- `index.php`: Página principal.
- `register.php`: Registro de nuevos usuarios.
- `login.php`: Inicio de sesión.
- `agendar.php`: Formulario para agendar citas.
- `mis_citas.php`: Visualización y gestión de citas del usuario.
- `products.php`: Catálogo de productos.
- `send.php` y `send_cita.php`: Procesamiento de formularios.
- `conexion.php`: Conexión a la base de datos.
- Archivos CSS para estilos personalizados.
- Carpeta `images/` con imágenes de productos y servicios.

## Requisitos
- Servidor web (XAMPP, WAMP, etc.)
- PHP 7.x o superior
- MySQL para la base de datos

## Instalación y uso
1. Clona o descarga el repositorio en tu servidor local.
2. Configura la base de datos en `conexion.php`.
3. Inicia el servidor web y accede a `index.php` desde tu navegador.
4. Regístrate, inicia sesión y comienza a utilizar el sistema.

## Créditos
Desarrollado por 14-Brandon para la gestión de una tienda de maquillaje.

## Licencia
Este proyecto es de uso educativo y puede ser modificado según las necesidades del usuario.
