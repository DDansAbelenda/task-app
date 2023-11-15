// router.js
import { createRouter, createWebHistory } from 'vue-router';
import TaskInfo from '../views/TaskInfo.vue';
import TaskHome from '../views/TaskHome.vue';
const routes = [
  {
    path: '/task',
    name: 'task',
    component: TaskHome

  },  
  {
    path: '/task-info/:id',
    name: 'task-info',
    component: TaskInfo
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BAS),
  routes
});

export default router;