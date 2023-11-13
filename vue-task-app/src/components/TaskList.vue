<!-- TaskList.vue -->
<template>
    <div>
        <h2>Lista de Tareas</h2>
        <ul>
            <li v-for="task in tasks" :key="task.id">
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
        }
    }
};
</script>
  