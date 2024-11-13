<script>
import axios from 'axios';
import ButtonComponent from './components/ButtonComponent.vue';
import CategoryComponent from './components/CategoryComponent.vue';
import PromotionComponent from './components/PromotionComponent.vue';
export default{
  name: 'App',
  components:{
    ButtonComponent,
    CategoryComponent,
    PromotionComponent
  },
  data() {
    return {
      Categories: [],
      Promotions: [],
    
    }
},
  methods:{
    fetchCategories() { 
      axios.get('http://localhost:3000/api/categories')
      .then(response => {
        // Access the data
        // console.log(response.data); 
        this.Categories = response.data;
      })
      .catch(error => {
        console.error('Error fetching data:', error);
  });
         },
    fetchPromotions() {
      axios.get('http://localhost:3000/api/promotions')
      .then(response => {
        // Access the data
        // console.log(response.data); 
        this.Promotions = response.data;
      })
      .catch(error => {
        console.error('Error fetching data:', error);
  });
          
         }
  },

  mounted () {
          // Mounted life cycle - It will be executed every time
          // this component is loaded

          
          this.fetchCategories()
          this.fetchPromotions()
     }
}
</script>

<template>

  <div class="category">
    <template v-for="category in Categories">
      <CategoryComponent :name="category.name" :amount="category.productCount" :color="category.color" :image="category.image"></CategoryComponent>
    </template>
  </div>
  <div class="promotion">
    <template v-for="promotion in Promotions">
      <PromotionComponent :title="promotion.title" :color="promotion.color" :btnColor="promotion.buttonColor" :image="promotion.image"></PromotionComponent>
    </template>
  </div>
  
  
</template>

<style scoped>
.category{
  padding-top: 20px;
  margin: auto;
  width: 90%;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  gap: 10px;
  /* overflow-x: auto; */
}
.promotion{
  padding-top: 40px;
  margin: auto;
  width: 90%;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  gap: 10px;
}
</style>
