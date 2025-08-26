<template>
<div>
  <div
    @click="logout"
    class="inline-block text-sm px-4 py-2 cursor-pointer "
  >
    Log out
  </div>
</div>
  <div class="relative flex flex-col h-dvh flex-col items-center justify-center px-8 lg:max-w-none lg:grid-cols-2 px-12 gap-24">
    <h1>Welcome to Three Random Jokes!</h1>
    
    <div class="flex flex-row gap-24">
      <div class="flex flex-col" v-for="joke in jokesList" :key="joke.setup">
        <strong>{{ joke.setup }}</strong> — {{ joke.punchline }}
      </div>
    </div>
    <button @click="refreshJokes" :disabled="loading" class="px-4 py-2 bg-white text-black font-semibold rounded-lg shadow-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition cursor-pointer">
      {{ loading ? 'Loading...' : 'Refresh' }}
    </button>
  </div>
</template>

<script>
import { router } from '@inertiajs/vue3'
export default {
  props: {
    jokes: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      jokesList: this.jokes, // initially populated from server
      loading: false
    };
  },
  methods: {
    async refreshJokes() {
      this.loading = true;
      try {
        const response = await fetch('/api/jokes');
        const data = await response.json();
        this.jokesList = data.data || data; // handle raw JSON
      } catch (err) {
        console.error('Failed to fetch jokes:', err);
      } finally {
        this.loading = false;
      }
    },
    logout() { 
        router.post(route('logout'))
    }
  }
};
</script>