<script>
export default {
  name: 'ProductComponent',
  props: {
    name: {
      type: String,
      default: 'Product name', // Default name if not provided
    },
    amount: {
      type: Number,
      default: 0, // Default amount
    },
    color: {
      type: String,
      default: '#FFFFFF', // Default background color
    },
    image: {
      type: String,
      default: '', // Default empty image path
    },
  },
  computed: {
    imageUrl() {
      // Compute the full image URL, handle missing images
      return this.image
        ? `http://localhost:3000/${this.image}`
        : 'default-image.png'; // Provide a placeholder/default image
    },
  },
};
</script>

<template>
  <div class="wrapper" :style="{ backgroundColor: color }">
    <img :src="imageUrl" alt="Product Image" class="image" />
    <div class="name">{{ name }}</div>
    <div class="amount">{{ amount }} <span>items</span></div>
  </div>
</template>

<style scoped>
.wrapper {
  width: 150px;
  height: 180px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Added shadow for better visuals */
  border: 1px solid #ddd;
  transition: transform 0.3s ease; /* Add hover effect */
}
.wrapper:hover {
  transform: scale(1.05); /* Slight zoom effect */
}

.name {
  font-weight: 600;
  font-size: 16px;
  text-align: center;
  color: #333;
  margin: 5px 0;
}

.amount {
  font-weight: 400;
  font-size: 13px;
  color: grey;
}

.image {
  width: 100px;
  height: 100px;
  border-radius: 10px;
  object-fit: cover; /* Ensure the image fits nicely */
}
</style>
