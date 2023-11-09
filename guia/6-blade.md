# Blade
En el caso del front de nuestra aplicación se utiliza el motor de plantillas de laravel blade, con este motor se inserta código de manera dinámica desde el servidor en las vistas de la aplicación, desde la vista `index.blade.php` ubicada en `resources/views/task` se interactúa con las diferentes funcionalidades que controlan la vista definidas en el controlador TaskController:

```html
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .success-message {
            background-color: #d1f5d1;
            color: #00a800;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .form-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-container input[type="text"] {
            flex: 1;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            outline: none;
        }

        .form-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            margin-left: 10px;
        }

        .task-list {
            list-style-type: none;
            padding: 0;
        }

        .task-list li {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .task-list li:last-child {
            border-bottom: none;
        }

        .task-label {
            flex: 1;
            margin-left: 10px;
        }

        .delete-form {
            margin-left: auto;
        }

        .delete-form button {
            color: #f00;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .completed {
            text-decoration: line-through;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">Tareas</h1>

        @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif


        <form method='POST' action="{{ route('task.store') }}" class="form-container">
            @csrf
            <input type="text" name="name" placeholder="Nombre de la tarea">
            <button type="submit">Crear</button>
        </form>


        <ul class="task-list">
            @foreach ($tasks as $task)
                <li>
                    <form id="form-{{ $task->id }}" method="POST" action="{{ route('task.update', $task->id) }}">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" class="task-checkbox" data-task-id="{{ $task->id }}" onclick = "submitForm({{ $task->id }})"
                            name = "cbx_completed" {{ $task->completed ? 'checked' : '' }}>
                        <label class="task-label {{ $task->completed ? 'completed' : '' }}">{{ $task->name }}</label>

                    </form>
                    <form method="POST" action="{{ route('task.destroy', $task->id) }}" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
    <script>
        function submitForm(taskId) {
            document.querySelector('#form-'+taskId).submit();
        }


    </script>
</body>

</html>

```

---
### Descripción detallada

#### Estilos

```CSS

body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .success-message {
            background-color: #d1f5d1;
            color: #00a800;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
```


* `body {...}`:  Este estilo se aplica al elemento `<body>`, lo que significa que afecta a todo el contenido de la página.
   - `font-family: Arial, sans-serif;`: Establece la fuente utilizada en el cuerpo del documento. En este caso, se elige "Arial" como primera opción, y si no está disponible, se utiliza una fuente sans-serif genérica.

* `.container {...}`: Este estilo se aplica a elementos con la clase "container". A menudo, se utiliza para encapsular el contenido principal de la página en un área limitada.
   - `max-width: 800px;`: Establece el ancho máximo del contenedor a 800 píxeles. Esto significa que el contenedor no se expandirá más allá de este ancho.
   - `margin: 0 auto;`: Centra el contenedor horizontalmente dentro de su elemento contenedor principal.
   - `padding: 40px;`: Agrega un espacio de 40 píxeles alrededor del contenido dentro del contenedor.

* `.title {...}`: Este estilo se aplica a elementos con la clase "title". Probablemente se use para encabezados o títulos en la página.
   - `font-size: 24px;`: Establece el tamaño de fuente del elemento a 24 píxeles.
   - `font-weight: bold;`: Hace que el texto sea más grueso (negrita).
   - `margin-bottom: 20px;`: Agrega un espacio de 20 píxeles en la parte inferior del elemento. Esto proporciona un espacio entre el título y los elementos siguientes.

*  `.success-message {...}`: Este estilo se aplica a elementos con la clase "success-message". Probablemente se use para mostrar mensajes de éxito en la página.
   - `background-color: #d1f5d1;`: Establece el color de fondo del elemento a un tono de verde claro (#d1f5d1).
   - `color: #00a800;`: Establece el color del texto a un tono de verde más oscuro (#00a800).
   - `padding: 10px;`: Agrega un espacio de 10 píxeles alrededor del contenido dentro del elemento.
   - `border-radius: 4px;`: Agrega esquinas redondeadas al elemento con un radio de 4 píxeles.
   - `margin-bottom: 20px;`: Agrega un espacio de 20 píxeles en la parte inferior del elemento. Esto proporciona un espacio entre el mensaje y los elementos siguientes.

```css
        .form-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-container input[type="text"] {
            flex: 1;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            outline: none;
        }

        .form-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            margin-left: 10px;
        }

        .task-list {
            list-style-type: none;
            padding: 0;
        }

        .task-list li {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

```

Claro, aquí está una descripción detallada de los estilos proporcionados:

* `.form-container {...}`:

   - **Descripción**: Este estilo se aplica a elementos con la clase "form-container". Probablemente se utiliza para contener formularios en la página.
   - `display: flex;`: Establece el contenedor como un contenedor flexible. Esto permite que los elementos hijos se distribuyan de manera flexible en el contenedor según las propiedades de diseño flexbox.
   - `align-items: center;`: Centra verticalmente los elementos hijos dentro del contenedor flexible.
   - `margin-bottom: 20px;`: Agrega un espacio de 20 píxeles en la parte inferior del contenedor. Esto proporciona un espacio entre el formulario y los elementos siguientes.

*  `.form-container input[type="text"] {...}`:

   - **Descripción**: Este estilo se aplica a los elementos de tipo `<input>` con el atributo `type="text"` que se encuentran dentro de un elemento con la clase "form-container". En este caso, se aplica a los campos de texto del formulario.
   - `flex: 1;`: Hace que el campo de texto tome todo el espacio disponible en el contenedor flexible. Esto es importante si hay otros elementos en el contenedor que también son flexibles.
   - `border: 1px solid #ccc;`: Establece un borde de 1 píxel sólido con un color de gris claro (#ccc) alrededor del campo de texto.
   - `border-radius: 4px;`: Agrega esquinas redondeadas al campo de texto con un radio de 4 píxeles.
   - `padding: 10px;`: Agrega un espacio de 10 píxeles alrededor del contenido dentro del campo de texto.
   - `outline: none;`: Elimina el contorno predeterminado al hacer clic en el campo de texto.

*  `.form-container button {...}`:

   - **Descripción**: Este estilo se aplica a elementos de tipo `<button>` que se encuentran dentro de un elemento con la clase "form-container". En este caso, se aplica a los botones del formulario.
   - `background-color: #007bff;`: Establece el color de fondo del botón a un tono de azul brillante (#007bff).
   - `color: #fff;`: Establece el color del texto en el botón a blanco (#fff).
   - `border: none;`: Elimina el borde del botón.
   - `border-radius: 4px;`: Agrega esquinas redondeadas al botón con un radio de 4 píxeles.
   - `padding: 10px 20px;`: Agrega un espacio de 10 píxeles en la parte superior e inferior y 20 píxeles en los lados del contenido dentro del botón.
   - `cursor: pointer;`: Cambia el cursor al estilo de "puntero" cuando se pasa sobre el botón, indicando que es interactivo.
   - `margin-left: 10px;`: Agrega un espacio de 10 píxeles a la izquierda del botón. Esto proporciona un espacio entre el campo de texto y el botón.

*  `.task-list {...}`:

   - **Descripción**: Este estilo se aplica a elementos con la clase "task-list". Probablemente se utilice para representar una lista de tareas en la página.
   - `list-style-type: none;`: Elimina los puntos o viñetas predeterminados de la lista, lo que proporciona un aspecto más limpio y moderno.
   - `padding: 0;`: Elimina el espacio entre el borde del contenedor y los elementos de la lista.

*  `.task-list li {...}`:

   - **Descripción**: Este estilo se aplica a elementos `<li>` que se encuentran dentro de un elemento con la clase "task-list". En este caso, se aplica a los elementos de la lista de tareas.
   - `display: flex;`: Establece el elemento de la lista como un contenedor flexible.
   - `align-items: center;`: Centra verticalmente los elementos hijos dentro del contenedor flexible.
   - `padding: 10px;`: Agrega un espacio de 10 píxeles alrededor del contenido dentro del elemento de la lista.
   - `border-bottom: 1px solid #ccc;`: Agrega un borde inferior de 1 píxel sólido con un color de gris claro (#ccc) a cada elemento de la lista, creando una separación visual entre ellos.

```css
 .task-list li:last-child {
            border-bottom: none;
        }

        .task-label {
            flex: 1;
            margin-left: 10px;
        }

        .delete-form {
            margin-left: auto;
        }

        .delete-form button {
            color: #f00;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .completed {
            text-decoration: line-through;
        }
```

* `.task-list li:last-child {...}`:

   - **Descripción**: Este estilo se aplica al último elemento `<li>` dentro de un elemento con la clase "task-list". En este caso, afecta al último elemento de la lista de tareas.
   - `border-bottom: none;`: Elimina el borde inferior del último elemento de la lista. Esto significa que el último elemento no tendrá una línea separadora en la parte inferior.

* `.task-label {...}`:

   - **Descripción**: Este estilo se aplica a elementos con la clase "task-label". Probablemente se utilice para etiquetar las tareas dentro de la lista.
   - `flex: 1;`: Hace que la etiqueta de la tarea tome todo el espacio disponible en el contenedor flexible. Esto es importante si hay otros elementos en el contenedor que también son flexibles.
   - `margin-left: 10px;`: Agrega un espacio de 10 píxeles a la izquierda de la etiqueta de la tarea. Esto proporciona un espacio entre la etiqueta y el checkbox.

* `.delete-form {...}`:

   - **Descripción**: Este estilo se aplica a elementos con la clase "delete-form". Probablemente se utilice para el formulario de eliminación de tareas.
   - `margin-left: auto;`: Empuja el formulario de eliminación hacia la derecha tanto como sea posible dentro del contenedor flexible. Esto coloca el formulario en el extremo derecho del contenedor.

* `.delete-form button {...}`:

   - **Descripción**: Este estilo se aplica a botones que están dentro de elementos con la clase "delete-form". En este caso, se aplica a los botones en los formularios de eliminación.
   - `color: #f00;`: Establece el color del texto del botón a rojo (#f00).
   - `background-color: transparent;`: Establece el fondo del botón como transparente, lo que significa que no tiene color de fondo.
   - `border: none;`: Elimina el borde del botón.
   - `cursor: pointer;`: Cambia el cursor al estilo de "puntero" cuando se pasa sobre el botón, indicando que es interactivo.

* `.completed {...}`:

   - **Descripción**: Este estilo se aplica a elementos con la clase "completed". Probablemente se utilice para indicar que una tarea ha sido completada.
   - `text-decoration: line-through;`: Agrega una línea de tachado sobre el texto de la tarea. Esto es una convención común para indicar que una tarea está completada.

### Cuerpo HTML-Blade

```html
 @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif


        <form method='POST' action="{{ route('task.store') }}" class="form-container">
            @csrf
            <input type="text" name="name" placeholder="Nombre de la tarea">
            <button type="submit">Crear</button>
        </form>
```

1. `@if (session('success')) ... @endif`:

   - **Explicación**: Esto es una estructura condicional de Blade. Significa que si hay una variable de sesión llamada 'success' que tiene un valor no nulo, entonces se ejecutará el código dentro de este bloque.
   - `session('success')`: Esto intenta obtener el valor de la variable de sesión llamada 'success'.
   - `{{ session('success') }}`: Si hay un valor en la variable de sesión 'success', se imprimirá en el HTML.

2. `<div class="success-message">{{ session('success') }}</div>`:

   - **Explicación**: Esta línea crea un elemento `<div>` con la clase "success-message".
   - `{{ session('success') }}`: Esto imprimirá el valor de la variable de sesión 'success' dentro del `<div>`. Si 'success' tiene un mensaje, este se mostrará en el área de éxito.

3. `<form method='POST' action="{{ route('task.store') }}" class="form-container"> ... </form>`:

   - **Explicación**: Aquí se crea un formulario utilizando HTML. Este formulario permite al usuario crear una nueva tarea.
   - `method='POST'`: Esto especifica que el formulario utilizará el método POST para enviar los datos al servidor.
   - `action="{{ route('task.store') }}"`: El formulario enviará los datos a la ruta llamada 'task.store'. La función `route()` se utiliza para generar la URL de la ruta a partir de su nombre, por detrás lo que hace es poner en action el valor `localhost:8000\ruta`, donde ruta es la ruta asociada al nombre "task.store", esto se puede ver en las rutas, en la función `name()`
   - `class="form-container"`: La clase "form-container" se aplica al formulario. Esto puede ser útil para aplicar estilos específicos a este formulario en particular.

4. `@csrf`:

   - **Explicación**: `@csrf` es una directiva de Blade que genera un campo de token CSRF en el formulario. CSRF significa Cross-Site Request Forgery y es una medida de seguridad para prevenir ciertos tipos de ataques.
   
5. `<input type="text" name="name" placeholder="Nombre de la tarea">`:

   - **Explicación**: Esta línea crea un campo de entrada de texto dentro del formulario. Este campo se utiliza para que el usuario ingrese el nombre de la tarea.
   - `type="text"`: Indica que este campo es de tipo texto.
   - `name="name"`: Asigna el nombre 'name' a este campo. Esto es importante para identificar el campo en el lado del servidor cuando se envía el formulario.
   - `placeholder="Nombre de la tarea"`: Este es un texto de marcador de posición que se muestra dentro del campo antes de que el usuario escriba algo.

6. `<button type="submit">Crear</button>`:

   - **Explicación**: Esto crea un botón dentro del formulario.
   - `type="submit"`: Indica que este botón es de tipo "submit", lo que significa que enviará el formulario cuando se haga clic en él.
   - El texto "Crear" es el texto que se muestra en el botón.

```html

<ul class="task-list">
            @foreach ($tasks as $task)
                <li>
                    <form id="form-{{ $task->id }}" method="POST" action="{{ route('task.update', $task->id) }}">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" class="task-checkbox" data-task-id="{{ $task->id }}" onclick = "submitForm({{ $task->id }})"
                            name = "cbx_completed" {{ $task->completed ? 'checked' : '' }}>
                        <label class="task-label {{ $task->completed ? 'completed' : '' }}">{{ $task->name }}</label>

                    </form>
                    <form method="POST" action="{{ route('task.destroy', $task->id) }}" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            @endforeach
</ul>

```

1. `<ul class="task-list"> ... </ul>`:

   - **Explicación**: Esto crea una lista no ordenada (ul) con la clase "task-list". Esta lista contendrá las tareas.
   - `class="task-list"`: Aplica el estilo CSS definido para la clase "task-list" a esta lista.

2. `@foreach ($tasks as $task) ... @endforeach`:

   - **Explicación**: Esta es una estructura de control de Blade que itera sobre una lista de tareas.
   - `$tasks`: Es la variable que contiene la lista de tareas que se obtuvo del controlador.
   - `$task`: En cada iteración, esta variable contendrá una tarea de la lista.

3. `<li> ... </li>`:

   - **Explicación**: Esto crea un elemento de lista (li) para cada tarea.
   - Cada tarea tendrá un checkbox y una etiqueta de texto.

4. `<form id="form-{{ $task->id }}" method="POST" action="{{ route('task.update', $task->id) }}"> ... </form>`:

   - **Explicación**: Este es el primer formulario para actualizar el estado de la tarea.
   - `id="form-{{ $task->id }}"`: Asigna un ID único al formulario, que incluye el ID de la tarea. Esto puede ser útil para seleccionar el formulario con JavaScript.
   - `method="POST"`: El formulario utiliza el método POST para enviar los datos al servidor.
   - `action="{{ route('task.update', $task->id) }}"`: El formulario enviará los datos a la ruta llamada 'task.update', que toma el ID de la tarea como parámetro.
   - `@csrf`: Genera un campo de token CSRF en el formulario para protección contra CSRF.
   - `@method('PATCH')`: Esto indica que se utilizará el método PATCH para esta solicitud. PATCH se utiliza comúnmente para actualizar recursos.

5. `<input type="checkbox" class="task-checkbox" data-task-id="{{ $task->id }}" onclick="submitForm({{ $task->id }})" name="cbx_completed" {{ $task->completed ? 'checked' : '' }}>`:

   - **Explicación**: Este es un campo de checkbox que permite al usuario marcar la tarea como completada o no.
   - `type="checkbox"`: Indica que este campo es un checkbox.
   - `class="task-checkbox"`: Aplica la clase "task-checkbox" al checkbox. Esto puede ser útil para aplicar estilos específicos o seleccionar este elemento con JavaScript.
   - `data-task-id="{{ $task->id }}"`: Asigna el ID de la tarea como un atributo de datos. Esto puede ser útil para referenciar la tarea asociada con este checkbox en JavaScript.
   - `onclick="submitForm({{ $task->id }})"`: Cuando se hace clic en el checkbox, se llama a la función `submitForm()` de JavaScript y se pasa el ID de la tarea como argumento.
   - `name="cbx_completed"`: Asigna el nombre 'cbx_completed' a este campo. Esto es importante para identificar el campo en el lado del servidor cuando se envía el formulario.
   - `{{ $task->completed ? 'checked' : '' }}`: Esto verifica si la tarea está marcada como completada en la base de datos. Si es así, el atributo 'checked' se incluye para marcar el checkbox.

6. `<label class="task-label {{ $task->completed ? 'completed' : '' }}">{{ $task->name }}</label>`:

   - **Explicación**: Esta etiqueta muestra el nombre de la tarea.
   - `class="task-label ..."`: Aplica la clase "task-label" a la etiqueta. Esto puede ser útil para aplicar estilos específicos.
   - `{{ $task->completed ? 'completed' : '' }}`: Si la tarea está marcada como completada en la base de datos, se aplica la clase "completed", que puede tener estilos específicos para tareas completadas.

7. `<form method="POST" action="{{ route('task.destroy', $task->id) }}" class="delete-form"> ... </form>`:

   - **Explicación**: Este es el segundo formulario para eliminar una tarea.
   - `method="POST"`: El formulario utiliza el método POST para enviar los datos al servidor.
   - `action="{{ route('task.destroy', $task->id) }}"`: El formulario enviará los datos a la ruta llamada 'task.destroy', que toma el ID de la tarea como parámetro.
   - `class="delete-form"`: Aplica la clase "delete-form" al formulario. Esto puede ser útil para aplicar estilos específicos.

```html
<script>
        function submitForm(taskId) {
            document.querySelector('#form-'+taskId).submit();
        }
</script>
```

1. `<script> ... </script>`:

   - **Explicación**: Este bloque de código se encuentra entre las etiquetas `<script>`, lo que indica que contiene código JavaScript.

2. `function submitForm(taskId) { ... }`:

   - **Explicación**: Esto define una función de JavaScript llamada `submitForm`. Esta función toma un parámetro `taskId`.

3. `document.querySelector('#form-'+taskId)`:

   - **Explicación**: `document.querySelector` es un método de JavaScript que se utiliza para seleccionar un elemento en la página HTML utilizando un selector CSS. En este caso, se está seleccionando un elemento con un ID específico que incluye el `taskId`.

   - `'#form-'+taskId`: Esto construye un selector que apunta a un elemento cuyo ID es 'form-' seguido del `taskId`.

4. `.submit()`:

   - **Explicación**: Una vez seleccionado el formulario, `.submit()` es un método que se utiliza para enviar el formulario.

   - En resumen, esta línea de código envía el formulario específico que corresponde al `taskId`.
