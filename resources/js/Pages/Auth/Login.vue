<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-600 to-purple-600">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center">Login to Quiz App</h2>

      <form @submit.prevent="form.post('/login')">
        <div class="mb-4">
          <label class="block mb-1 text-sm font-semibold">Email</label>
          <input
            v-model="form.email"
            type="email"
            class="w-full px-4 py-2 border rounded-lg"
          />
          <p v-if="form.errors.email" class="text-red-600 text-sm mt-1">{{ form.errors.email }}</p>
        </div>

        <div class="mb-6">
          <label class="block mb-1 text-sm font-semibold">Password</label>
          <input
            v-model="form.password"
            type="password"
            class="w-full px-4 py-2 border rounded-lg"
          />
          <p v-if="form.errors.password" class="text-red-600 text-sm mt-1">{{ form.errors.password }}</p>
        </div>

        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-bold"
        >
          Login
        </button>
      </form>

      <p class="mt-6 text-sm text-center">
        Don't have an account?
        <Link href="/register" class="text-blue-600 hover:underline">Sign Up</Link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
  email: '',
  password: '',
})
</script>
