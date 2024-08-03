# Framework PHP MVC
======================


Un framework PHP ligero y flexible inspirado en Laravel, con arquitectura MVC.

# Aclaraciones ⚠️

Este Framework está en desarrollo y no está totalmente completo. Aunque se han implementado las características básicas, todavía hay funcionalidades que faltan por implementar y posibles errores que necesitan ser corregidos.

## Características

* Arquitectura MVC (Modelo-Vista-Controlador)
* Routing dinámico
* Inyección de dependencias

## Requisitos

* PHP 8 o superior (Yo trabajé con esta versión)

## Instalación

1. Clona el repositorio en tu máquina local: `git clone https://github.com/dedasema/framework-php-mvc.git`

## Estructura del proyecto

* `app/`: Carpeta que contiene la lógica de la aplicación
	+ `Controllers/`: Carpeta que contiene los controladores
	+ `Models/`: Carpeta que contiene los modelos
* `config/`: Carpeta que contiene los archivos de configuración
* `public/`: Carpeta que contiene los archivos públicos (imágenes, CSS, JavaScript, etc.)
* `routes/`: Carpeta que contiene las rutas de la aplicación
* `resources/`: Carpeta que contiene las vistas, archivos css y js a ser compilados
* `lib`/: Carpeta que contiene clases y funciones de utilidad que se utilizan en todo el framework. En particular, contiene la clase Route que se encarga de manejar las rutas de la aplicación.
* `autoloader`: Contiene un script PHP que se encarga de cargar automáticamente las clases y archivos necesarios para la aplicación. Esto se logra mediante la función spl_autoload_register, que registra una función de autoload personalizada.

## Uso

1. Crea un nuevo controlador en la carpeta `app/Controllers/`
2. Crea un nuevo modelo en la carpeta `app/Models/`
3. Crea una nueva vista en la carpeta `resources/views/`
4. Configura las rutas en el archivo `routes/web.php`

## Licencia

Este proyecto está bajo la licencia MIT. Ver el archivo `LICENSE` para obtener más información.
