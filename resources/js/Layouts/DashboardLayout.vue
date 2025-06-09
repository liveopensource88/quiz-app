<template>
  <div class="min-h-screen flex bg-gray-100 dark:bg-gray-900">
    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg hidden md:block">
      <div class="p-6 text-2xl font-bold text-center text-indigo-600 dark:text-white">
        Quiz Admin
      </div>
      <nav class="mt-10">
        <Link :href="route('dashboard')" class="nav-link" :class="isActive('dashboard')">Dashboard</Link>
        <Link href="/admin/categories" class="nav-link" :class="isActive('categories')">Categories</Link>
        <Link href="/admin/quizzes" class="nav-link" :class="isActive('quizzes')">Quizzes</Link>
        <Link href="/admin/questions" class="nav-link" :class="isActive('questions')">Questions</Link>
        <Link href="/admin/results" class="nav-link" :class="isActive('results')">Results</Link>
        <Link href="/admin/users" class="nav-link" :class="isActive('users')">Users</Link>
      </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col">
      <!-- Header -->
      <header class="bg-white dark:bg-gray-800 shadow px-6 py-4 flex items-center justify-between">
        <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Admin Panel</h1>
        <button @click="logout" class="text-sm bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
          Logout
        </button>
      </header>

      <!-- Content slot -->
      <main class="p-6">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { router, usePage, Link } from '@inertiajs/vue3'

const logout = () => {
  router.post(route('logout'))
}

const isActive = (section) => {
  const path = usePage().url
  return path.includes(section) ? 'bg-indigo-100 dark:bg-gray-700 font-semibold' : ''
}
</script>

<style scoped>
.nav-link {
  display: block;
  padding: 0.75rem 1rem;
  color: #4B5563;
  font-weight: 500;
  text-decoration: none;
}
.nav-link:hover {
  background-color: #EEF2FF;
}
.dark .nav-link {
  color: #D1D5DB;
}
.dark .nav-link:hover {
  background-color: #374151;
}
</style>
