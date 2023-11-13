<!-- TaskForm.vue -->
<template>
    <div>
      <h2>Agregar Nueva Tarea</h2>
      <form @submit.prevent="addTask">
        <label>
          Título:
          <input v-model="name_field" required />
        </label>
        <button type="submit">Agregar Tarea</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name_field: ''
      };
    },
    methods: {
      addTask() {
        this.$emit('agregar', this.name_field); //emite un evento llamado agregar al padre
        this.name_field = '';
      }
    }
  };
  </script>
  