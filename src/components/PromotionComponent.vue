<script>
import ButtonComponent from './ButtonComponent.vue';

export default {
  name: 'PromotionComponent',
  props: {
    title: String,
    color: String,
    btnColor: String,
    image: String,
  },
  components: {
    ButtonComponent,
  },
  methods: {
    shopNow(title) {
      alert("Let's shop: " + title);
    },
  },
};
</script>

<template>
  <div class="wrapper" :style="{ backgroundColor: color }">
    <div class="txt" @click="shopNow(title)">
      <div class="name">{{ title || 'promotion name' }}</div>
      <ButtonComponent :color="btnColor" :title="'Shop Now'" />
    </div>
    <div class="img-wrapper">
      <img :src="`http://localhost:3000/${image}`"alt="Promotion Image" class="image" />
    </div>
  </div>
</template>

<style scoped>
.wrapper {
  width: 30%;
  height: 240px;
  display: flex;
  justify-content: space-around;
  align-items: center;
  border-radius: 10px;
  padding: 10px;
}
.txt {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  gap: 20px;
  text-transform: capitalize;
  padding-left: 20px;
}
.img-wrapper {
  width: 50%;
  height: 100%;
  display: flex;
  justify-content: center;
  border-radius: 10px;
}
.image {
  width: 100%;
  border-radius: 10px;
}
.name {
  font-weight: 500;
  font-size: 18px;
}
</style>
