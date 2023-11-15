# Notas mías
El uso de las vistas en Vue está dictado por las rutas, todas las rutas deben registrarse en la carpeta routes dentro del fichero index.js. Lo normal es que desde el componente principal App.vue llamar al componente especial `<router-view/>`, para mostrar las rutas definidas en dependencia de la actual. Luego se puede navegar entre rutas utilizando eventos y funciones mediante la directiva: `this.$router.push({ name: 'nombre-ruta', params: { id: taskId }});`donde el primero es el nombre de la ruta y el segundo los parámetros que se le pasan a la ruta, también se puede escribir así: `this.$router.push("/ruta");`; la otra vía sería usando la etiqueta especial:`<router-link to="/ruta">Ir a la ruta</router-link>`. De esta forma se navega en un sitio web vue.


# Ejemplo que se trabaja en task
Agregar un botón info en TaskList.vue y que permita dirigir a otra vista con la información de la tarea

Para lograr la funcionalidad que deseas, puedes seguir estos pasos:

1. En el componente TaskList.vue, al lado del botón "Eliminar", puedes agregar un nuevo botón para ver la información de la tarea. Por ejemplo:

```html
<div class="buttons-container">
    <div class="delete-form">
        <button @click="deleteTask(task.id)">Eliminar</button>
    </div>
    <div class="info-form">
        <button @click="verInformacion(task.id)">Info</button>
    </div>
</div>
```

2. Luego, en el método `verInformacion` de tu componente TaskList.vue, puedes emitir un evento para notificar al componente padre que se desea ver la información de la tarea seleccionada. Por ejemplo:

```javascript
verInformacion(taskId) {
    this.$emit('ver-informacion', taskId);
}
```

3. En tu componente principal (el que contiene el template con el id "app"), puedes manejar el evento "ver-informacion" que emite el componente TaskList.vue. Puedes capturar este evento y navegar a la página de información de la tarea utilizando Vue Router. Por ejemplo:

```js
// En tu componente principal
<template>
  <!-- ... tu código actual ... -->

  <TaskList :tasks="tasksList" @delete="deleteTask" @update="updateTask" @ver-informacion="verInformacionTarea" />

</template>

<script>

export default {
  // ... tu código actual ...

  methods: {
    // ... tus otros métodos ...

    verInformacionTarea(taskId) {
      this.$router.push({ name: 'informacion-tarea', params: { id: taskId }});
    }
  }
};

</script>
```

4. Asegúrate de tener una ruta definida en Vue Router para la página de información de la tarea, similar a lo que te mencioné en mi respuesta anterior.

Siguiendo estos pasos, deberías poder agregar un botón "Info" en tu componente TaskList.vue que permita ver la información de la tarea seleccionada y luego regresar a la página principal.


# Vue router

Para definir la ruta en Vue Router y la estructura de la página de información, primero necesitas asegurarte de tener instalado y configurado Vue Router en tu proyecto. Si aún no lo has hecho, puedes instalarlo utilizando npm o yarn:

```bash
npm install vue-router
# o
yarn add vue-router
```

Una vez que tienes Vue Router instalado, puedes definir las rutas en un archivo separado, por ejemplo, `router.js`. Aquí tienes un ejemplo de cómo podrías definir la ruta para la página de información de la tarea:

```javascript
// router.js
import { createRouter, createWebHistory } from 'vue-router';
import InformacionTarea from './components/InformacionTarea.vue';

const routes = [
  // Otras rutas de tu aplicación
  {
    path: '/informacion-tarea/:id',
    name: 'informacion-tarea',
    component: InformacionTarea
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;

```

En este ejemplo, estamos definiendo una nueva ruta llamada 'informacion-tarea' que toma un parámetro de ruta llamado 'id'. Esta ruta está asociada al componente `InformacionTarea.vue`, que es donde mostrarás la información detallada de la tarea.

Luego, en tu componente principal (el que contiene el template con el id "app"), debes importar y utilizar el enrutador que acabas de definir:

**Nota importante en el comentario de la importación**
```javascript
// En tu componente principal
import router from './router'; // no es necesario importarlo en Vue 3 dado que se agrega desde el main.js al componente

export default {
  // ... tu código actual ...

  router,

  // ... tus otros métodos ...
};
```

### Configuración del main

```js
// main.js
import { createApp } from 'vue';
import App from './App.vue';
import router from './router.js'; // Ruta al archivo router.js
createApp(App).use(router).mount('#app');
```


Finalmente, el componente `InformacionTarea.vue` es donde puedes mostrar la información detallada de la tarea. Aquí tienes un ejemplo básico de cómo podría lucir la estructura de este componente:

```html
<template>
  <div>
    <h1>Información de la tarea</h1>
    <p>Detalles de la tarea con ID: {{ $route.params.id }}</p>
    <!-- Aquí puedes mostrar los detalles de la tarea utilizando los datos de tu aplicación -->

    <router-link to="/task">Volver a la vista principal</router-link>
  </div>
</template>

<script>
export default {
  // ... lógica del componente ...
};
</script>

<style>
/* Estilos para la página de información de la tarea */
</style>

```

En este componente, puedes acceder al parámetro de ruta 'id' a través de `$route.params.id` para mostrar la información específica de la tarea.

En este ejemplo, el componente `<router-link>` se utiliza para crear un enlace que te llevará de vuelta a la vista principal de la aplicación. El atributo `to="/" ... ...` especifica la ruta a la que se debe navegar al hacer clic en el enlace. En este caso, al hacer clic en el enlace, se navegará a la ruta raíz, que generalmente es la vista principal de la aplicación.

Espero que esta información te sea útil para definir la ruta en Vue Router y la estructura de la página de información de la tarea en tu aplicación Vue.js.



