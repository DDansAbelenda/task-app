<template>
  <div id="app">
    <div v-if="message" class="server-message">
      {{ message }}
    </div>
    <TaskForm @agregar="addTask" />
    <TaskList :tasks="tasksList" @delete="deleteTask" @update="updateTask" />
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
      tasksList: [],
      message: null
    };
  },
  methods: {
    async addTask(name) {
      try {
        const response = await this.$axios.post('/tasks', { name }); // En este caso el campo name debe coincidir con el del request
        // en la base de datos, es una clave del JSON
        this.tasksList.push(response.data.task);
        this.message = response.data.message;
      } catch (error) {
        console.error('Error al agregar tarea:', error);
      }
    },
    async deleteTask(taskId) {
      try {
        const response = await this.$axios.delete(`/tasks/${taskId}`);
        this.tasksList = this.tasksList.filter(task => task.id !== taskId); // esto elimina la tarea eliminada de la lista
        this.message = response.data.message;
        // de tarea que se muestran en el visual
      } catch (error) {
        console.error('Error al eliminar tarea:', error);
      }
    },
    async updateTask(task) {
      try {
        //El primer parámetro de put es la ruta al igual que todos los métodos y el segundo es el JSON que se
        //envía en el request
        const response = await this.$axios.put(`/tasks/${task.id}`, { name: task.name, completed: task.completed });
        this.message = response.data.message;
      } catch (error) {
        console.error('Error al actualizar tarea:', error)
      }
    },
    async fetchTasks() {
      try {
        const response = await this.$axios.get('/tasks');
        this.tasksList = response.data;
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
  max-width: 50rem;
  margin: 0 auto;
  padding: 2rem;
}

.server-message {
  /* Estilos para el mensaje del servidor si es necesario */
  background-color: #d1f5d1;
  color: #00a800;
  padding: 10px;
  border-radius: 4px;
  margin-bottom: 10px;
}
</style>

