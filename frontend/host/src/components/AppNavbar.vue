<script setup lang="ts">

</script>

<template>
  <nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Логотип и основные ссылки -->
        <div class="flex items-center">
          <!-- Логотип -->
          <div class="flex-shrink-0">
            <a href="#" class="flex items-center space-x-2">
              <svg class="h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                   viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14.25 9.75L16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
              </svg>
              <span class="font-bold text-xl text-gray-800">VeloK</span>
            </a>
          </div>
          <!-- Ссылки для десктопной версии -->
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <a href="#"
                 class="text-gray-600 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Главная</a>
              <a href="#"
                 class="text-gray-600 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Мои
                покатушки</a>
              <a href="#"
                 class="text-gray-600 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Маршруты</a>
              <a href="#"
                 class="text-gray-600 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Мои
                маршруты</a>
            </div>
          </div>
        </div>

        <!-- Правая часть: Профиль и кнопки входа/регистрации (для десктопа) -->
        <div class="hidden md:flex items-center space-x-4">
          <a href="#" class="flex items-center text-gray-600 hover:text-indigo-600">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="ml-2 text-sm font-medium">Профиль</span>
          </a>
          <a href="#"
             class="text-gray-800 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md text-sm font-medium">Войти</a>
          <a href="#"
             class="text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md text-sm font-medium">Регистрация</a>
        </div>

        <!-- Кнопка "бургер" для мобильной версии -->
        <div class="-mr-2 flex md:hidden">
          <button id="mobile-menu-button" type="button"
                  class="bg-gray-100 inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-indigo-500"
                  aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Открыть главное меню</span>
            <!-- Иконка "бургер" -->
            <svg id="burger-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <!-- Иконка "крестик" -->
            <svg id="close-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Мобильное меню, показывается/скрывается по клику -->
    <div class="md:hidden hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <a href="#"
           class="text-gray-600 hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Главная</a>
        <a href="#"
           class="text-gray-600 hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Мои
          покатушки</a>
        <a href="#"
           class="text-gray-600 hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Маршруты</a>
        <a href="#"
           class="text-gray-600 hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Мои
          маршруты</a>
      </div>
      <!-- Разделитель -->
      <div class="border-t border-gray-200 pt-4 pb-3">
        <div class="px-5 flex items-center">
          <a href="#" class="flex items-center text-gray-600 hover:text-indigo-600 w-full">
            <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="ml-3 text-base font-medium">Профиль</span>
          </a>
        </div>
        <div class="mt-3 px-2 space-y-2">
          <a href="#"
             class="block w-full text-left rounded-md px-3 py-2 text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">Регистрация</a>
          <a href="#"
             class="block w-full text-left rounded-md px-3 py-2 text-base font-medium text-gray-800 bg-gray-200 hover:bg-gray-300">Войти</a>
        </div>
      </div>
    </div>
  </nav>
</template>

<style scoped>

</style>
