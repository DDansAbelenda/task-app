# Async y Await
Claro, el uso de `async` y `await` está relacionado con la programación asincrónica en JavaScript y es especialmente útil al trabajar con operaciones que pueden tomar un tiempo, como las solicitudes a servidores (por ejemplo, llamadas a API), operaciones de lectura/escritura de archivos, o cualquier tarea que implique esperar algo.

### 1. `async` Function

La palabra clave `async` se utiliza para declarar una función asincrónica. Una función así marcada siempre devuelve una promesa. Veamos un ejemplo simple:

```javascript
async function fetchData() {
  return "Datos obtenidos";
}

// Llamada a la función asincrónica
fetchData().then(data => {
  console.log(data); // "Datos obtenidos"
});
```

La función `fetchData` es asincrónica y siempre devuelve una promesa, incluso si se retorna un valor directo. La ventaja es que puedes utilizar `await` dentro de la función asincrónica para esperar a que una promesa se resuelva.

### 2. `await` Expression

La palabra clave `await` se utiliza dentro de funciones marcadas con `async` para esperar que una promesa se resuelva antes de continuar con la ejecución del código. Aquí hay un ejemplo:

```javascript
function delay(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

async function waitForDelay() {
  console.log("Inicio de la espera");
  await delay(2000); // Espera 2 segundos
  console.log("Fin de la espera");
}

// Llamada a la función asincrónica
waitForDelay();
```

En este ejemplo, `delay` es una función que devuelve una promesa que se resuelve después de cierta cantidad de milisegundos. La función `waitForDelay` utiliza `await` para esperar que la promesa devuelta por `delay(2000)` se resuelva antes de continuar con la ejecución del código.

### 3. Uso con Operaciones Asíncronas Reales (Ejemplo con Axios)

```javascript
async function fetchDataFromAPI() {
  try {
    const response = await axios.get('https://api.example.com/data');
    console.log(response.data);
    return response.data;
  } catch (error) {
    console.error('Error al obtener datos:', error);
    throw error; // Relanza el error para que pueda ser manejado por el código que llama a esta función
  }
}

// Llamada a la función asincrónica
fetchDataFromAPI();
```

En este ejemplo, `axios.get` es una función que devuelve una promesa. Al utilizar `await`, la ejecución del código se pausará hasta que la promesa se resuelva (ya sea con éxito o con un error). Esto ayuda a que el código sea más legible y fácil de entender en comparación con la anidación de callbacks o el uso de `.then()` encadenados.

Recuerda que las funciones que contienen `await` deben ser marcadas con `async`, y el uso de `async` y `await` generalmente se aplica a operaciones que devuelven promesas. Esto mejora la legibilidad y la estructura del código cuando se trabaja con operaciones asincrónicas en JavaScript.

# Promesas

Las promesas en JavaScript son un mecanismo para gestionar operaciones asíncronas. Proporcionan una forma más limpia y estructurada de manejar el código asíncrono en comparación con el uso de callbacks. Una promesa representa un valor que puede estar disponible ahora, en el futuro, o nunca.

### Estructura de una Promesa

Una promesa en JavaScript tiene tres estados posibles:

1. **Pendiente (Pending):** El estado inicial cuando se crea una promesa.
2. **Resuelta (Fulfilled):** Cuando la operación asíncrona se completa con éxito, la promesa pasa a este estado y devuelve un valor.
3. **Rechazada (Rejected):** Si la operación asíncrona falla, la promesa pasa a este estado y devuelve un motivo de rechazo (un error).

```javascript
const myPromise = new Promise((resolve, reject) => {
  // Operación asíncrona aquí

  // Si la operación es exitosa, llamamos a resolve con el resultado
  // Si hay un error, llamamos a reject con el motivo del error
});
```

### Uso Básico de Promesas

```javascript
const myPromise = new Promise((resolve, reject) => {
  // Simulando una operación asíncrona (por ejemplo, una solicitud HTTP)
  setTimeout(() => {
    const success = true; // Cambiar a false para simular un error

    if (success) {
      resolve('Operación exitosa');
    } else {
      reject(new Error('Error en la operación'));
    }
  }, 1000);
});

// Manejo de la promesa usando .then() y .catch()
myPromise
  .then(result => {
    console.log('Éxito:', result);
  })
  .catch(error => {
    console.error('Error:', error.message);
  });
```

En este ejemplo, `myPromise` representa una operación asíncrona que se completa después de un segundo (simulado con `setTimeout`). Dependiendo del valor de `success`, la promesa se resuelve o se rechaza. Luego, se utilizan los métodos `.then()` y `.catch()` para manejar el resultado o el error de la promesa.

### Ventajas de las Promesas

1. **Manejo más claro del código asíncrono:** El código se estructura de una manera más legible y evita el anidamiento excesivo de callbacks (patrón conocido como "callback hell").

2. **Encadenamiento:** Se pueden encadenar múltiples operaciones asíncronas de manera más elegante utilizando `.then()`.

```javascript
myPromise
  .then(result => {
    // Operación siguiente
    return anotherAsyncOperation(result);
  })
  .then(anotherResult => {
    // Otra operación
  })
  .catch(error => {
    // Manejar errores en cualquier punto de la cadena
  });
```

3. **Manejo unificado de errores:** Los errores se pueden manejar de manera centralizada en el bloque `.catch()`, simplificando la gestión de errores.

4. **Compatibilidad con async/await:** Las promesas son la base de `async/await`, una forma aún más limpia y concisa de manejar código asíncrono en JavaScript.

En resumen, las promesas proporcionan un modelo más robusto y manejable para trabajar con código asíncrono en JavaScript, mejorando la legibilidad y la mantenibilidad del código.