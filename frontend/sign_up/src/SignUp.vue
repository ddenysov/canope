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
      <UiTextField label="Імейл" form="sign_up" name="email" />
      <h2 class="form-title">Create your account</h2>
      <form class="register-form" @submit.prevent="onSubmit">
        <label class="field">
          <span>Name</span>
          <input
            v-model="name"
            type="text"
            required
            placeholder="John Doe"
          />
        </label>

        <label class="field">
          <span>Email</span>
          <input
            v-model="email"
            type="email"
            required
            placeholder="john@example.com"
          />
        </label>

        <label class="field password-field">
          <span>Password</span>
          <input
            v-model="password"
            type="password"
            required
            minlength="8"
            placeholder="••••••••"
            @input="evaluateStrength"
          />
          <progress
            v-if="password"
            class="password-strength"
            :value="strengthScore"
            max="4"
          ></progress>
        </label>

        <label class="field">
          <span>Confirm Password</span>
          <input
            v-model="confirm"
            type="password"
            required
            :class="{ invalid: confirm && confirm !== password }"
            placeholder="••••••••"
          />
        </label>

        <button class="submit-btn" :disabled="!isValid">Register</button>
      </form>

      <p class="login-hint">
        Already have an account?
        <a href="/login">Sign in</a>
      </p>
    </div>
  </section>
</template>

<script setup lang="ts">
// -----------------------------
// Register page logic
// -----------------------------
import { ref, computed } from 'vue'
import { UiTextField } from "@local/ui";

/** Form fields */
const name = ref<string>('')
const email = ref<string>('')
const password = ref<string>('')
const confirm = ref<string>('')

/** Password strength (0‑4) */
const strengthScore = ref<number>(0)

/** Basic strength estimator */
function evaluateStrength(): void {
  const pwd = password.value
  let score = 0
  if (pwd.length >= 8) score++
  if (/[A-Z]/.test(pwd)) score++
  if (/[0-9]/.test(pwd)) score++
  if (/[^A-Za-z0-9]/.test(pwd)) score++
  strengthScore.value = score
}

/** Form validity */
const isValid = computed(() => {
  return (
    name.value &&
    /.+@.+\..+/.test(email.value) &&
    password.value.length >= 8 &&
    password.value === confirm.value
  )
})

/** Emit register event (placeholder) */
function onSubmit(): void {
  if (!isValid.value) return

  // Replace with API call or emit
  const payload = {
    name: name.value,
    email: email.value,
    password: password.value,
  }
  // eslint-disable-next-line no-console
  console.log('Register payload', payload)
  alert('Registered successfully!')
}
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

.password-field {
  position: relative;
}

.password-strength {
  width: 100%;
  height: 6px;
  margin-top: 0.4rem;
}

.submit-btn {
  margin-top: 1rem;
  padding: 0.9rem 1rem;
  background: #2b6cb0;
  color: #fff;
  border: none;
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s ease-in-out;
}

.submit-btn:disabled {
  background: #a0aec0;
  cursor: not-allowed;
}

.submit-btn:not(:disabled):hover {
  background: #1e4d82;
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
