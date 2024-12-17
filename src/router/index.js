// src/router/index.js
import { createRouter, createWebHistory } from "vue-router";
import HomeView from "@/components/view/HomeView.vue";
import CategoryPage from "@/components/view/CategoryPage.vue";
import ProductPage from "@/components/view/ProductPage.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: HomeView,
  },
  {
    path: "/categories/:categoryId",
    name: "CategoryPage",
    component: CategoryPage,
  },
  {
    path: "/products/:productId",
    name: "ProductPage",
    component: ProductPage,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
