<template>
  <div>
    <div v-for="task in tasks" :key="task.id" class="todo-item">
      <input
        type="checkbox"
        :checked="task.completedAt != null"
        @change="$emit('toggle', task.id)"
      />
      <span :class="{ completed: task.completedAt }">{{ task.name }}</span>
    </div>
  </div>
</template>
