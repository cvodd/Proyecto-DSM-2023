

## IMPORTANTE
Debe tener previamente instalado composer y PHP >= 8.1.12 v para evitar futuros errores u problemas, una vez haya clonado el proyecto.

Una vez clonado el repositorio, crear una base de datos en mysql.

## Instalación

Ejecuta el siguiente comando para poder instalar composer en el proyecto.
```bash
composer install
```
Debemos copiar el archivo .env para poder establecer la conexión con nuestra base de datos.
```bash
copy .env.example .env
```
Este comando establecerá la APP_KEY en nuestro archivo .env
```bash
php artisan key:generate
```

Cambiamos los siguientes parámetros en el .env con las variables de entorno de la base de datos:
```bash
DB_PORT = Depende del puerto asignado por usted en la configuración de su base de datos(default: 3306)
DB_DATABASE = Aquí va el nombre de la base de datos creada en nuestro administrador de base de datos preferido.
DB_USERNAME = root
DB_PASSWORD = Es la contraseña que nosotros asignamos en la instalación, en caso de utilizar Xampp, Laragon, etc... Este campo se debe dejar vacío.
```

Este comando ejecutará las migraciones del proyecto y una vez creada las tablas en la base de datos, dará paso a ejecutar los seeders que forman parte del estado predeterminado del sistema.
```bash
php artisan migrate --seed
```

En caso de que no funcione la migración, actualiza el archivo .env con los siguientes comandos.
```bash
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```
Ahora procederemos a ejecutar el Sistema Web con los siguientes comandos:
```bash
php artisan serve
```

