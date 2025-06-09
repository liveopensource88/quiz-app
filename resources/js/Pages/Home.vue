<template>
  <div class="min-h-screen bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white flex flex-col">
    <!-- Navbar -->
    <nav class="flex justify-between items-center px-8 py-4 bg-black bg-opacity-30 shadow-md">
      <h1 class="text-3xl font-extrabold tracking-wide">Quiz Master</h1>
      <div class="space-x-6">
        <Link
          href="/login"
          class="text-white hover:text-pink-300 font-semibold transition"
        >
          Login
        </Link>
        <Link
          href="/register"
          class="text-white hover:text-pink-300 font-semibold transition"
        >
          Sign Up
        </Link>
      </div>
    </nav>

    <!-- Hero Content -->
    <main class="flex-grow flex flex-col justify-center items-center px-6 text-center max-w-4xl mx-auto">
      <h2 class="text-5xl font-bold mb-6 drop-shadow-lg">
        Welcome to Quiz Master
      </h2>
      <p class="text-lg mb-10 max-w-xl drop-shadow-md">
        Challenge yourself with exciting quizzes, track your progress, and learn something new every day!
      </p>
      <Link
        href="/quizzes"
        class="bg-white text-indigo-700 font-bold px-8 py-4 rounded-full shadow-lg hover:bg-pink-500 hover:text-white transition"
      >
        Start Quiz
      </Link>
    </main>

    <!-- Footer -->
    <footer class="text-center py-4 bg-black bg-opacity-20">
      <p class="text-sm opacity-80">&copy; 2025 Quiz Master. All rights reserved.</p>
    </footer>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>
