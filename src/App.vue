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
body {
  background: #e9effb;
  font-family: 'Segoe UI', Arial, sans-serif;
}
.container {
  max-width: 500px;
  margin: 2.5em auto;
  background: #fff;
  padding: 2.2em 2em 1.8em 2em;
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(44, 62, 80, 0.11);
}

.input-field {
  display: flex;
  gap: 10px;
  margin-bottom: 22px;
}
.input-field input {
  flex: 1;
  font-size: 1.09rem;
  padding: 11px 14px;
  border: 1.5px solid #bfc5ce;
  border-radius: 8px;
  background: #f8fafc;
  transition: border-color 0.18s;
}
.input-field input:focus {
  border-color: #3b82f6;
  outline: none;
}
.input-field button {
  background: #3b82f6;
  color: #fff;
  border: none;
  padding: 0 22px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  font-size: 1.02rem;
  transition: background 0.17s;
}
.input-field button:hover {
  background: #2563eb;
}

h3 {
  color: #374151;
  font-size: 1.21rem;
  margin-bottom: 0.6em;
  margin-top: 1.3em;
  font-weight: 700;
}

ul {
  list-style: none;
  padding: 0;
}
li {
  display: flex;
  align-items: center;
  background: #f7fafd;
  border-radius: 8px;
  margin-bottom: 10px;
  padding: 11px 16px;
  box-shadow: 0 1px 2px rgba(80, 80, 80, 0.04);
  font-size: 1.05rem;
}
li input[type='checkbox'] {
  width: 19px;
  height: 19px;
  accent-color: #3b82f6;
  margin-right: 10px;
  cursor: pointer;
}
li s {
  color: #64748b;
}
li button {
  margin-left: auto;
  background: none;
  border: none;
  color: #ef4444;
  font-size: 1.1em;
  cursor: pointer;
  border-radius: 5px;
  padding: 2px 9px;
  transition: background 0.15s, color 0.16s;
}
li button:hover {
  background: #ffe5e5;
  color: #b91c1c;
}

.pending-tasks {
  margin-top: 2.5em;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #f2f6fa;
  border-radius: 8px;
  padding: 15px 18px;
  font-size: 1.09rem;
}
.pending-num {
  color: #3b82f6;
  font-weight: 700;
  margin: 0 3px;
}
.pending-tasks button {
  background: #ef4444;
  color: #fff;
  border: none;
  padding: 8px 22px;
  border-radius: 8px;
  font-weight: 600;
  font-size: 1.01rem;
  cursor: pointer;
  transition: background 0.14s;
}
.pending-tasks button:hover {
  background: #b91c1c;
}

</style>
