<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


![Aqui nos registramos y y como vemos aun no somo admintradores por tanto no podemos acceder a las rutas protegitas](image.png)
![vemos el usurio registrado en la Base de datos](image-1.png)
![ahora para darle acceso administrador al el usurio creado editamos la columna admin en la base de atos y le asigansmo un TRUE (1)](image-2.png)

![ahora con las credeciales en la ruta localhost:8000/api/login, nos logueamos y como vemos ya una vez logueado nos da la informacion del token parar la aurizacion y poder acceder a las rutas protegidas](image-3.png)
![aqui se puede observar la informacion del token, el caul lo usaremos para acceder al sistema y poder hacer el registro de producto, clintes y de las compras, ademas se puede observar que tenemos permisos de administrador](image-4.png)

![si quiero observar todas la compras realizadas tengo que poner el mi token en la parte de autorizacion y el token es de tipo bearer Token, y aluego accemos una petidion get a la ruta localhost:8000/api/compras la cual nos devuelve todas las compras realizadas](image-5.png)

![si into acceder a una ruta que es protegita si el token de autorizacion,me va mostrar un mensaje indicandome de que nos estoy autizado](image-6.png)

![ahora si yo le quito los derechos o permisos de adminitrado a el usuario, aun coloque el token de autorizacion, no voy a poder ver la informacion de las compras o mas bien no vpy a poder entrar a las rutas que requieren que seas administrador y que ademas este logueado o autorizado ](image-7.png)

![como se puede observar en esta aqui, intentamos acceder a una ruta parar traaer todas las compras realizadas, aunque hayamos puesto el token de autorizzacion o de auntenticacion, como desahbilite los permisos de adminitrador a dicho usurio no va poder acceder a la ruta parar poder ver las compras realizadas](image-8.png)

![lo mis mo tmbien pasa con las demas rutas como por ejemplo aqui borramos una compra](image-9.png)

![y si vemos si intenamos buscar dicha compra por su id, observamos de que ela compra dse borro exitosamente](image-10.png)

![y como vemos tambien podemos acceder a las demas rutas como por ejemplo aui traemos todos los productos que se encuentra registrados](image-11.png)

![aqui como se puede observar traemos a todos los clientes registrados](image-12.png)
## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:
