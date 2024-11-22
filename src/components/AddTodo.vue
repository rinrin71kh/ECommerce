<template>
  <div>
    <div class="input-field">
      <textarea
        placeholder="Enter your new todo"
        v-model="newTodo"
        @keyup.enter="addTodo"
      ></textarea>
      <i class="uil uil-notes note-icon" @click="addTodo"></i>
    </div>
    
  </div>
</template>

<script>
import { ref } from "vue";
import { useTodoStore } from "../stores/todo";

export default {
  name: "AddTodo",
  setup() {
    const todoStore = useTodoStore();
    const newTodo = ref("");

    const addTodo = () => {
      if (newTodo.value.trim() === "") return; // Prevent empty todos
      todoStore.todos.push({
        id: Date.now(),
        task: newTodo.value.trim(),
        status: "pending",
        time: new Date().toISOString(),
      });
      newTodo.value = ""; // Clear the input field
    };

    return {
      newTodo,
      addTodo,
    };
  },
};
</script>