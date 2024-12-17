<template>
  <div id="app">


    <!-- Router View -->
    <router-view />
  </div>
</template>

<script>
export default {
  name: "App",
};
</script>

<style>
/* Add global styles here if needed */
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  text-align: center;
  color: #2c3e50;
  margin-top: 20px;
}
header {
  background-color: #007bff;
  color: white;
  padding: 10px 0;
}
</style>
