<script setup lang="ts">
</script>

<template>
  <nav class="navbar">
    <div class="container">
      <a href="#" class="logo">MyRide</a>
      <ul class="nav-menu">
        <li><a href="#">
        </a></li>
        <li><a href="#">Маршруты123</a></li>
        <li><a href="#">Сообщество</a></li>
        <li><a href="#">О нас</a></li>
      </ul>
      <div class="auth-buttons">
        <a href="#" class="btn btn-login">Увійти</a>
        <a href="#" class="btn btn-signup">Реєстрація</a>
      </div>
    </div>
  </nav>
</template>

<style scoped>
.navbar {
  background-color: #ffffff;
  border-bottom: 1px solid #e5e7eb;
  padding: 1rem 2rem;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
}
.navbar .container {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.logo {
  font-size: 1.5rem;
  font-weight: bold;
  color: #111827;
  text-decoration: none;
}
.nav-menu {
  list-style: none;
  display: flex;
  gap: 2rem;
  margin: 0;
  padding: 0;
}
.nav-menu a {
  color: #374151;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.2s;
}
.nav-menu a:hover {
  color: #1f2937;
}
.auth-buttons .btn {
  margin-left: 1rem;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
  text-decoration: none;
  font-weight: 500;
  transition: background 0.2s, color 0.2s;
  border: 1px solid transparent;
}
.btn-login {
  background: transparent;
  border-color: #374151;
  color: #374151;
}
.btn-login:hover {
  background: #f3f4f6;
}
.btn-signup {
  background: #111827;
  color: #ffffff;
}
.btn-signup:hover {
  opacity: 0.9;
}
</style>

