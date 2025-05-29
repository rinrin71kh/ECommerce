import { defineStore } from 'pinia'
import axios from 'axios'

export const useTodoStore = defineStore('todo', {
  state: () => ({
    todos: [],
  }),
  getters: {
    pendingTasks: (state) => state.todos.filter(t => !t.completedAt),
    completedTasks: (state) => state.todos.filter(t => t.completedAt),
  },
  actions: {
    async fetchTodos() {
      try {
        const res = await axios.get('http://localhost:3100/tasks')
        this.todos = res.data
      } catch (e) {
        console.error('Failed to fetch todos:', e)
      }
    },
    async addTodo(todo) {
      try {
        await axios.post('http://localhost:3100/tasks', todo)
        await this.fetchTodos()
      } catch (e) {
        console.error('Failed to add todo:', e)
      }
    },
    async clearAll() {
      try {
        await axios.delete('http://localhost:3100/tasks')
        this.todos = []
      } catch (e) {
        console.error('Failed to clear todos:', e)
      }
    },
    async toggleStatus(id) {
      const todo = this.todos.find(t => t.id === id)
      if (!todo) return
      const update = { completedAt: todo.completedAt ? null : new Date().toISOString() }
      try {
        await axios.patch(`http://localhost:3100/tasks/${id}`, update)
        await this.fetchTodos()
      } catch (e) {
        console.error('Failed to toggle status:', e)
      }
    },
    async removeTodo(id) {
      try {
        await axios.delete(`http://localhost:3100/tasks/${id}`)
        await this.fetchTodos()
      } catch (e) {
        console.error('Failed to delete todo:', e)
      }
    },
  }
})
