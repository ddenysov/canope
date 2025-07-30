<script setup lang="ts">
// -----------------------------
// Register page logic
// -----------------------------
</script>

<template>
  <div class="max-w-md w-full space-y-8">
    <div class="bg-white p-8 md:p-10 rounded-xl shadow-lg">
      <div class="text-center">
        <h2 class="mt-2 text-3xl font-bold text-gray-900">
          Увійдіть до свого акаунту
        </h2>
        <p class="mt-2 text-sm text-gray-600">
          Якийсь рандомний текст
        </p>
      </div>

      <!-- Форма -->
      <UiForm name="sign_in">
        <UiTextField
          name="email"
          label="Електронна пошта"
          :validation="{ required: true, email: true }"
        />
        <UiTextField
          name="password"
          label="Пароль"
        />
        <UiSubmitButton
          label="Увійти"
          action="users.sign_in"
        />
      </UiForm>

      <!-- Ссылка на страницу входа -->
      <div class="text-sm text-center mt-6">
        <p class="text-gray-600">
          Ще немає акакунту? Створіть!
          <a href="#" class="font-medium text-teal-500 hover:text-teal-600 transition-colors">
            Рейстрація
          </a>
        </p>
      </div>
    </div>
  </div>
</template>
