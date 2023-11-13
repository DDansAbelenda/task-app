<template>
  <div id="app">
    <TaskForm @agregar="addTask" />
    <TaskList :tasks="tasks" @delete="deleteTask" />
  </div>
</template>

<script>
import TaskForm from './components/TaskForm.vue';
import TaskList from './components/TaskList.vue';

export default {
  components: {
    TaskForm,
    TaskList
  },
  data() {
    return {
      tasks: []
    };
  },
  methods: {
    async addTask(name) {
      try {
        const response = await this.$axios.post('/tasks', { name }); // En este caso el campo name debe coincidir con el del request
                                                                     // en la base de datos, es una clave del JSON
        this.tasks.push(response.data);
      } catch (error) {
        console.error('Error al agregar tarea:', error);
      }
    },
    async deleteTask(taskId) {
      try {
        await this.$axios.delete(`/tasks/${taskId}`);
        this.tasks = this.tasks.filter(task => task.id !== taskId);
      } catch (error) {
        console.error('Error al eliminar tarea:', error);
      }
    },
    async fetchTasks() {
      try {
        const response = await this.$axios.get('/tasks');
        this.tasks = response.data;
      } catch (error) {
        console.error('Error al obtener tareas:', error);
      }
    }
  },
  mounted() {
    this.fetchTasks();
  }
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>

