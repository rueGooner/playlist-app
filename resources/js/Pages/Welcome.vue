<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
  canLogin?: boolean;
  canRegister?: boolean;
  laravelVersion: string;
  phpVersion: string;
}>();

function handleImageError() {
  document.getElementById('screenshot-container')?.classList.add('!hidden');
  document.getElementById('docs-card')?.classList.add('!row-span-1');
  document.getElementById('docs-card-content')?.classList.add('!flex-row');
  document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
  <Head title="Welcome" />
  <div class="bg-gray-50 text-black/50 dark:bg-primary dark:text-white/50">
    <div class="relative flex min-h-screen flex-col items-center justify-center">
      <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
        <main>
          <div class="flex flex-col justify-center items-center">
            <!-- Hero Section -->
            <div class="text-center p-8">
              <h1 class="text-4xl font-bold text-gray-100 mb-4">
                Welcome to <span class="text-highlight">DJ Playlist Creator</span>
              </h1>
              <p class="text-gray-50 text-lg mb-8">
                Elevate your events with custom playlists, tailored for every occasion!
                Whether you're a DJ managing clients or a host creating the perfect atmosphere,
                our platform makes playlist creation seamless and collaborative.
              </p>

              <!-- Action Buttons -->
              <div>
                <Link href="/login">
                  <button
                    class="btn relative border border-highlight py-2 px-6 rounded mx-2 overflow-hidden text-highlight hover:text-white">
                    <span class="absolute inset-0 bg-highlight"></span>
                    <span class="absolute inset-0 flex justify-center items-center">Login</span>
                    Login
                  </button>
                </Link>
                <Link href="/register">
                  <button
                    class="btn relative border border-highlight py-2 px-6 rounded mx-2 overflow-hidden text-highlight hover:text-white">
                    <span class="absolute inset-0 bg-highlight"></span>
                    <span class="absolute inset-0 flex justify-center items-center">Register</span>
                    Register
                  </button>
                </Link>
              </div>
            </div>

            <!-- Features Section -->
            <div class="mt-16 w-full flex justify-center">
              <div class="max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-8 p-4">
                <div class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-lg
                  ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-accent/20 focus:outline-none
                  focus-visible:ring-accent md:row-span-3 lg:p-10 lg:pb-10 dark:bg-primary dark:ring-highlight/50 dark:hover:text-white/70">
                  <h2 class="text-xl font-semibold mb-2 text-gray-100">For DJs</h2>
                  <p class="text-gray-100">
                    Manage your clients, streamline requests, and deliver personalized music experiences with ease.
                  </p>
                </div>
                <div class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-lg
                  ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-accent/20 focus:outline-none
                  focus-visible:ring-accent md:row-span-3 lg:p-10 lg:pb-10 dark:bg-primary dark:ring-highlight/50 dark:hover:text-white/70">
                  <h2 class="text-xl font-semibold text-gray-100 mb-2">For Clients</h2>
                  <p class="text-gray-100">
                    Create and customize playlists for your event, ensuring every moment is backed by the perfect soundtrack.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </main>

        <!-- Footer Section -->
        <!-- Uncomment when needed -->
        <!--
        <footer class="py-16 text-center text-sm text-black dark:text-white/70">
          Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </footer>
        -->
      </div>
    </div>
  </div>
</template>
