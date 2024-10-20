<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
  canLogin?: boolean;
  canRegister?: boolean;
  laravelVersion: string;
  phpVersion: string;
}>();

</script>

<template>
  <Head title="Welcome" />
  <div class="bg-slate-200 text-slate-600">
    <div class="relative flex min-h-screen flex-col items-center justify-center">
      <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
        <main>
          <div class="flex flex-col justify-center items-center">
            <!-- Hero Section -->
            <div class="text-center p-8">
              <h1 class="text-4xl font-bold mb-4">
                Welcome to <span class="bg-primary text-slate-200 px-3 py-1 rounded shadow-sm">DJ Playlist
                Creator</span>
              </h1>
              <p class="text-lg mb-8">
                Elevate your events with custom playlists, tailored for every occasion!
                Whether you're a DJ managing clients or a host creating the perfect atmosphere,
                our platform makes playlist creation seamless and collaborative.
              </p>

              <!-- Action Buttons -->
              <div>
                <Link href="/login">
                  <button
                    class="btn relative border border-transparent bg-primary py-2 px-6 rounded mx-2 overflow-hidden text-slate-200 hover:text-primary">
                    <span class="absolute inset-0 bg-slate-200"></span>
                    <span class="absolute inset-0 flex justify-center items-center">Login</span>
                    Login
                  </button>
                </Link>
                <Link href="/register">
                  <button
                    class="btn relative border border-primary hover:border-secondary py-2 px-6 rounded mx-2 overflow-hidden text-primary hover:text-white">
                    <span class="absolute inset-0 bg-secondary"></span>
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
                  ring-1 ring-white/[0.05] transition duration-300 hover:ring-primary/20 focus:outline-none
                  focus-visible:ring-secondary md:row-span-3 lg:p-10 lg:pb-10 dark:ring-primary/50">
                  <h2 class="text-xl font-semibold mb-2">For DJs</h2>
                  <p>
                    Manage your clients, streamline requests, and deliver personalized music experiences with ease.
                  </p>
                </div>
                <div class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-lg
                  ring-1 ring-white/[0.05] transition duration-300 hover:ring-primary/20 focus:outline-none
                  focus-visible:ring-secondary md:row-span-3 lg:p-10 lg:pb-10 dark:ring-primary/50">
                  <h2 class="text-xl font-semibold mb-2">For Clients</h2>
                  <p>
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
