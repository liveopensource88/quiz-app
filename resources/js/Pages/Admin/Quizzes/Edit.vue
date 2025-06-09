<template>
  <div class="p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Quiz</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block mb-1">Title</label>
        <input v-model="form.title" class="w-full border p-2 rounded" />
      </div>
      <div class="mb-4">
        <label class="block mb-1">Description</label>
        <textarea v-model="form.description" class="w-full border p-2 rounded" />
      </div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRoute, useRouter } from 'vue-router'

const form = ref({
  title: '',
  description: ''
})

const route = useRoute()
const router = useRouter()

onMounted(async () => {
  const res = await axios.get(`/api/admin/quizzes/${route.params.id}`)
  form.value = {
    title: res.data.title,
    description: res.data.description
  }
})

async function submit() {
  await axios.put(`/api/admin/quizzes/${route.params.id}`, form.value)
  router.push('/admin/quizzes')
}
</script>
