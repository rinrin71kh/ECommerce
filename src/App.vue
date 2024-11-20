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
    ProductComponent, // Register ProductComponent
  },
  data() {
    return {
      Categories: [],
      Promotions: [],
      Products: [], // Add Products data
      Groups:[]
    };
  },
  methods: {
    async fetchCategories() {
      try {
        const response = await axios.get('http://localhost:3000/api/categories');
        console.log('Categories:', response.data);
        this.Categories = response.data;
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },
    async fetchPromotions() {
      try {
        const response = await axios.get('http://localhost:3000/api/promotions');
        console.log('Promotions:', response.data);
        this.Promotions = response.data;
      } catch (error) {
        console.error('Error fetching promotions:', error);
      }
    },
    async fetchProducts() {
      try {
        const response = await axios.get('http://localhost:3000/api/products');
        console.log('Products:', response.data);
        // Clean the image field by removing brackets and quotes
        this.Products = response.data.map(product => ({
          ...product,
          image: Array.isArray(product.image) // If image is an array, join it
            ? product.image[0]
            : product.image.replace(/[\[\]"]/g, ''), // Clean brackets and quotes
        }));
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    async fetchGroups() {
      try {
        const response = await axios.get('http://localhost:3000/api/groups');
        console.log('Groups:', response.data); // Log groups
        this.Groups = response.data;
      } catch (error) {
        console.error('Error fetching groups:', error);
      }
    },
  },
  async mounted() {
    await Promise.all([this.fetchCategories(), this.fetchPromotions(), this.fetchProducts(),this.fetchGroups(),]);
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

    <!-- Products Section -->
    <div class="product" v-if="Products.length">
     
      <template v-for="product in Products" :key="product.id">
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
</style>
