<script setup lang="ts">
// -----------------------------
// Register page logic
// -----------------------------
import {ref, computed} from 'vue'
import {UiTextField, UiSubmitButton, UiFlex, UiIdentity} from "@local/ui";
</script>

<style scoped>
.register-page {
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: 100vh;
  font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial,
  sans-serif;
}

.hero {
  position: relative;
  background: #000;
  color: #fff;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 2rem;
}

.tagline {
  font-size: 2.5rem;
  z-index: 1;
  text-align: center;
}

.hero-img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0.45;
}

.form-wrapper {
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 4rem 3rem;
  max-width: 480px;
  margin: 0 auto;
}

.form-title {
  font-size: 2rem;
  margin-bottom: 1.5rem;
  text-align: center;
}

.register-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.field {
  display: flex;
  flex-direction: column;
  gap: 0.35rem;
}

.field input {
  padding: 0.75rem 1rem;
  border: 1px solid #cfcfcf;
  border-radius: 6px;
  font-size: 1rem;
}

.field input:focus {
  outline: none;
  border-color: #2b6cb0;
  box-shadow: 0 0 0 2px rgba(43, 108, 176, 0.3);
}

.login-hint {
  margin-top: 1rem;
  font-size: 0.9rem;
  text-align: center;
}

.login-hint a {
  color: #2b6cb0;
  text-decoration: none;
}

/* Mobile responsive */
@media (max-width: 768px) {
  .register-page {
    grid-template-columns: 1fr;
  }

  .hero {
    display: none;
  }

  .form-wrapper {
    padding: 3rem 1.5rem;
  }
}
</style>

<template>
  <section class="register-page">
    <!-- Hero side -->
    <div class="hero" aria-hidden="true">
      <h1 class="tagline">Join the Ride</h1>
      <img
        class="hero-img"
        src="https://images.unsplash.com/photo-1509395176047-4a66953fd231?auto=format&fit=crop&w=800&q=80"
        alt="Cyclist on a mountain trail"
      />
    </div>

    <!-- Form side -->
    <div class="form-wrapper">
      <h2 class="form-title">Create your account</h2>
      <ui-flex gap="4" grow="1" direction="column">
        <UiIdentity form="sign_up" name="id" />
        <UiTextField form="sign_up" name="name" label="Імя" />
        <UiTextField
          form="sign_up"
          name="email"
          label="Електронна пошта"
          :validation1="{ required: true, email: true }"
        />

        <UiTextField form="sign_up" name="password" label="Пароль" />
        <UiTextField form="sign_up" name="password_confirm" label="Підтвердження паролю" />
        <UiSubmitButton form="sign_up" label="Реєстрація" action="users.sign_up" />
        <p class="login-hint">
          Already have an account?
          <a href="/login">Sign in</a>
        </p>
      </ui-flex>
    </div>
  </section>
</template>
