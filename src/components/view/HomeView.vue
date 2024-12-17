<template>
  <div class="home-container">
    <!-- Menu Component -->
    <MenuComponent />

    <!-- Showcase Component -->
    <div class="showcase">
      <h1 class="showcase-title">Don’t miss amazing grocery deals</h1>
      <p>Sign up for the daily newsletter</p>
      <div class="newsletter-container">
        <input type="email" placeholder="Your email address" class="newsletter-input" />
        <button class="subscribe-button">Subscribe</button>
      </div>
    </div>

    <!-- Categories Section -->
    <div class="section">
      <h2>Categories</h2>
      <div class="category-container">
        <template v-for="category in Categories" :key="category.id">
          <router-link :to="`/categories/${category.id}`" class="category-link">
            <CategoryComponent
              :name="category.name"
              :amount="category.productCount"
              :color="category.color"
              :image="category.image"
            />
          </router-link>
        </template>
      </div>
    </div>

    <!-- Promotions Section -->
    <div class="section">
      <h2>Promotions</h2>
      <div class="promotion-container">
        <template v-for="promotion in Promotions" :key="promotion.id">
          <PromotionComponent
            :title="promotion.title"
            :color="promotion.color"
            :btnColor="promotion.buttonColor"
            :image="promotion.image"
          />
        </template>
      </div>
    </div>

    <!-- Products Section -->
    <div class="section">
      <h2>Popular Products</h2>
      <div class="product-container">
        <template v-for="product in filteredProducts" :key="product.id">
          <router-link :to="`/products/${product.id}`" class="product-link">
            <ProductComponent
              :name="product.name"
              :amount="product.instock"
              :color="product.color || '#F0F0F0'"
              :image="product.image"
            />
          </router-link>
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import MenuComponent from "../MenuComponent.vue";
import CategoryComponent from "../CategoryComponent.vue";
import PromotionComponent from "../PromotionComponent.vue";
import ProductComponent from "../ProductComponent.vue";

export default {
  name: "HomeView",
  components: {
    MenuComponent,
    CategoryComponent,
    PromotionComponent,
    ProductComponent,
  },
  data() {
    return {
      Categories: [],
      Promotions: [],
      Products: [],
      selectedCategory: null,
    };
  },
  computed: {
    filteredProducts() {
      if (!this.selectedCategory) return this.Products;
      return this.Products.filter((product) => product.categoryId === this.selectedCategory);
    },
  },
  methods: {
    async fetchCategories() {
      try {
        const response = await axios.get("http://localhost:3000/api/categories");
        this.Categories = response.data;
      } catch (error) {
        console.error("Error fetching categories:", error);
      }
    },
    async fetchPromotions() {
      try {
        const response = await axios.get("http://localhost:3000/api/promotions");
        this.Promotions = response.data;
      } catch (error) {
        console.error("Error fetching promotions:", error);
      }
    },
    async fetchProducts() {
      try {
        const response = await axios.get("http://localhost:3000/api/products");
        this.Products = response.data;
      } catch (error) {
        console.error("Error fetching products:", error);
      }
    },
  },
  async mounted() {
    await Promise.all([this.fetchCategories(), this.fetchPromotions(), this.fetchProducts()]);
  },
};
</script>

<style scoped>
.home-container {
  display: flex;
  flex-direction: column;
  gap: 40px;
  padding: 20px;
}

/* Showcase Section */
.showcase {
  text-align: center;
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 8px;
}

.newsletter-container {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-top: 10px;
}

.newsletter-input {
  padding: 10px;
  width: 300px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.subscribe-button {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* Sections */
.section {
  padding: 20px 0;
}

.section h2 {
  font-size: 24px;
  margin-bottom: 15px;
}

/* Category Container */
.category-container,
.promotion-container,
.product-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

/* Links */
.category-link,
.product-link {
  text-decoration: none;
}

/* General Styling */
h2 {
  color: #333;
}
</style>
