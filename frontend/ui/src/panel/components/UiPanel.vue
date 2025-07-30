<template>
  <Panel header="Header">
    <p class="m-0">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
      Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
  </Panel>
</template>

<script setup>
import {Panel, Avatar, Button, Menu} from "primevue";
import { ref } from 'vue';

const menu = ref(null);

const items = ref([
  {
    label: 'Refresh',
    icon: 'pi pi-refresh'
  },
  {
    label: 'Search',
    icon: 'pi pi-search'
  },
  {
    separator: true
  },
  {
    label: 'Delete',
    icon: 'pi pi-times'
  }
]);

const toggle = (event) => {
  menu.value.toggle(event);
};

const save = () => {
  toast.add({ severity: 'success', summary: 'Success', detail: 'Data Saved', life: 3000 });
};
</script>

<style scoped>
/* Сюда можно добавить специфичные для компонента стили, если это необходимо */
</style>
