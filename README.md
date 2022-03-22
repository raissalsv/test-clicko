<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



## Prueba Técnica Clicko

Para la prueba he usado las seguintes tecnologias:

- <a href="https://laravel.com/docs/9.x/">Laravel 9</a>
- PHP 8
- MySql
- <a href="https://www.docker.com/products/docker-desktop/">Docker</a>
- PHP Unit 

## Instalación

- Clonar el repositorio
- Copiar .env.example para .env
- docker-compose up 
- Composer install 
- sail up
- sail php artisan migrate

Adjunto en la imagen las rutas posibles:

![Screenshot 2022-03-22 at 13 11 06](https://user-images.githubusercontent.com/19510203/159479134-380f769c-03b8-48d9-93ad-ceb1cd5a69f7.png)


## Ejemplos funcionalidades de Autenticación

Ruta registro <p>
He usado el Sanctum, el flujo es: 
Registrarse en la ruta registro con email, nombre, contraseña y confirmación de contraseña
![Screenshot 2022-03-22 at 12 34 22](https://user-images.githubusercontent.com/19510203/159475498-0017a518-272b-4e44-a58f-7d59108958be.png)

Ruta login <p>
Despues del registro se obdentrá en token al llamar la ruta de login, el token es usado para autenticar y permitir los requests a la API:
![Screenshot 2022-03-22 at 12 37 28](https://user-images.githubusercontent.com/19510203/159475820-eb25fe5e-c399-4e06-974b-e820a5ec77c6.png)

## Ejemplos funcionalidades CRUD

Para todas las rutas del CRUD, uso los metódos implicitos del Resource (POST,GET,PUT,DELETE)

Ruta POST Contactos <p>
Ejemplo de validacion cuando se hace el request POST sin los campos:
![Screenshot 2022-03-22 at 12 38 18](https://user-images.githubusercontent.com/19510203/159476491-aef6af88-61a5-4a93-8e06-0a2049e60867.png)

Ejemplo de cuando se envia con los campos correctos:
![Screenshot 2022-03-22 at 12 38 48](https://user-images.githubusercontent.com/19510203/159476667-68d45aea-d872-43b5-a7d2-8a9d7762409b.png)


Ruta GET Contactos <p>
Aqui pongo el ejemplo de como se tiene que enviar el token con autorizacion Bearer, esta ruta sin parametros trae todos los contactos registrados en la base de datos
![Screenshot 2022-03-22 at 12 59 00](https://user-images.githubusercontent.com/19510203/159477191-cc787829-0e49-47f3-a92c-b4a4cbd81b16.png)

Aqui GET Contactos pero buscando por su id:

![Screenshot 2022-03-22 at 13 02 22](https://user-images.githubusercontent.com/19510203/159477597-a0141e62-1cad-40ec-812d-9e8c246e804b.png)


Ruta PUT Contactos <p>
Para editar un contacto, pasando el id en la url
![Screenshot 2022-03-22 at 12 41 31](https://user-images.githubusercontent.com/19510203/159477899-b3a8435d-5939-4214-ba9a-92b9b58cb4fb.png)


Ruta DELETE Contactos <p>
Para borrar un contacto hay que pasar su id para la url
![Screenshot 2022-03-22 at 13 05 10](https://user-images.githubusercontent.com/19510203/159478094-5b85ab33-8769-4e20-96df-7a55f5b4c304.png)

Los tests se pueden ver usando el comando 
    php artisan test

    
Muchas gracias :)



