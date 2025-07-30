<script setup>
import {defineAsyncComponent} from "vue";

const SignIn = defineAsyncComponent(() => import('sign_up/SignIn'))
</script>

<template>
    <UiFill center="both">
      <SignIn />
    </UiFill>
</template>
