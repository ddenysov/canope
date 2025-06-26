<script setup>
import {defineAsyncComponent} from "vue";

const SignUp = defineAsyncComponent(() => import('sign_up/SignUp'))
</script>

<template>
    <SignUp />
</template>
