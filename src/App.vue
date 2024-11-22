<template>
  <div class="container">
    <!-- Add Todo Component -->
    <AddTodo />

    <!-- Todo Lists Component -->
    <TodoLists :todos="todos" />

    <!-- Pending Tasks Section -->
    <div class="pending-tasks">
      <span>
        You have <span class="pending-num">{{ countTodos }}</span> tasks pending.
      </span>
      <button class="clear-button" @click="clearAllTodos">Clear All</button>
    </div>
  </div>
</template>

<script>
import { computed } from "vue";
import { useTodoStore } from "./stores/todo";
import AddTodo from "./components/AddTodo.vue";
import TodoLists from "./components/TodoList.vue";

export default {
  name: "App",
  components: {
    AddTodo,
    TodoLists,
  },
  setup() {
    const todoStore = useTodoStore();

    // Reactive getters from the store
    const countTodos = computed(() => todoStore.countTodos);
    const todos = computed(() => todoStore.todos);

    // Method to clear all todos
    const clearAllTodos = () => {
      console.log("Clear All Button Clicked"); // Debug
      todoStore.clearAll(); // Call the clearAll action in the store
      console.log(todoStore.todos); // Verify if todos is empty
    };

    return {
      countTodos,
      todos,
      clearAllTodos,
    };
  },
};
</script>

<style>
@import "https://unicons.iconscout.com/release/v4.0.0/css/line.css";
</style>
