<!-- src/components/view/CategoryPage.vue -->
<template>
    <div class="category-page">
      <h1>Coke & Milk</h1>
      <div class="products-list">
        <h2>Products in this Category:</h2>
        <ul>
          <li>
            <router-link to="/products/1">Fresh Milk</router-link>
          </li>
          <li>
            <router-link to="/products/2">Chocolate Milk</router-link>
          </li>
          <li>
            <router-link to="/products/3">Diet Coke</router-link>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "CategoryPage",
  };
  </script>
  
  <style scoped>
  .category-page {
    padding: 20px;
  }
  
  h1 {
    color: #007bff;
  }
  
  .products-list {
    margin-top: 20px;
  }
  
  ul {
    list-style-type: none;
    padding: 0;
  }
  
  li {
    margin: 10px 0;
  }
  
  a {
    text-decoration: none;
    color: #28a745;
  }
  
  a:hover {
    text-decoration: underline;
  }
  </style>
  