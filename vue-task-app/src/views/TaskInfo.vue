<template>
    <LoadingPage :isLoading="loading" />
    <div v-if="task">
        <h1>Información de la tarea</h1>
        <p>Título: {{ task.name }}</p>
        <p>Estado: {{ task.completed ? 'completed' : 'not completed' }}</p>

        <div>
            <button @click="backHome()">Regresar</button>
        </div>

        <div>
            <router-link to="/task">REGRESAR</router-link>
        </div>
    </div>
</template>
  
<script>
import axios from 'axios';
import LoadingPage from '@/components/LoadingPage.vue';

export default {
    name: 'TaskInfo',
    components: {
        LoadingPage,
    },
    data() {
        return {
            task: null,
            loading: false,
        }
    },
    methods: {
        async getTask() {
            this.toggleLoading();//Activar la carga antes de la solicitud
            try {
                let taskId = this.$route.params.id;
                const response = await axios.get(`tasks/${taskId}`);
                this.task = response.data;
            } catch (error) {
                console.error('Error al obtener detalles de la tarea:', error);
            } finally {
                this.toggleLoading();//Desactivar la carga despúes de la solicitud
            }
        },
        backHome() {
            this.$router.push("/task")
        },
        toggleLoading() {
            this.loading = !this.loading;
        }
    },
    beforeMount() {
        this.getTask();
    },
};
</script>
  
<style>
/* Estilos para la página de información de la tarea */
</style>