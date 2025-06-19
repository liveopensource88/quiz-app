<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-pink-600 to-purple-600">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center">Create an Account</h2>

      <form @submit.prevent="form.post('/register')">
        <div class="mb-4">
          <label class="block mb-1 text-sm font-semibold">Name</label>
          <input
            v-model="form.name"
            type="text"
            class="w-full px-4 py-2 border rounded-lg"
          />
          <p v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</p>
        </div>

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
        <div class="mb-6">
        <label class="block mb-1 text-sm font-semibold">Confirm Password</label>
        <input
          v-model="form.password_confirmation"
          type="password"
          class="w-full px-4 py-2 border rounded-lg"
        />
        <p v-if="form.errors.password_confirmation" class="text-red-600 text-sm mt-1">{{ form.errors.password_confirmation }}</p>
      </div>


        <button
          type="submit"
          class="w-full bg-pink-600 hover:bg-pink-700 text-white py-2 rounded-lg font-bold"
        >
          Sign Up
        </button>
      </form>

      <p class="mt-6 text-sm text-center">
        Already have an account?
        <Link href="/login" class="text-pink-600 hover:underline">Login</Link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '', 
})
</script>
