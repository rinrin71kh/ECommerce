import { createRouter, createWebHistory } from 'vue-router';
import PageView from '../views/PageView.vue';
import SectionView from '../views/SectionView.vue';

const routes = [
  {
    path: '/',
    name: 'home',
    component: PageView
  },
  {
    path: '/:page',
    name: 'page',
    component: PageView,
    children: [
      {
        path: ':section',
        name: 'section',
        component: SectionView
      }
    ]
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
