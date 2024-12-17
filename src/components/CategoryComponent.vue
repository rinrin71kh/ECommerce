<script>
export default {
  name: 'CategoryComponent',
  props: {
    name: String,
    amount: Number,
    color: String,
    image: String,
  },
};
</script>

<template>
  <div class="wrapper" :style="{ backgroundColor: color }">
    <img :src="`http://localhost:3000/${image}`"alt="Category Image" class="image" />
    <div class="name">{{ name || 'Product name'}}</div>
    <div class="amount">{{ amount }} <span>items</span></div>
  </div>
</template>

<style scoped>
.wrapper {
  width: 120px;
  height: 150px;
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  align-items: center;
  padding-bottom: 10px;
  border-radius: 10px;
}
.name {
  font-weight: 500;
  font-size: 14px;
  text-align: center;
}
.amount {
  font-weight: 400;
  font-size: 12px;
  color: grey;
}
.image {
  width: 90px;
  height: 90px;
  border-radius: 10px;
}
</style>
