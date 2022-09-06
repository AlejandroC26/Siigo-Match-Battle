import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('../views/HomeView.vue')
  },
  {
    path: '/sala-espera/:id',
    name: 'WaitingRoom',
    component: () => import('../views/WaitingRoom.vue')
  },
  {
    path: '/juego',
    name: 'Game',
    component: () => import('../views/GameVue.vue')
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
