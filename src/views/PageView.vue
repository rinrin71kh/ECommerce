<template>
  <div class="page-content">
    <h2 class="page-title" v-if="!$route.params.section">Welcome to {{ pageTitle }}</h2>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  computed: {
    pageTitle() {
      return {
        page1: 'Page 1',
        page2: 'Page 2',
        page3: 'Page 3'
      }[this.$route.params.page] || 'Home';
    }
  }
};
</script>

<style scoped>
.page-content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 60vh;
  text-align: center;
}

.page-title {
  font-size: 24px;
  margin-bottom: 20px;
}
</style>
