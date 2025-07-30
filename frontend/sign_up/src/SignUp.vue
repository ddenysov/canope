<script setup lang="ts">
// -----------------------------
// Register page logic
// -----------------------------
</script>

<template>
  <UiContainer layout="center">
    <div class="max-w-md w-full space-y-8">
      <div class="bg-white p-8 md:p-10 rounded-xl shadow-lg">
        <div class="text-center">
          <h2 class="mt-2 text-3xl font-bold text-gray-900">
            Створити новий акаунт
          </h2>
          <p class="mt-2 text-sm text-gray-600">
            Приєднуйтесь до спільноти RideFinder!
          </p>
        </div>

        <!-- Форма -->
        <UiForm name="sign_up">
          <UiIdentity
            name="id"
          />
          <UiTextField
            name="name"
            label="Імя"
          />
          <UiTextField
            name="email"
            label="Електронна пошта"
            :validation="{ required: true, email: true }"
          />
          <UiTextField
            name="password"
            label="Пароль"
          />
          <UiTextField
            name="password_confirm"
            label="Підтвердження паролю"
          />
          <UiSubmitButton
            label="Реєстрація"
            action="users.sign_up"
          />
        </UiForm>

        <!-- Ссылка на страницу входа -->
        <div class="text-sm text-center mt-6">
          <p class="text-gray-600">
            Вже є акаунт?
            <a href="#" class="font-medium text-teal-500 hover:text-teal-600 transition-colors">
              Увійти
            </a>
          </p>
        </div>
      </div>
    </div>
  </UiContainer>
</template>
