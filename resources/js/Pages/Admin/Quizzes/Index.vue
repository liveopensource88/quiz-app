<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">All Quizzes</h1>

    <router-link to="/admin/quizzes/create" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
      + Create Quiz
    </router-link>

    <table class="min-w-full bg-white shadow rounded mt-4">
      <thead>
        <tr class="bg-gray-200 text-left">
          <th class="p-3">Title</th>
          <th class="p-3">Description</th>
          <th class="p-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="quiz in quizzes" :key="quiz.id" class="border-t">
          <td class="p-3">{{ quiz.title }}</td>
          <td class="p-3">{{ quiz.description }}</td>
          <td class="p-3 space-x-2">
            <router-link :to="`/admin/quizzes/${quiz.id}/edit`" class="text-blue-500 hover:underline">Edit</router-link>
            <button @click="deleteQuiz(quiz.id)" class="text-red-500">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const quizzes = ref([])
const router = useRouter()

async function loadQuizzes() {
  const res = await axios.get('/api/admin/quizzes')
  quizzes.value = res.data
}

async function deleteQuiz(id) {
  if (confirm('Are you sure?')) {
    await axios.delete(`/api/admin/quizzes/${id}`)
    await loadQuizzes()
  }
}

onMounted(loadQuizzes)
</script>
