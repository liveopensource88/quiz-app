<template>
  <DashboardLayout>
        <h1 class="text-2xl font-bold mb-4">All Categories</h1>

        <Link href="/admin/categories/create" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
          + Create Category
        </Link>

        <table class="min-w-full bg-white shadow rounded mt-4">
          <thead>
            <tr class="bg-gray-200 text-left">
              <th class="p-3">Name</th>
              <th class="p-3">Description</th>
              <th class="p-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="category in categories" :key="category.id" class="border-t">
              <td class="p-3">{{ category.name }}</td>
              <td class="p-3">{{ category.description }}</td>
              <td class="p-3 space-x-2">
                <Link :href="`/admin/categories/${category.id}/edit`" class="text-blue-500 hover:underline">Edit</Link>
                <button @click="deleteCategory(category.id)" class="text-red-500">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
  </DashboardLayout>
  
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import { defineProps, ref, onMounted } from 'vue'
import axios from 'axios'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'

const categories = ref([])

async function loadCategories() {
  const res = await axios.get('/api/admin/categories')
  categories.value = res.data
}

async function deleteCategory(id) {
  if (confirm('Are you sure?')) {
    await axios.delete(`/api/admin/categories/${id}`)
    await loadCategories()
  }
}

onMounted(loadCategories)
</script>
