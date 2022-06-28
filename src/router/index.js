import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ReportsView from '../views/ReportsView.vue'
import UsersView from '../views/UsersView.vue'
import EmployeesView from '../views/EmployeesView.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/reports',
      name: 'reports',
      component: ReportsView
    },
    {
      path: '/users',
      name: 'users',
      component: UsersView
    },
    {
      path: '/employees',
      name: 'employees',
      component: EmployeesView
    },
  ]
})

export default router
