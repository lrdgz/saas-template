<script setup lang="ts">
import { useAuthStore } from "../stores";
import { useRouter } from "vue-router";

const router = useRouter();

const authStore = useAuthStore();

const signOut = () => {
    authStore.signOut().then(() => router.push({name: "auth.sign-in"}));
}

</script>

<template>
    <div>
        <h1 class="bg-pink-200">Welcome to the home page</h1>

        <div class="flex flex-center">
            <v-btn color="primary" @click="signOut">
                Sign Out
            </v-btn>
        </div>
    </div>
</template>

<style scoped>

</style>
