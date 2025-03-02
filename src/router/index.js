import { createRouter, createWebHistory } from 'vue-router'
import Index from '../views/IndexPage.vue'
import AddDonation from '../views/AddDonation.vue'

const routes = [
  {
    path: '/',
    name: 'IndexPage',
    component: Index
  },
  {
    path: '/add',
    name: 'AddDonation',
    component: AddDonation
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router