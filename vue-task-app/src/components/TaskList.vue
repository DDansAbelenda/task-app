<!-- TaskList.vue -->
<template>
   
    <div>
        <h2 class="title">Tareas</h2>
        <form @submit.prevent="addTask" class="form-container">
            <input placeholder="Nombre de la tarea" v-model="name_field" required />
            <button type="submit">Agregar</button>
        </form>
        <LoadingPage :isLoading="loading" />
        <ul class="task-list">
            <li v-for="task in tasksList" :key="task.id">
                <div>
                    <input type="checkbox" class="task-checkbox" v-model="task.completed" @change="updateTask(task)">
                    <label :class="['task-label', { 'completed': task.completed }]">{{ task.name }}</label>
                </div>
                <div class="buttons-container">
                    <div class="delete-form">
                        <button @click="deleteTask(task.id)">Eliminar</button>
                        <router-link :to="'/task-info/' + task.id">Info</router-link>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import LoadingPage from './LoadingPage.vue';

export default {
    name: 'TaskList',
    components: {
        LoadingPage,
    },
    emits: ['message'],
    data() {
        return {
            tasksList: [],
            name_field: '',
            loading: false,
        };
    },
    methods: {
        //metodo para agregar la tarea
        async addTask() {
            try {
                const response = await this.$axios.post('/tasks', { name: this.name_field }); // El segundo parámetro es un JSON que es el request
                this.tasksList.push(response.data.task);
                this.name_field = '';
                let message = response.data.message;
                this.$emit('message', message);
            } catch (error) {
                console.error('Error al agregar tarea:', error);
            }
        },
        //metodo para eliminar la tarea
        async deleteTask(taskId) {
            try {
                const response = await this.$axios.delete(`/tasks/${taskId}`);
                this.tasksList = this.tasksList.filter(task => task.id !== taskId); // esto elimina la tarea eliminada de la lista
                // de tarea que se muestran en el visual
                let message = response.data.message;
                this.$emit('message', message);
            } catch (error) {
                console.error('Error al eliminar tarea:', error);
            }
        },

        // Método para actualizar la tarea cuando se marca/desmarca el checkbox
        async updateTask(task) {
            try {
                //El primer parámetro de put es la ruta al igual que todos los métodos y el segundo es el JSON que se
                //envía en el request
                const response = await this.$axios.put(`/tasks/${task.id}`, { name: task.name, completed: task.completed });
                let message = response.data.message;
                this.$emit('message', message);
            } catch (error) {
                console.error('Error al actualizar tarea:', error)
            }
        },

        /*async taskInfo(task) {
            this.$router.push({ name: 'task-info', params: { id: task.id } })
        },*/

        //Metodo para inicializar el componente con la lista de tareas
        async fetchTasks() {
            this.toggleLoading();
            try {
                const response = await this.$axios.get('/tasks');
                this.tasksList = response.data;
            } catch (error) {
                console.error('Error al obtener tareas:', error);
            } finally {
                this.toggleLoading();
            }
        },
        toggleLoading() {
            this.loading = !this.loading;
        }

    },
    mounted() {
        this.fetchTasks();
    }
};
</script>

<style>
/* Estilos de la lista */
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

/* Estilos del formulario */
.title {
    text-align: center;
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    margin-top: 1.5rem;
}

.form-container {
    display: flex;
    align-items: center;
    margin: 20px 0px;
}

.form-container input {
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
  