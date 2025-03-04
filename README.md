﻿# AppSalon_MVC

## Descripción
Esta aplicación web simula una barbería, permitiendo a los clientes seleccionar servicios y reservar citas. Además, incluye una interfaz de administración donde los administradores pueden crear, leer, actualizar y eliminar (CRUD) servicios. La aplicación está conectada a una base de datos MySQL usando la estructura MVC (Modelo-Vista-Controlador).

## Instalación
1. Clona el repositorio:
    ```bash
    git clone https://github.com/usuario/repositorio.git
    ```
2. Navega al directorio del proyecto:
    ```bash
    cd repositorio
    ```
3. Instala las dependencias:
    ```bash
    npm install
    ```
4. Ejecuta Gulp para el desarrollo:
    ```bash
    npm run dev
    ```
5. Configura la base de datos MySQL y actualiza el archivo de configuración con las credenciales necesarias.
6. Inicia el servidor PHP desde la carpeta `public`:
    ```bash
    php -S localhost:3000
    ```

## Uso

### Clientes
1. Abre tu navegador y navega a `http://localhost:3000`.
2. Selecciona los servicios y reserva una cita. 
3. Regístrate con tu correo electrónico; se enviará un correo de confirmación usando PHPMailer.
4. Para pruebas, puedes usar los siguientes correos y contraseña:
    - correo2@correo.com
    - correo3@gmail.com

    Contraseña: `123456`

### Administradores
1. Accede a la interfaz de administración para gestionar los servicios.
2. Para asignar a un administrador, debes hacerlo directamente desde la base de datos.
3. Para pruebas, puedes usar el siguiente correo y contraseña:
    - admin@admin.com

    Contraseña: `123456`

## Características
- Selección de servicios por parte de los clientes.
- Reserva de citas con confirmación por correo electrónico.
- Gestión de servicios (CRUD) por parte de los administradores.
- Conexión a una base de datos MySQL.
- Estructura MVC (Modelo-Vista-Controlador).

## Tecnologías
- HTML, SASS, JavaScript, PHP
- MySQL
- PHPMailer

## Contribución
1. Haz un fork del proyecto.
2. Crea una nueva rama (`git checkout -b feature/nueva-caracteristica`).
3. Realiza tus cambios y haz un commit (`git commit -am 'Añadir nueva característica'`).
4. Sube los cambios a tu rama (`git push origin feature/nueva-caracteristica`).
5. Abre un Pull Request.

## Licencia
Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo LICENSE para más detalles.
