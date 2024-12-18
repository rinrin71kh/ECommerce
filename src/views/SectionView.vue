<template>
  <div class="section-content">
    <h2 class="section-title">Welcome to {{ pageTitle }} {{ sectionTitle }}</h2>
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
      }[this.$route.params.page] || '';
    },
    sectionTitle() {
      return {
        section1: 'Section 1',
        section2: 'Section 2',
        section3: 'Section 3'
      }[this.$route.params.section] || '';
    }
  }
};
</script>

<style scoped>
.section-content {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 60vh;
  text-align: center;
}

.section-title {
  font-size: 24px;
}
</style>
