# Eloquent

Eloquent, el ORM de Laravel, proporciona una amplia variedad de métodos para interactuar con la base de datos y realizar operaciones comunes de CRUD (Crear, Leer, Actualizar, Eliminar) en tus modelos. A continuación, te proporciono una lista de algunos de los métodos más utilizados en Eloquent:

1. **all()**: Recupera todos los registros de la tabla asociada al modelo.

2. **find($id)**: Recupera un registro por su clave primaria.

3. **findOrFail($id)**: Recupera un registro por su clave primaria, lanzando una excepción si no se encuentra.

4. **where($campo, $operador, $valor)**: Realiza una consulta condicional en la base de datos.

5. **first()**: Recupera el primer registro que cumple con la condición de la consulta.

6. **create($atributos)**: Crea un nuevo registro en la base de datos y devuelve la instancia del modelo asociada.

7. **update($atributos)**: Actualiza los atributos de un modelo y guarda los cambios en la base de datos.

8. **delete()**: Elimina el registro asociado al modelo de la base de datos.

9. **count()**: Retorna el número total de registros que cumplen con la condición de la consulta.

10. **orderBy($campo, $direccion)**: Ordena los resultados de la consulta por un campo específico.

11. **limit($cantidad)**: Limita el número de resultados retornados por la consulta.

12. **pluck($columna)**: Retorna una colección de valores de una sola columna de la base de datos.

13. **whereHas($relacion, $closure)**: Permite realizar consultas condicionales en relaciones.

14. **with($relaciones)**: Carga relaciones asociadas al modelo.

15. **save()**: Guarda los cambios realizados en un modelo.

16. **get()**: Retorna una colección de resultados.

Estos son solo algunos de los métodos más comunes proporcionados por Eloquent. Existen muchos más métodos y técnicas avanzadas que puedes utilizar para realizar consultas y manipular datos de manera eficiente. La documentación oficial de Laravel ofrece una guía detallada sobre el uso de Eloquent y sus métodos: [Eloquent: Getting Started](https://laravel.com/docs/8.x/eloquent).

---
### Detalles y ejemplos

1. **`all()`**: Recupera todos los registros de la tabla asociada al modelo.

```php
$tasks = Task::all();
```

2. **`find($id)`**: Recupera un registro por su clave primaria.

```php
$task = Task::find(1);
```

3. **`findOrFail($id)`**: Recupera un registro por su clave primaria, lanzando una excepción si no se encuentra.

```php
$task = Task::findOrFail(1);
```

4. **`where($campo, $operador, $valor)`**: Realiza una consulta condicional en la base de datos.

```php
$tasks = Task::where('completed', true)->get();
```

5. **`first()`**: Recupera el primer registro que cumple con la condición de la consulta.

```php
$firstTask = Task::where('completed', false)->first();
```

6. **`create($atributos)`**: Crea un nuevo registro en la base de datos y devuelve la instancia del modelo asociada.

```php
$newTask = Task::create(['name' => 'Nueva Tarea', 'completed' => false]);
```

7. **`update($atributos)`**: Actualiza los atributos de un modelo y guarda los cambios en la base de datos.

```php
$task = Task::find(1);
$task->update(['completed' => true]);
```

8. **`delete()`**: Elimina el registro asociado al modelo de la base de datos.

```php
$task = Task::find(1);
$task->delete();
```

9. **`count()`**: Retorna el número total de registros que cumplen con la condición de la consulta.

```php
$completedTasks = Task::where('completed', true)->count();
```

10. **`orderBy($campo, $direccion)`**: Ordena los resultados de la consulta por un campo específico.

```php
$tasks = Task::orderBy('name', 'asc')->get();
```

11. **`limit($cantidad)`**: Limita el número de resultados retornados por la consulta.

```php
$tasks = Task::limit(5)->get();
```

12. **`pluck($columna)`**: Retorna una colección de valores de una sola columna de la base de datos.

```php
$taskNames = Task::pluck('name');
```

13. **`whereHas($relacion, $closure)`**: Permite realizar consultas condicionales en relaciones.

```php
$tasks = Task::whereHas('user', function($query) {
    $query->where('role', 'admin');
})->get();
```

14. **`with($relaciones)`**: Carga relaciones asociadas al modelo.

```php
$tasks = Task::with('user')->get();
```

15. **`save()`**: Guarda los cambios realizados en un modelo.

```php
$task = Task::find(1);
$task->name = 'Nueva tarea';
$task->save();
```

16. **`get()`**: Retorna una colección de resultados.

```php
$tasks = Task::where('completed', false)->get();
```

---
### Paginación
La paginación es un mecanismo que te permite dividir un conjunto grande de resultados en páginas más pequeñas, lo que facilita la navegación y mejora la experiencia del usuario al interactuar con grandes conjuntos de datos. En el contexto de Laravel, Eloquent proporciona métodos para realizar paginación de resultados de consultas.

#### Métodos de Paginación en Eloquent

1. **`paginate($porPagina)`**: Este método divide los resultados en un número específico de elementos por página y devuelve una instancia de `\Illuminate\Pagination\Paginator`.

   ```php
   $tasks = Task::paginate(10);
   ```

   Esto devolverá una colección de tareas paginada, donde cada página tendrá hasta 10 elementos.

2. **`simplePaginate($porPagina)`**: Similar a `paginate`, pero devuelve una instancia de `\Illuminate\Pagination\LengthAwarePaginator` que no incluye el número total de elementos.

   ```php
   $tasks = Task::simplePaginate(10);
   ```

   Esto es útil cuando no necesitas mostrar el número total de resultados.

#### Uso en las Vistas de Blade

Una vez que has paginado los resultados, puedes usar las variables proporcionadas por Laravel en tus vistas de Blade para renderizar la paginación:

```blade
@foreach($tasks as $task)
    <!-- Renderizar los resultados -->
@endforeach

{{ $tasks->links() }}
```

El método `links()` generará los enlaces de paginación, lo que permitirá a los usuarios navegar entre las diferentes páginas de resultados.

#### Personalización de la Paginación

Puedes personalizar la apariencia y comportamiento de la paginación modificando las vistas predeterminadas proporcionadas por Laravel. Para hacerlo, ejecuta el comando `php artisan vendor:publish --tag=laravel-pagination` para publicar las vistas de paginación y luego edítalas según tus necesidades.

#### Combinar paginate con otros métodos
Puedes combinar el método `paginate` con otros métodos de Eloquent para refinar los resultados antes de paginarlos. Esto es útil cuando deseas realizar filtros, ordenamientos u otras operaciones antes de presentar los datos paginados a los usuarios.

Aquí hay un ejemplo de cómo puedes hacerlo:

Supongamos que tienes un modelo `Task` y quieres paginar solo las tareas completadas, ordenadas por fecha de creación:

```php
$tasks = Task::where('completed', true)
             ->orderBy('created_at', 'desc')
             ->paginate(10);
```

En este ejemplo, primero filtramos las tareas completadas utilizando `where('completed', true)`. Luego, las ordenamos por fecha de creación en orden descendente con `orderBy('created_at', 'desc')`. Finalmente, aplicamos la paginación con `paginate(10)` para dividir los resultados en páginas de 10 elementos cada una.

También puedes combinar múltiples métodos de esta manera para refinar aún más tus resultados según tus necesidades.

Recuerda que el orden en el que aplicas los métodos es importante, ya que cada método afecta los resultados que se pasan al siguiente. Por lo tanto, si tienes una lógica de filtrado o clasificación específica en mente, asegúrate de aplicar los métodos en el orden correcto.

En resumen, combinar `paginate` con otros métodos de Eloquent te brinda la flexibilidad para realizar operaciones complejas en tus consultas antes de presentar los resultados paginados a tus usuarios. Esto te permite ofrecer una experiencia de usuario más refinada y específica según los requisitos de tu aplicación.

#### Consideraciones Finales

La paginación es particularmente útil cuando trabajas con grandes conjuntos de datos, ya que mejora la eficiencia y la experiencia del usuario al evitar la carga de una gran cantidad de resultados de una sola vez. Es una característica esencial para aplicaciones web que manejan grandes volúmenes de información.

Recuerda que la paginación en Laravel es fácil de implementar gracias a las herramientas proporcionadas por el framework, lo que te permite ofrecer a tus usuarios una experiencia de navegación más fluida y amigable.