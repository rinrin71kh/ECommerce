<template>
  <div id="app">
    <!-- Header Section -->
    <header>
      <nav>
        <div class="left-nav">
          <router-link to="/">Home</router-link>
        </div>
        <div class="right-nav">
          <router-link v-for="page in pages" :key="page.name" :to="page.path">
            {{ page.label }}
          </router-link>
        </div>
      </nav>
    </header>

    <!-- Main Container -->
    <div class="main-container">
      <!-- Left Column with Menu and Sections -->
      <div class="left-column">
        <div class="menu">Menu</div>
        <div v-if="currentPage && currentPage !== 'home'">
          <router-link 
            v-for="section in sections" 
            :key="section.name" 
            :to="`/${currentPage}/${section.name}`" 
            class="section-link"
          >
            {{ section.label }}
          </router-link>
        </div>
      </div>

      <!-- Right Column for Dynamic Content -->
      <div class="right-column">
        <router-view></router-view>
      </div>
    </div>

    <!-- Footer Section -->
    <footer>
      Footer
    </footer>
  </div>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      pages: [
        { name: 'page1', path: '/page1', label: 'Page 1' },
        { name: 'page2', path: '/page2', label: 'Page 2' },
        { name: 'page3', path: '/page3', label: 'Page 3' }
      ],
      sections: [
        { name: 'section1', label: 'Section 1' },
        { name: 'section2', label: 'Section 2' },
        { name: 'section3', label: 'Section 3' }
      ]
    };
  },
  computed: {
    currentPage() {
      return this.$route.params.page || this.$route.name || 'home';
    }
  }
};
</script>

<style scoped>
#app {
  display: flex;
  flex-direction: column;
  height: 100vh;
  font-family: Arial, sans-serif;
}

/* Header Styling */
header {
  background-color: #f5f5f5;
  padding: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ccc;
}

/* Navigation Styling */
nav {
  display: flex;
  justify-content: space-between;
  width: 100%;
}

.left-nav a,
.right-nav a {
  margin: 0 10px;
  text-decoration: underline;
  color: blue;
}

/* Main Container Layout */
.main-container {
  display: flex;
  flex: 1;
  border: 1px solid #ccc;
}

/* Left Column Styling */
.left-column {
  width: 20%;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  box-sizing: border-box;
  border-right: 1px solid #ccc;
  padding: 10px;
}

/* Menu and Sections Styling */
.menu {
  background-color: #f5f5f5;
  border: 1px solid #ccc;
  padding: 20px;
  text-align: center;
  margin-bottom: 10px;
}

.section-link {
  display: block;
  background-color: #fff;
  border: 1px solid #ccc;
  padding: 20px;
  text-decoration: underline;
  color: blue;
  text-align: center;
  margin-bottom: 10px;
}

/* Right Column Styling */
.right-column {
  width: 80%;
  padding: 20px;
  box-sizing: border-box;
  background-color: #fff;
}

/* Footer Styling */
footer {
  background-color: #f5f5f5;
  padding: 10px;
  text-align: center;
  border-top: 1px solid #ccc;
}
</style>
