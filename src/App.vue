<template>
  <div class="container">
    <div class="input-field">
      <input
        v-model="newTask"
        @keyup.enter="onAdd"
        placeholder="Enter your new todo"
      />
      <button @click="onAdd">Add</button>
    </div>
    <h3>Pending Tasks:</h3>
    <ul>
      <li v-for="task in todoStore.pendingTasks" :key="task.id">
        <input type="checkbox" :checked="false" @change="toggle(task.id)">
        {{ task.name }}
        <button @click="remove(task.id)">🗑</button>
      </li>
    </ul>
    <h3>Completed Tasks:</h3>
    <ul>
      <li v-for="task in todoStore.completedTasks" :key="task.id">
        <input type="checkbox" :checked="true" @change="toggle(task.id)">
        <s>{{ task.name }}</s>
        <button @click="remove(task.id)">🗑</button>
      </li>
    </ul>
    <div class="pending-tasks">
      <span>You have <span class="pending-num">{{ todoStore.pendingTasks.length }}</span> tasks pending.</span>
      <button @click="clearAll">Clear All</button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useTodoStore } from './stores/todo'
const todoStore = useTodoStore()
const newTask = ref('')

onMounted(() => {
  todoStore.fetchTodos()
})

function onAdd() {
  const name = newTask.value.trim()
  if (!name) return
  todoStore.addTodo({ name })
  newTask.value = ''
}
function toggle(id) {
  todoStore.toggleStatus(id)
}
function remove(id) {
  todoStore.removeTodo(id)
}
function clearAll() {
  todoStore.clearAll()
}
</script>

<style>
.container { max-width: 500px; margin: 2em auto; background: #f6f6fa; padding: 2em; border-radius: 14px; }
.input-field { display: flex; gap: 8px; }
ul { list-style: none; padding: 0; }
li { margin-bottom: 8px; }
.pending-tasks { margin-top: 2em; display: flex; justify-content: space-between; }
</style>
