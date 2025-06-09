<template>
  <DashboardLayout>
    <h1 class="text-2xl font-bold mb-6">Edit Category</h1>

    <form @submit.prevent="updateCategory" class="space-y-6 max-w-lg">
      <div>
        <label class="block font-semibold mb-1">Name</label>
        <input v-model="form.name" type="text" class="w-full px-4 py-2 border rounded" />
        <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
      </div>

      <div>
        <label class="block font-semibold mb-1">Description</label>
        <textarea v-model="form.description" class="w-full px-4 py-2 border rounded"></textarea>
        <p v-if="form.errors.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</p>
      </div>

      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold">
        Update
      </button>
    </form>
  </DashboardLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { defineProps } from 'vue'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'

const props = defineProps({
  category: Object
})

const form = useForm({
  name: props.category?.name ?? '',
  description: props.category?.description ?? ''
})

function updateCategory() {

  form.put(route('api.admin.categories.update', props.category.id))
}
</script>
