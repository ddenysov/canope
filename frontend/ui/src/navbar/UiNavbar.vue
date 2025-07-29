<template>
  <div class="ui-navbar">
    <div class="max-w-7xl mx-auto">
      <Toolbar class="navbar">
        <!-- Left: logo -->
        <template #start>
          <div class="logo flex align-center gap-2 cursor-pointer" @click="navigate('/')">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="5" cy="18" r="3" />
              <circle cx="19" cy="18" r="3" />
              <path d="M5 18 L9 10 L13 14 L15 10 L19 18" />
              <path d="M13 6 H15" />
            </svg>
            <span class="site-name">RideFinder</span>
          </div>
        </template>

        <!-- Right: main nav and user menu -->
        <template #end>
          <div class="nav-actions flex align-center gap-2">
            <slot name="end" />
          </div>
        </template>
      </Toolbar>
    </div>
  </div>
</template>

<script setup lang="ts">
import Toolbar from 'primevue/toolbar';
import Button from 'primevue/button';
import Avatar from 'primevue/avatar';
import UiContainer from "@/container/UiContainer.vue";
//import { useRouter } from 'vue-router';

/**
 * NavigationBar.vue - logged-in and guest versions handled via isAuthenticated prop.
 */
const props = defineProps<{
  isAuthenticated: boolean;
  user?: {
    avatarUrl?: string;
    name?: string;
  };
}>();

//const router = useRouter();

function navigate(path: string) {
  router.push(path);
}

function logout() {
  // TODO: implement real logout logic
  router.push('/');
}
</script>

<style scoped>
/* Remove default rounded corners */
.navbar {
  border-radius: 0;
}

.logo svg {
  stroke: var(--primary-color, #2c3e50);
}

/* Utility classes */
.flex {
  display: flex;
}

.align-center {
  align-items: center;
}

.gap-2 {
  gap: 0.5rem;
}

.cursor-pointer {
  cursor: pointer;
}

.site-name {
  font-weight: 700;
  font-size: 1.25rem;
}

/* Slightly reduce padding on nav buttons for tighter toolbar look */
.nav-actions :deep(.p-button) {
  padding: 0.5rem 0.75rem;
}

.ui-navbar {
  /* Используем переменную для цвета фона */
  background-color: var(--p-toolbar-background);
}
</style>
