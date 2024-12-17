<!-- src/components/view/ProductPage.vue -->
<template>
    <div class="product-page">
      <div class="product-details">
        <h1>Fresh Milk</h1>
        <img
          src="https://via.placeholder.com/300x200?text=Fresh+Milk"
          alt="Fresh Milk"
          class="product-image"
        />
        <p><strong>Price:</strong> $3.99</p>
        <p>
          <strong>Description:</strong> Fresh and organic milk from grass-fed cows.
        </p>
        <button class="add-to-cart-button">Add to Cart</button>
      </div>
      <div class="category-details">
        <h2>Category: Coke & Milk</h2>
        <router-link to="/categories/1">View More in Coke & Milk</router-link>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "ProductPage",
  };
  </script>
  
  <style scoped>
  .product-page {
    display: flex;
    justify-content: space-between;
    padding: 20px;
  }
  
  .product-details {
    width: 60%;
  }
  
  .product-image {
    width: 100%;
    max-width: 300px;
    margin-bottom: 20px;
  }
  
  .add-to-cart-button {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-weight: bold;
  }
  
  .add-to-cart-button:hover {
    background-color: #218838;
  }
  
  .category-details {
    width: 35%;
  }
  
  h1 {
    color: #007bff;
  }
  
  a {
    color: #28a745;
    text-decoration: none;
  }
  
  a:hover {
    text-decoration: underline;
  }
  </style>
  