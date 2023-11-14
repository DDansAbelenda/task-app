<!-- TaskList.vue -->
<template>
    <div>
        <ul class="task-list">
            <li v-for="task in tasks" :key="task.id">
                <div>
                    <input type="checkbox" class="task-checkbox" v-model="task.completed" @change="updateTask(task)">
                    <label :class="['task-label',{'completed':task.completed}]">{{ task.name }}</label>
                </div>
                <div class="buttons-container">
                    <div class="delete-form">
                        <button @click="deleteTask(task.id)">Eliminar</button>
                    </div>
                </div>
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
<style>
.task-list {
    list-style-type: none;
    padding: 0;
}

.task-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

.task-list li:last-child {
    border-bottom: none;
}

.task-label {
    margin-left: 10px;
}

.delete-form {
    margin-left: auto;
}

.delete-form button {
    font-family: 'Mooli', Arial, sans-serif;
    color: #f00;
    background-color: transparent;
    border: none;
    cursor: pointer;
}

.completed {
    text-decoration: line-through;
}

.buttons-container {
    display: flex;
}
</style>
  