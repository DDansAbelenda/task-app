# Rutas

En las rutas se definen los puntos de entrada de la aplicación y las diferentes acciones que se realizarán en dependencia de la ruta y del tipo de verbo de entrada (GET, POST, PUT, DELETE, PATCH), en el caso de esta aplicación las rutas se definen en `routes/web.php` dado que contiene vistas front y por convensión este tipo de rutas se trabajan desde este fichero. A continuación el fichero de las rutas`definidas obviando las rutas por defecto que usa laravel:


```php
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

//Mis rutas
Route::get('/task', [TaskController::class, 'index' ])->name('task.index');
Route::post('/task', [TaskController::class, 'store' ])->name('task.store');
Route::patch('/task/{id}', [TaskController::class, 'update' ])->name('task.update');
Route::delete('/task/{id}', [TaskController::class, 'destroy' ])->name('task.destroy');
```
### Descripción detallada
Este código es un archivo de definición de rutas en Laravel. Explicaré cada parte del código detalladamente:

1. **Importaciones**:

   ```php
   use App\Http\Controllers\ProfileController;
   use App\Http\Controllers\TaskController;
   use Illuminate\Support\Facades\Route;
   ```

   - `use App\Http\Controllers\ProfileController;`: Esto importa el controlador `ProfileController` que se encuentra en la ruta especificada. Este controlador será utilizado para manejar las acciones relacionadas con los perfiles de usuario.

   - `use App\Http\Controllers\TaskController;`: Similar al punto anterior, esto importa el controlador `TaskController` que se encargará de manejar las acciones relacionadas con las tareas.

   - `use Illuminate\Support\Facades\Route;`: Esto importa la fachada `Route` de Laravel, que proporciona una forma de definir y administrar rutas en la aplicación.

2. **Definición de Rutas**:

   ```php
   // Rutas de las tareas
   Route::get('/task', [TaskController::class, 'index' ])->name('task.index');
   Route::post('/task', [TaskController::class, 'store' ])->name('task.store');
   Route::patch('/task/{id}', [TaskController::class, 'update' ])->name('task.update');
   Route::delete('/task/{id}', [TaskController::class, 'destroy' ])->name('task.destroy');
   ```

   - `Route::get('/task', [TaskController::class, 'index' ])->name('task.index');`: Esta línea define una ruta de tipo GET que responde a la URL `/task`. Cuando esta URL es accedida, se llama al método `index` del controlador `TaskController`. Además, se le asigna el nombre de ruta `task.index`, lo que permite referenciarla fácilmente en otras partes del código.

   - `Route::post('/task', [TaskController::class, 'store' ])->name('task.store');`: Similar al punto anterior, esta línea define una ruta de tipo POST para la misma URL `/task`, pero en este caso llama al método `store` del controlador `TaskController`. También se le asigna el nombre de ruta `task.store`.

   - `Route::patch('/task/{id}', [TaskController::class, 'update' ])->name('task.update');`: Esta línea define una ruta de tipo PATCH que incluye un parámetro `{id}` en la URL. Esto permite acceder a un recurso específico identificado por su ID. Cuando esta ruta es accedida, se llama al método `update` del controlador `TaskController`. El nombre de ruta asignado es `task.update`.

   - `Route::delete('/task/{id}', [TaskController::class, 'destroy' ])->name('task.destroy');`: Similar al punto anterior, esta línea define una ruta de tipo DELETE que también incluye un parámetro `{id}` en la URL. Cuando esta ruta es accedida, se llama al método `destroy` del controlador `TaskController`. El nombre de ruta asignado es `task.destroy`.

   En resumen, este código define las rutas necesarias para realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en tareas utilizando el controlador `TaskController`. Estas rutas permitirán a los usuarios interactuar con las tareas a través de la aplicación.



# Otros datos

En Laravel, las rutas son una parte fundamental del enrutamiento de una aplicación web. Definen cómo se deben responder las solicitudes HTTP entrantes y cómo se deben asociar a las acciones del controlador o a funciones de cierre (closures) que manejarán la solicitud.

Aquí tienes una explicación detallada sobre las rutas en Laravel:

### ¿Qué son las Rutas?

Las rutas en Laravel son definiciones que asocian una URI (Uniform Resource Identifier) o patrón de URL con una acción específica del controlador o un cierre (closure) de PHP. Esto permite a la aplicación saber qué acción tomar cuando una solicitud es enviada a una URL específica.

### ¿Para Qué se Utilizan las Rutas?

Las rutas se utilizan para:

1. **Definir Endpoints de la API**: En una API, las rutas se utilizan para definir los puntos de acceso que los clientes pueden usar para interactuar con la aplicación.

2. **Manejar las Solicitudes de una Aplicación Web**: En una aplicación web, las rutas definen cómo se deben manejar las solicitudes HTTP, como mostrar una página, procesar un formulario, etc.

3. **Asociar una URL con una Acción Específica**: Las rutas permiten al framework Laravel saber qué controlador o cierre debe ejecutarse cuando una URL específica es accedida.

### ¿Cómo se Definen las Rutas en Laravel?

Las rutas en Laravel se definen en el archivo `web.php` o `api.php` ubicado en el directorio `routes`.

#### Definición Básica:

```php
Route::get('/ruta', function () {
    return '¡Hola, Mundo!';
});
```

En este ejemplo, se define una ruta que responde a la URL `/ruta` con un mensaje "¡Hola, Mundo!".

#### Usando Controladores:

```php
Route::get('/usuario/{id}', 'UsuarioController@show');
```

Esta ruta se asocia a un controlador llamado `UsuarioController` y ejecuta el método `show` cuando se accede a una URL como `/usuario/1`.

### Tipos de Rutas en Laravel:

1. **Rutas Básicas**:

   - `Route::get($uri, $callback)`
   - `Route::post($uri, $callback)`
   - `Route::put($uri, $callback)`
   - `Route::delete($uri, $callback)`

2. **Rutas de Recurso**:

   - `Route::resource($name, $controller)`

   Este tipo de ruta automáticamente genera rutas para las acciones de CRUD (Create, Read, Update, Delete) en un controlador.

3. **Rutas Anidadas**:

   Las rutas pueden estar anidadas para organizar la lógica de la aplicación.

4. **Rutas con Parámetros**:

   Se pueden definir rutas con segmentos variables que se pasan como argumentos a la función de cierre o al método del controlador.

### Diferencias Entre `web.php` y `api.php`:

- **`web.php`**: Este archivo define rutas para aplicaciones web tradicionales que pueden usar sesiones y cookies. Generalmente se asocia con rutas de navegadores.
  
- **`api.php`**: Este archivo define rutas para APIs, y por lo general, se utiliza para construir servicios web. No tiene soporte para sesiones ni cookies por defecto.

En resumen, las rutas en Laravel son un componente esencial para definir cómo una aplicación debe responder a las solicitudes HTTP entrantes. Pueden asociar URLs con acciones específicas de controladores o funciones de cierre para manejar diferentes tipos de solicitudes. Esto proporciona una estructura organizada y fácil de mantener para el enrutamiento de una aplicación Laravel.