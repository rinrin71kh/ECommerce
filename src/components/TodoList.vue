<template>
  <div>
    <!-- Daily Task Section -->
    <div class="daily-task mt-3">
      <div class="task-title">Daily Tasks</div>
      <ul class="todoLists">
        <TodoItem
          v-for="todo in todos"
          :key="todo.id"
          icon="uil-adobe-alt"
          :todo="todo"
        />
      </ul>
    </div>
    <!-- Pending Tasks Section -->
    <div class="daily-task mt-3">
      <div class="task-title">Pending Tasks</div>
     
    </div>
    <ul class="todoLists">
      <TodoItem
        v-for="todo in pendingTasks"
        :key="todo.id"
        icon="uil-adobe-alt"
        :todo="todo"
      />
    </ul>

    <!-- Completed Tasks Section -->
    <div class="daily-task mt-3">
      <div class="task-title">Completed Tasks</div>
     
    </div>
    <ul class="todoLists">
      <TodoItem
        v-for="todo in completedTasks"
        :key="todo.id"
        icon="uil-adobe-alt"
        :todo="todo"
      />
    </ul>
  </div>
</template>

<script>
import { computed } from "vue";
import { useTodoStore } from "../stores/todo";
import TodoItem from "./TodoItem.vue";

export default {
  name: "TodoList",
  components: {
    TodoItem,
  },
  setup() {
    const todoStore = useTodoStore();

    // Computed properties for all tasks
    const todos = computed(() => todoStore.todos); // All tasks for Daily Tasks
    const pendingTasks = computed(() =>
      todoStore.todos.filter((todo) => todo.status === "pending")
    ); // Pending tasks
    const completedTasks = computed(() =>
      todoStore.todos.filter((todo) => todo.status === "completed")
    ); // Completed tasks

    // Fetch todos when component is mounted
    const fetchTodos = async () => {
      await todoStore.fetchTodos();
    };

    fetchTodos();

    return {
      todos,
      pendingTasks,
      completedTasks,
    };
  },
};
</script>
