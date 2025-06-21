<template>
  <!-- Header with navigation menu -->
  <header class="app-header">
    <nav class="menu">
      <!-- App logo / brand -->
      <RouterLink to="/" class="logo">MyApp</RouterLink>

      <!-- Primary navigation links -->
      <ul class="menu-list">
        <li>
          <RouterLink to="/" class="menu-item" active-class="active">Home</RouterLink>
        </li>
        <li>
          <RouterLink to="/sign-up" class="menu-item" active-class="active">Реєстрація</RouterLink>
        </li>
      </ul>
    </nav>
  </header>
</template>

<script setup>
// Composition API + <script setup> syntax.
// No additional logic is required here because <RouterLink>
// automatically applies the "active-class" when its route matches.
// If you need more advanced logic later, you can import
// useRoute() from 'vue-router' and react accordingly.
</script>

<style scoped>
/* Basic styling, tweak to fit your design system */
.app-header {
  background: #2d3748;          /* dark gray background */
  color: #edf2f7;               /* light gray text */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.menu {
  max-width: 1200px;            /* center the content */
  margin: 0 auto;
  padding: 1rem 2rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.logo {
  font-weight: 600;
  font-size: 1.25rem;           /* 20 px */
  text-decoration: none;
  color: inherit;               /* keep header text color */
}

.menu-list {
  list-style: none;
  display: flex;
  gap: 1.5rem;                  /* space between links */
  padding: 0;
  margin: 0;
}

.menu-item {
  text-decoration: none;
  color: inherit;
  transition: color 0.2s ease-in-out;
}

.menu-item:hover {
  color: #63b3ed;               /* blue on hover */
}

.active {
  color: #63b3ed;               /* blue when active */
  font-weight: 600;
}
</style>
