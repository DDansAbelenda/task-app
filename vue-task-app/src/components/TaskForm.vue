<!-- TaskForm.vue -->
<template>
    <div>
      <h2 class="title">Tareas</h2>
      <form @submit.prevent="addTask" class="form-container">
        <input placeholder="Nombre de la tarea" v-model="name_field" required />
        <button type="submit">Agregar</button>
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
<style>
.title {
    text-align: center;
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 20px;
}
.form-container {
    display: flex;
    align-items: center;
    margin: 20px 0px;
}
.form-container input{
    flex: 1;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    outline: none;
}
.form-container button {
    color: #0da33a;
    font-family: 'Mooli', Arial, sans-serif;
    border: none;
    background-color: #fff;
    cursor: pointer;
    margin-left: 10px;
}
</style>