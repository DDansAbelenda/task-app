# Poblar la base datos de info fake

### Paso 1: Crear el Factory

Un factory es utilizado para generar datos de prueba de manera automática. En tu caso, crearás un factory para la entidad `Task`.

1. En tu terminal, utiliza el siguiente comando de Artisan para crear un factory:

```bash
php artisan make:factory TaskFactory --model=Task
```

Este comando creará un archivo `TaskFactory.php` en el directorio `database/factories`.

2. Abre el archivo `TaskFactory.php` y modifícalo para generar datos de prueba para tu modelo `Task`. Debería tener una estructura similar a esta:

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'completed' => $this->faker->boolean,
        ];
    }
}
```

### Paso 2: Crear el Seeder

Un seeder es utilizado para poblar la base de datos con datos de prueba.

1. Utiliza el siguiente comando de Artisan para crear un seeder:

```bash
php artisan make:seeder TaskSeeder
```

Este comando creará un archivo `TaskSeeder.php` en el directorio `database/seeders`.

2. Abre el archivo `TaskSeeder.php` y modifícalo para utilizar el factory que creaste y llenar la base de datos con datos de prueba. El archivo debería verse algo así:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory()
        ->count(50)
        ->create();
    }
}

```

### Paso 3: Ejecutar el Seeder

Por último, ejecuta el seeder usando el siguiente comando de Artisan:

```bash
php artisan db:seed --class=TaskSeeder
```

Esto llenará tu base de datos con 50 tareas de prueba generadas por el factory.


# Otros datos

## Factory
Un **factory** en Laravel es una herramienta que te permite definir la estructura y atributos de un modelo para poder generar datos de prueba de manera rápida y sencilla. Esto es especialmente útil durante el desarrollo y las pruebas de tu aplicación.

El objeto **Faker** es una biblioteca de PHP que proporciona una amplia variedad de métodos para generar datos falsos de manera realista. Laravel integra Faker para que puedas crear datos de prueba de forma coherente y convincente.

Algunos de los posibles valores que Faker puede generar incluyen:

1. **Nombres**: `firstName`, `lastName`, `name`, etc.
2. **Direcciones**: `streetAddress`, `city`, `state`, `country`, etc.
3. **Números**: `numberBetween`, `randomDigit`, etc.
4. **Texto**: `sentence`, `paragraph`, `text`, etc.
5. **Fechas y Tiempos**: `dateTime`, `date`, `time`, etc.
6. **Imágenes**: `imageUrl`, `image`, etc.
7. **Correos Electrónicos**: `email`, `safeEmail`, etc.

Por ejemplo, si necesitas generar un nombre aleatorio, puedes usar `Faker` de la siguiente manera:

```php
$name = $faker->name; // Genera un nombre aleatorio
```

En el contexto de un factory, puedes utilizar `Faker` para definir los valores predeterminados para tus modelos ficticios. Esto te permite crear fácilmente una gran cantidad de datos de prueba con un solo comando.

Por ejemplo, en el código del factory que proporcionaste anteriormente, `$this->faker->sentence` se utilizará para generar una oración aleatoria como el nombre de una tarea ficticia.

Recuerda que puedes personalizar los datos generados por Faker según tus necesidades, y la documentación oficial de Faker proporciona una lista completa de métodos y opciones disponibles.
