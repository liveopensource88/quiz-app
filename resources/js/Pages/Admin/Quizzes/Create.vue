<template>
  <div class="p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Create Quiz</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block mb-1">Title</label>
        <input v-model="form.title" class="w-full border p-2 rounded" />
      </div>
      <div class="mb-4">
        <label class="block mb-1">Description</label>
        <textarea v-model="form.description" class="w-full border p-2 rounded" />
      </div>
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const form = ref({
  title: '',
  description: ''
})

const router = useRouter()

async function submit() {
  await axios.post('/api/admin/quizzes', form.value)
  router.push('/admin/quizzes')
}
</script>
