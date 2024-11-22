import { defineStore } from "pinia";

export const useTodoStore = defineStore("todo", {
  state: () => ({
    todos: [],
  }),
  getters: {
    // Count only pending tasks
    countTodos: (state) => state.todos.filter((todo) => todo.status === "pending").length,

    // List of pending tasks
    pendingTasks: (state) => state.todos.filter((todo) => todo.status === "pending"),

    // List of completed tasks
    completedTasks: (state) => state.todos.filter((todo) => todo.status === "completed"),
  },
  actions: {
    // Fetch todos asynchronously
    async fetchTodos() {
      console.log("Fetching todos..."); // Debug
      const todos = await new Promise((resolve) => {
        setTimeout(() => {
          resolve([
            {
              id: 1,
              task: "Clean house",
              status: "pending",
              time: "2023-11-01 11:00:00",
            },
            {
              id: 2,
              task: "Do homework",
              status: "completed",
              time: "2023-11-01 11:00:00",
            },
            {
              id: 3,
              task: "Grocery shopping",
              status: "pending",
              time: "2023-11-01 14:00:00",
            },
          ]);
        }, 1000);
      });

      // Update the state with fetched todos
      this.todos = todos;
      console.log("Todos fetched:", this.todos); // Debug
    },

    // Toggle todo status
    toggleStatus(id) {
      const todo = this.todos.find((t) => t.id === id);
      if (todo) {
        todo.status = todo.status === "completed" ? "pending" : "completed";
        console.log(`Todo with ID ${id} status toggled to ${todo.status}`); // Debug
      }
    },

    // Clear all todos
    clearAll() {
      console.log("Clearing todos..."); // Debug
      this.todos = []; // Clear the todos array
      console.log("Todos cleared:", this.todos); // Debug
    },

    // Add a new todo
    addTodo(task) {
      const newTodo = {
        id: Date.now(),
        task: task.trim(),
        status: "pending",
        time: new Date().toISOString(),
      };
      this.todos.push(newTodo);
      console.log("New todo added:", newTodo); // Debug
    },
  },
});
