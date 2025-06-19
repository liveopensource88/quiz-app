<template>
  <DashboardLayout>
    <h1 class="text-2xl font-bold mb-4">Create Quiz</h1>

    <form @submit.prevent="createQuiz" class="space-y-6 max-w-lg">
      <!-- Title -->
      <div class="mb-4">
        <label class="block mb-1">Title</label>
        <input v-model="form.title" class="w-full border p-2 rounded" />
         <p v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</p>
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label class="block mb-1">Description</label>
        <textarea v-model="form.description" class="w-full border p-2 rounded" />
        <p v-if="form.errors.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</p>
      </div>

      <!-- Category Dropdown -->
      <div class="mb-4">
        <label class="block mb-1">Category</label>
       <select v-model="form.category_id" class="w-full border p-2 rounded">
        <option disabled value="">Select category</option>
        <option v-for="cat in categories" :key="cat.id" :value="cat.id">
          {{ cat.name }}
        </option>
      </select>
      <p v-if="form.errors.category_id" class="text-red-500 text-sm mt-1">{{ form.errors.category_id }}</p>
      </div>

      <!-- Toggle Active Switch -->
      <div class="mb-4 flex items-center">
        <label class="block mb-1 mr-4">Active</label>
        <input
          type="checkbox"
          v-model="form.is_active"
          class="h-5 w-5 text-blue-600 rounded focus:ring-blue-500 border-gray-300"
        />
        <span class="ml-2">{{ form.is_active ? 'Enabled' : 'Disabled' }}</span>
      </div>

      <!-- Submit Button -->
      <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold"
      >
        Save
      </button>
    </form>
  </DashboardLayout>
</template>

<script setup>
    import { usePage,useForm } from '@inertiajs/vue3'
    import { ref } from 'vue'
    import axios from 'axios'
    import { useRouter } from 'vue-router'
    import DashboardLayout from '@/Layouts/DashboardLayout.vue'
    // Accessing props passed from Laravel
    const { props } = usePage()
    const categories = props.categories

    const form = useForm({
      title: '',
      description: '',
      category_id: '',
      is_active: true,
    })

    const router = useRouter()


    function createQuiz() {
      form.post(route('admin.quizzes.store'))  // Make sure this named route exists in web.php
    }


</script>
