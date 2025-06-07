import { createRouter, createWebHistory } from 'vue-router'
import Home from '../components/Home.vue'
import EstudiantesComponent from '../components/EstudiantesComponent.vue'
import DocentesComponent from '../components/DocentesComponent.vue'
import MateriaComponent from '../components/MateriaComponent.vue'
import NotasComponent from '../components/NotasComponent.vue'

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/estudiantes', name: 'EstudiantesComponent', component: EstudiantesComponent },
  { path: '/docentes', name: 'DocentesComponent', component: DocentesComponent },
  { path: '/asignaturas', name: 'MateriasComponent', component: MateriaComponent },
  { path: '/notas', name: 'NotasComponent', component: NotasComponent }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
