<script>
import axios from 'axios';
import ButtonComponent from './components/ButtonComponent.vue';
import CategoryComponent from './components/CategoryComponent.vue';
import PromotionComponent from './components/PromotionComponent.vue';
import ProductComponent from './components/ProductComponent .vue';

export default {
  name: 'App',
  components: {
    ButtonComponent,
    CategoryComponent,
    PromotionComponent,
    ProductComponent,
  },
  data() {
    return {
      Categories: [],
      Promotions: [],
      Products: [],
      Groups: [],
      selectedCategory: null, // To track the active category
    };
  },
  computed: {
    filteredProducts() {
      // Filter products based on the selected category
      if (!this.selectedCategory) return this.Products;
      return this.Products.filter(
        (product) => product.categoryId === this.selectedCategory
      );
    },
  },
  methods: {
    async fetchCategories() {
      try {
        const response = await axios.get('http://localhost:3000/api/categories');
        this.Categories = response.data;
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },
    async fetchPromotions() {
      try {
        const response = await axios.get('http://localhost:3000/api/promotions');
        this.Promotions = response.data;
      } catch (error) {
        console.error('Error fetching promotions:', error);
      }
    },
    async fetchProducts() {
      try {
        const response = await axios.get('http://localhost:3000/api/products');
        this.Products = response.data.map((product) => ({
          ...product,
          image: Array.isArray(product.image)
            ? product.image[0]
            : product.image.replace(/[\[\]"]/g, ''),
        }));
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    async fetchGroups() {
      try {
        const response = await axios.get('http://localhost:3000/api/groups');
        this.Groups = response.data;
      } catch (error) {
        console.error('Error fetching groups:', error);
      }
    },
  },
  async mounted() {
    await Promise.all([
      this.fetchCategories(),
      this.fetchPromotions(),
      this.fetchProducts(),
      this.fetchGroups(),
    ]);
  },
};
</script>

<template>
  <div>
    <!-- Categories Section -->
    <div class="category" v-if="Categories.length">
      <template v-for="category in Categories" :key="category.id">
        <CategoryComponent
          :name="category.name"
          :amount="category.productCount"
          :color="category.color"
          :image="category.image"
        />
      </template>
    </div>
    <div v-else>No categories available</div>

    <!-- Promotions Section -->
    <div class="promotion" v-if="Promotions.length">
      <template v-for="promotion in Promotions" :key="promotion.id">
        <PromotionComponent
          :title="promotion.title"
          :color="promotion.color"
          :btnColor="promotion.buttonColor"
          :image="promotion.image"
        />
      </template>
    </div>
    <div v-else>No promotions available</div>

    <!-- Category Tabs -->
    <div class="tabs">
      <button
        v-for="category in Categories"
        :key="category.id"
        class="tab-button"
        :class="{ active: selectedCategory === category.id }"
        @click="selectedCategory = category.id"
      >
        {{ category.name }}
      </button>
      <button
        class="tab-button"
        :class="{ active: selectedCategory === null }"
        @click="selectedCategory = null"
      >
        All
      </button>
    </div>

    <!-- Products Section -->
    <div class="product" v-if="filteredProducts.length">
      <template v-for="product in filteredProducts" :key="product.id">
        <ProductComponent
          :name="product.name"
          :amount="product.instock"
          :color="product.color || '#F0F0F0'"
          :image="product.image"
        />
      </template>
    </div>
    <div v-else>No products available</div>
  </div>
</template>

<style scoped>
.category,
.promotion,
.product {
  padding-top: 20px;
  margin: auto;
  width: 90%;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}

.tabs {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin: 20px 0;
}

.tab-button {
  padding: 10px 20px;
  border: none;
  background-color: #f0f0f0;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.tab-button.active {
  background-color: #007bff;
  color: white;
}

.tab-button:hover {
  background-color: #007bff;
  color: white;
}
</style>
