# Migración

Para crear una migración nos movemos dentro de la carpeta del proyecto y ejecutamos el comando:

```php

php artisan make:model Task -m

```

Esto automáticamente crea un fichero en la carpeta `database/migrations/<timestap>_create_tasks_table.php`. Dentro de este fichero php se define la estructura que va a tomar la tabla tarea en la base de datos. La del ejemplo queda de la siguiente forma:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};


```

### Explicación detallada
Este código es una migración de Laravel escrita utilizando la sintaxis de migraciones anónimas introducida en Laravel 8. Explicaré cada parte del código detalladamente:

1. **Importaciones**:

   ```php
   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;
   ```
   
   - `use Illuminate\Database\Migrations\Migration`: Esto importa la clase base `Migration` que proporciona Laravel para crear migraciones. Esta clase contiene los métodos necesarios para realizar y revertir migraciones.
   - `use Illuminate\Database\Schema\Blueprint`: Esto importa la clase `Blueprint`, que es utilizada para definir la estructura de una tabla en la base de datos.
   - `use Illuminate\Support\Facades\Schema`: Esto importa la fachada `Schema`, que proporciona una interfaz sencilla para interactuar con el sistema de migraciones.

2. **Creación de la Migración Anónima**:

   ```php
   return new class extends Migration
   {
       // ...
   };
   ```

   Esto define una nueva clase anónima que hereda de la clase `Migration`. En este caso, se está creando una migración anónima. Esta es una característica introducida en Laravel 8 que permite definir una migración dentro de un solo archivo PHP sin necesidad de crear un archivo separado.

3. **Método `up()`**:

   ```php
   public function up(): void
   {
       Schema::create('tasks', function (Blueprint $table) {
           $table->id();
           $table->string('name');
           $table->boolean('completed')->default(false);
           $table->timestamps();
       });
   }
   ```
   
   - `up()`: Este es el método que se ejecuta cuando se aplica la migración. En este caso, se está creando una nueva tabla llamada `tasks` utilizando el objeto `Schema`.

   - `Schema::create('tasks', ...)`: Esto crea una nueva tabla llamada `tasks`. La función de callback toma un objeto `Blueprint` que te permite definir la estructura de la tabla.

   - `$table->id()`: Este método agrega un campo de tipo clave primaria `id` a la tabla. Es comúnmente utilizado para identificar de forma única cada fila en la tabla.
   
   - `$table->string('name')`: Este método agrega un campo de tipo cadena (`VARCHAR`) llamado `name`.
   
   - `$table->boolean('completed')->default(false)`: Este método agrega un campo de tipo booleano llamado `completed` con un valor predeterminado de `false`.

   - `$table->timestamps()`: Este método agrega dos campos `created_at` y `updated_at` que registran la fecha y hora de creación y actualización de cada registro en la tabla. Es una característica comúnmente utilizada para llevar un registro de la última vez que se modificó un registro.

4. **Método `down()`**:

   ```php
   public function down(): void
   {
       Schema::dropIfExists('tasks');
   }
   ```
   
   - `down()`: Este es el método que se ejecuta cuando se revierte la migración. En este caso, se está eliminando la tabla `tasks` utilizando el objeto `Schema`.

   - `Schema::dropIfExists('tasks')`: Esto elimina la tabla `tasks` si existe. Si la tabla no existe, no ocurre ningún error.

En resumen, este código define una migración que crea una nueva tabla llamada `tasks` con tres campos (`id`, `name` y `completed`) y dos timestamps (`created_at` y `updated_at`). Si alguna vez necesitas revertir esta migración, se eliminará la tabla `tasks` de la base de datos.

# Otros datos

### Blueprint Object
En el contexto de Laravel y las migraciones de bases de datos, un "Blueprint" es una clase que proporciona una interfaz orientada a objetos para definir la estructura de una tabla de base de datos.

La clase `Blueprint` se utiliza en las migraciones para especificar cómo se deben crear o modificar las tablas en la base de datos. Permite a los desarrolladores definir columnas, índices, claves foráneas y otras configuraciones de una manera programática y legible.

Algunas de las acciones comunes que puedes realizar con un `Blueprint` incluyen:

1. **Agregar Columnas**:

   ```php
   $table->string('nombre');
   ```

   Esto agrega una columna de tipo string llamada "nombre" a la tabla.

2. **Definir Claves Primarias**:

   ```php
   $table->primary('id');
   ```

   Esto define la columna "id" como clave primaria.

3. **Agregar Índices**:

   ```php
   $table->index('email');
   ```

   Esto agrega un índice a la columna "email" para mejorar la eficiencia de las consultas.

4. **Definir Claves Foráneas**:

   ```php
   $table->foreign('user_id')->references('id')->on('users');
   ```

   Esto define una clave foránea llamada "user_id" que referencia la columna "id" en la tabla "users".

5. **Definir Columnas de Timestamps**:

   ```php
   $table->timestamps();
   ```

   Esto agrega dos columnas llamadas "created_at" y "updated_at" que registrarán la fecha y hora de creación y actualización de cada registro.

6. **Definir Columnas de Soft Deletes**:

   ```php
   $table->softDeletes();
   ```

   Esto agrega una columna "deleted_at" para implementar la eliminación suave (soft delete) en la tabla.

El uso de un `Blueprint` hace que la definición de la estructura de la base de datos sea más legible y mantenible, especialmente en aplicaciones con bases de datos complejas o con múltiples desarrolladores que colaboran en el proyecto.

En resumen, un `Blueprint` en Laravel proporciona una forma programática y orientada a objetos de definir la estructura de una tabla de base de datos, lo que facilita la gestión y mantenimiento de la base de datos en el contexto de las migraciones.

### Definición formal de migraciones
En Laravel, una migración es una forma de interactuar con la base de datos utilizando código PHP en lugar de SQL directo. Proporciona una manera conveniente y controlada de modificar la estructura de la base de datos.

En términos simples, una migración en Laravel es un archivo de PHP que contiene instrucciones para crear o modificar tablas y columnas en tu base de datos. Cada migración es una clase PHP que utiliza el sistema de migración de Laravel.

Aquí hay una explicación más detallada:

1. **Definición**:

   Una migración en Laravel se define como una clase PHP que hereda de la clase `Migration`. Esta clase tiene dos métodos importantes: `up` y `down`.

   - `up`: Contiene las instrucciones para realizar la migración (por ejemplo, crear una nueva tabla, agregar una columna, etc.).
   - `down`: Contiene las instrucciones para deshacer la migración (es decir, revertir los cambios realizados en `up`).

2. **Uso**:

   Las migraciones se utilizan para mantener un control de la estructura de la base de datos a lo largo del tiempo, permitiendo a los desarrolladores trabajar de manera colaborativa y mantener un historial de los cambios en la base de datos.

   Por ejemplo, supongamos que estás trabajando en un equipo y necesitas agregar una nueva columna a una tabla existente en la base de datos. En lugar de instrucciones SQL directas, puedes crear una migración que contenga las instrucciones para agregar la nueva columna. Luego, puedes compartir la migración con tu equipo, y cada miembro puede aplicarla a su propia base de datos de desarrollo.

   Además, las migraciones facilitan la implementación y actualización de aplicaciones en diferentes entornos (como desarrollo, pruebas y producción), ya que puedes ejecutar las migraciones en cada entorno para asegurarte de que la base de datos esté configurada correctamente.

   También, las migraciones permiten realizar un seguimiento de los cambios en el esquema de la base de datos a lo largo del tiempo, lo que facilita la reversión a versiones anteriores si es necesario.

En resumen, las migraciones en Laravel son una herramienta poderosa para gestionar la estructura de tu base de datos de una manera controlada y colaborativa, lo que facilita el desarrollo y mantenimiento de aplicaciones web.