<template>
  <div id="task-home">
    <div :class="['server-message',{'background-msg':message}]">
      <div v-if="message">
        {{ message }}
      </div>
    </div>
    <TaskList @message="setMessage" />
  </div>
</template>
  
<script>
import TaskList from '../components/TaskList.vue';

export default {
  name: 'TaskHome',
  components: {
    TaskList
  },
  data() {
    return {
      message: null
    };
  },
  methods: {
    setMessage(message) {
      this.message = message;
    }
  }
};
</script>
  
<style scoped>
.server-message {
  /* Estilos para el mensaje del servidor si es necesario */
  min-height: 1.5rem;
  color: #00a800;
  padding: 10px;
  border-radius: 4px;
  margin-bottom: 10px;
}
.background-msg{
  background-color: #d1f5d1;
}
</style>