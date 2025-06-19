<template>
  <DashboardLayout>

      <div v-if="successMessage" class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ successMessage }}
      </div>
    
      <h1 class="text-2xl font-bold mb-4">All Quizzes</h1>

     
      <Link href="/admin/quizzes/create" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block float-right">
          + Create Quiz
        </Link>

      <table class="min-w-full bg-white shadow rounded mt-4">
        <thead>
          <tr class="bg-gray-200 text-left">
            <th class="p-3">Title</th>
            <th class="p-3">Description</th>
            <th class="p-3">category</th>
            <th class="p-3">Actions</th>
          </tr>
        </thead>
        <tbody v-if="quizzes.length > 0">
          <tr v-for="quiz in quizzes" :key="quiz.id" class="border-t">
            <td class="p-3">{{ quiz.title }}</td>
            <td class="p-3">{{ quiz.description }}</td>
            <td class="p-3">{{ quiz.category.name }}</td>
            <td class="p-3 space-x-2">
           
             <Link :href="`/admin/quizzes/${quiz.id}/edit`" class="text-blue-500 hover:underline">Edit</Link>
              <button @click="deleteQuiz(quiz.id)" class="text-red-500">Delete</button>
            </td>
          </tr>
        </tbody>
        <tbody v-else>
            <tr>
              <td colspan="3" class="p-3 text-center text-gray-500">No results found.</td>
            </tr>
          </tbody>
      </table>
 
  </DashboardLayout>
</template>

<script setup>
  import { useForm, Link, usePage } from '@inertiajs/vue3'
  import { onMounted, ref , computed,watch} from 'vue'
  import axios from 'axios'
  import { useRouter } from 'vue-router'
  import DashboardLayout from '@/Layouts/DashboardLayout.vue'
  const quizzes = ref([])
  const router = useRouter()
  const flash = usePage().props.flash
  const successMessage = ref(flash?.success || null)

  watch(
  () => usePage().props.flash?.success,
  (newVal) => {
    if (newVal) {
      successMessage.value = newVal
      setTimeout(() => (successMessage.value = null), 4000)
    }
  },
  { immediate: true }
)

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
