# clone-outlook
    Proyecto prueba técnica CIMA GROUP

# Tener instalado Quasar Framework
    Comando para instalar el CLI de Quasar Framework:
    npm i -g @quasar/cli

# Tener instalado Laravel Framework y Composer

# Tener instalado XAMP
    En mi prueba hice las inserciones, actualizaciones lectura y eliminación de registros a la Base de Datos con XAMP

# Instalar el proyecto
    Ejecutar un git clone en la consola de git para instalar el proyecto:

    Comando a ejecutar:
    git clone (ruta-repositorio)

    En mi caso ejecuté el comando anterior en una carpeta llamada: 
    PuebaTecnica

# Instalar dependencias (front)
    Una vez ya clonado el proyecto de GitLab instalar las dependencias necesarias para el front:
    
    Comando a ejecutar: 
    npm install

    En la siguiente ruta del proyecto:
    C:\PruebaTecnica\clone-outlook\front>npm install

# Instalar dependencias (back)
    Una vez ya clonado el proyecto de GitLab instalar las dependencias necesarias para el back:
    
    Comando a ejecutar: 
    composer install

    En la siguiente ruta del proyecto:
    C:\PruebaTecnica\clone-outlook\back>composer install

    Ejecutar el siguiente comando en la misma ruta:
    C:\PruebaTecnica\clone-outlook\back>composer dump-autoload

# Crear la Base de Datos (migrate)
    Una vez realizado lo anterior es necesario hacer las migraciones para poder crear la Base de datos y sus tablas

    Comando a ejecutar:
    php artisan migrate

    Ejecutar en la siguiente ruta:
    C:\PruebaTecnica\clone-outlook\back>php artisan migrate

# Ejecutar el proyecto (back)
    Una vez compleatadas las configuraciones anteriores es necesario levantar el servidor local en laravel:

    Comando a ejecutar:
    php artisan serve --port 8000
    (Es necesario ejecutarlo en el puerto 8000 ya que así lo tengo configurado en Quasar)

    Ejecutar en la siguiente ruta:
    C:\PruebaTecnica\clone-outlook\back>php artisan serve --port 8000

# Ejecutar el proyecto (front)
    Una vez ejecutado el servidor local en laravel y las configuraciones anteriores es necesario correr el proyecto en Quasar:

    Comando a ejecutar:
    quasar dev

    Ejecutar en la siguiente ruta:
    C:\PruebaTecnica\clone-outlook\front>quasar dev
