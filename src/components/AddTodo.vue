<template>
  <div class="input-field">
    <textarea v-model="todoValue" @keyup.enter.prevent="emitTodo" ref="input" placeholder="Enter your new todo"></textarea>
    <button class="add-btn" @click="emitTodo">Add</button>
  </div>
</template>

<script>
export default {
  data() {
    return { todoValue: '' }
  },
  methods: {
    emitTodo() {
      const value = this.todoValue.trim()
      if (value) {
        this.$emit('added', { name: value }) // Make sure the object matches backend!
        this.todoValue = ''
      }
    },
  },
}
</script>
