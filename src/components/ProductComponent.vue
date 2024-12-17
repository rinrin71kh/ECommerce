<script>
export default {
  name: "ProductComponent",
  props: {
    name: {
      type: String,
      default: "Product Name", // Default product name
    },
    amount: {
      type: Number,
      default: 1, // Default quantity
    },
    color: {
      type: String,
      default: "#FFFFFF", // Default background color
    },
    image: {
      type: String,
      default: "default-image.png", // Default image
    },
    price: {
      type: Number,
      default: 2.51, // Static default price
    },
    originalPrice: {
      type: Number,
      default: 3.0, // Static default original price
    },
    brand: {
      type: String,
      default: "Hodo Foods", // Static brand name
    },
    weight: {
      type: String,
      default: "500 gram", // Static weight
    },
  },
  data() {
    return {
      stars: 4.0, // Static stars for now
      discount: 17, // Static discount percentage for now
    };
  },
  computed: {
    imageUrl() {
      return this.image
        ? `http://localhost:3000/${this.image}`
        : "default-image.png";
    },
    hasDiscount() {
      return this.discount && this.discount > 0;
    },
    formattedPrice() {
      return `$${this.price.toFixed(2)}`;
    },
    formattedOriginalPrice() {
      return this.originalPrice
        ? `$${this.originalPrice.toFixed(2)}`
        : null;
    },
  },
};
</script>

<template>
  <div class="product-card">
    <!-- Discount Badge -->
    <div class="discount-badge" v-if="hasDiscount">
      -{{ discount }}%
    </div>

    <!-- Product Image -->
    <img :src="imageUrl" alt="Product Image" class="product-image" />

    <!-- Product Details -->
    <div class="product-details">
      <div class="brand">{{ brand }}</div>
      <div class="name">{{ name }}</div>
      <div class="rating">
        <span v-for="star in Math.floor(stars)" :key="star" class="star">★</span>
        <span v-if="stars % 1 > 0" class="star">☆</span>
        <span class="rating-number">({{ stars.toFixed(1) }})</span>
      </div>
      <div class="weight">{{ weight }}</div>
      <div class="price-section">
        <span class="current-price">{{ formattedPrice }}</span>
        <span class="original-price" v-if="formattedOriginalPrice">
          {{ formattedOriginalPrice }}
        </span>
      </div>
    </div>

    <!-- Quantity and Add to Cart -->
    <div class="product-actions">
      <button class="quantity-btn">-</button>
      <span class="quantity">{{ amount }}</span>
      <button class="quantity-btn">+</button>
    </div>
  </div>
</template>

<style scoped>
.product-card {
  width: 200px;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 15px; /* Rounded corners */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  background-color: #fff;
  transition: transform 0.3s;
}

.product-card:hover {
  transform: scale(1.05);
}

.discount-badge {
  position: absolute;
  top: 10px;
  left: 10px;
  background-color: #ff4d4f;
  color: #fff;
  padding: 5px 10px;
  font-size: 12px;
  border-radius: 5px;
}

.product-image {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border-radius: 10px;
  margin-bottom: 10px;
}

.product-details {
  text-align: center;
}

.brand {
  font-size: 12px;
  color: #777;
  margin-bottom: 5px;
}

.name {
  font-size: 14px;
  font-weight: bold;
  color: #333;
  margin-bottom: 5px;
}

.rating {
  font-size: 12px;
  color: #ffc107;
  margin-bottom: 5px;
}

.rating .rating-number {
  font-size: 12px;
  color: #777;
}

.weight {
  font-size: 12px;
  color: #777;
  margin-bottom: 10px;
}

.price-section {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
}

.current-price {
  font-size: 16px;
  font-weight: bold;
  color: #28a745;
}

.original-price {
  font-size: 14px;
  color: #999;
  text-decoration: line-through;
}

.product-actions {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  margin-top: 10px;
}

.quantity-btn {
  padding: 5px 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.quantity-btn:hover {
  background-color: #0056b3;
}

.quantity {
  font-size: 14px;
  font-weight: bold;
  color: #333;
}
</style>
