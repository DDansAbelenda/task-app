# Incluir checkbox

Para lograr lo que deseas, puedes modificar tu código para incluir un checkbox junto al nombre de la tarea y utilizarlo para marcar y desmarcar la tarea como completada. Aquí tienes una versión modificada de tu código:

```html
<template>
    <div>
        <ul class="task-list">
            <li v-for="task in tasks" :key="task.id">
                <!-- Añadimos el checkbox -->
                <input type="checkbox" v-model="task.completed" @change="updateTask(task)">
                {{ task.name }}
                <button @click="deleteTask(task.id)">Eliminar</button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['tasks'],
    methods: {
        deleteTask(taskId) {
            this.$emit('delete', taskId);
        },
        // Método para actualizar la tarea cuando se marca/desmarca el checkbox
        updateTask(task) {
            // Hacer un PUT a la base de datos para actualizar el estado de la tarea
            // Puedes usar axios o tu método preferido para realizar la solicitud
            // Este ejemplo supone que tienes un método updateTask en tu componente padre
            this.$emit('update', task);
        }
    }
};
</script>
```

En este código, hemos agregado un `<input type="checkbox" v-model="task.completed" @change="updateTask(task)">` junto al nombre de cada tarea. El atributo `v-model` está vinculado al atributo `completed` de cada tarea. Cuando el checkbox se marca o desmarca, se dispara el evento `@change`, que llama al método `updateTask(task)`.

Ahora, en tu componente padre, donde utilizas este componente, deberías tener un método llamado `updateTask` que realiza la solicitud PUT a la base de datos para actualizar el estado de la tarea. Asegúrate de que este método esté disponible en tu componente padre y que estés manejando las solicitudes PUT adecuadamente en tu backend.

Aquí hay un ejemplo muy básico de cómo podría verse el componente padre:

```html
<template>
    <div>
        <TaskList :tasks="tasks" @delete="deleteTask" @update="updateTask" />
    </div>
</template>

<script>
import TaskList from './TaskList.vue';

export default {
    components: {
        TaskList
    },
    data() {
        return {
            tasks: [
                // ... tus tareas ...
            ]
        };
    },
    methods: {
        deleteTask(taskId) {
            // Lógica para eliminar tarea en tu componente padre
        },
        updateTask(task) {
            try {
        	//El primer parámetro de put es la ruta al igual que todos los métodos de tipo get,put,post,etc; y el segundo es el JSON que se envía en el request.
        	await this.$axios.put(`/tasks/${task.id}`,{name:task.name, completed:task.completed});
      		} catch (error) {
       			 console.error('Error al actualizar tarea:', error)
      		}
        }
    }
};
</script>
```

