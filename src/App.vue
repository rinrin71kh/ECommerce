<script>
import axios from 'axios';
import ButtonComponent from './components/ButtonComponent.vue';
import CategoryComponent from './components/CategoryComponent.vue';
import PromotionComponent from './components/PromotionComponent.vue';

export default {
  name: 'App',
  components: {
    ButtonComponent,
    CategoryComponent,
    PromotionComponent,
  },
  data() {
    return {
      Categories: [],
      Promotions: [],
    };
  },
  methods: {
    fetchCategories() {
      axios
        .get('http://localhost:3000/api/categories')
        .then(response => {
          console.log('Categories:', response.data);
          this.Categories = response.data;
        })
        .catch(error => {
          console.error('Error fetching categories:', error);
        });
    },
    fetchPromotions() {
      axios
        .get('http://localhost:3000/api/promotions')
        .then(response => {
          console.log('Promotions:', response.data);
          this.Promotions = response.data;
        })
        .catch(error => {
          console.error('Error fetching promotions:', error);
        });
    },
  },
  mounted() {
    this.fetchCategories();
    this.fetchPromotions();
  },
};
</script>

<template>
  <div>
    <div class="category" v-if="Categories.length">
      <template v-for="category in Categories" :key="category.id">
        <CategoryComponent :name="category.name" :amount="category.productCount" :color="category.color" :image="category.image" />
      </template>
    </div>
    <div v-else>No categories available</div>

    <div class="promotion" v-if="Promotions.length">
      <template v-for="promotion in Promotions" :key="promotion.id">
        <PromotionComponent :title="promotion.title" :color="promotion.color" :btnColor="promotion.buttonColor" :image="promotion.image" />
      </template>
    </div>
    <div v-else>No promotions available</div>
  </div>
</template>

<style scoped>
.category {
  padding-top: 20px;
  margin: auto;
  width: 90%;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  gap: 10px;
}
.promotion {
  padding-top: 40px;
  margin: auto;
  width: 90%;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  gap: 10px;
}
</style>
