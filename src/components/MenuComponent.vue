<!-- components/MenuComponent.vue -->
<template>
    <nav class="menu">
      <div class="menu-left">
        <button class="browse-button">Browse All Categories</button>
        <ul class="menu-items">
          <li v-for="category in categories" :key="category.id">
            <router-link :to="`/categories/${category.id}`" class="menu-link">
              {{ category.name }}
            </router-link>
          </li>
        </ul>
      </div>
  
      <div class="menu-center">
        <div class="search-box">
          <select class="category-select">
            <option>All Categories</option>
            <option v-for="category in categories" :key="category.id">
              {{ category.name }}
            </option>
          </select>
          <input type="text" placeholder="Search for items" class="search-input" />
          <button class="search-button">🔍</button>
        </div>
      </div>
  
      <div class="menu-right">
        <a href="#" class="menu-link">Compare</a>
        <a href="#" class="menu-link">Wishlist</a>
        <a href="#" class="menu-link">Cart</a>
        <a href="#" class="menu-link account">Account</a>
      </div>
    </nav>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "MenuComponent",
    data() {
      return {
        categories: [],
      };
    },
    async created() {
      await this.fetchCategories();
    },
    methods: {
      async fetchCategories() {
        try {
          const response = await axios.get("http://localhost:3000/api/categories");
          this.categories = response.data;
        } catch (error) {
          console.error("Error fetching categories:", error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .menu {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    padding: 10px 5%;
    border-bottom: 1px solid #ccc;
  }
  
  .menu-left {
    display: flex;
    align-items: center;
  }
  
  .browse-button {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-weight: bold;
    margin-right: 20px;
  }
  
  .menu-items {
    list-style: none;
    display: flex;
    gap: 15px;
    margin: 0;
    padding: 0;
  }
  
  .menu-link {
    text-decoration: none;
    color: #333;
    font-weight: bold;
  }
  
  .menu-link:hover {
    color: #007bff;
  }
  
  .menu-center {
    flex: 1;
    display: flex;
    justify-content: center;
  }
  
  .search-box {
    display: flex;
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
  }
  
  .category-select {
    padding: 10px;
    border: none;
    background-color: #f0f0f0;
  }
  
  .search-input {
    padding: 10px;
    border: none;
    width: 300px;
  }
  
  .search-button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
  }
  
  .menu-right {
    display: flex;
    gap: 15px;
  }
  
  .account {
    font-weight: bold;
  }
  </style>
  