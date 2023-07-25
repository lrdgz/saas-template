<script setup lang="ts">
    import {reactive, ref} from "vue";
    import { useAuthStore } from "../../stores";
    import { useRouter } from "vue-router";

    const router = useRouter();

    const submiting = ref(false);

    const form = reactive({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    });

    const authStore = useAuthStore();

    const signUp = () => {
        submiting.value = true;
        authStore.signUp(form).then(() => router.push({name: 'home'})).finally(() => (submiting.value = false)).catch((error) => console.error(error));
    };
</script>

<template>
    <div class="flex-center h-full w-full">
        <v-sheet width="700" class="p-4 space-y-7" rounded="lg">
            <h1 class="text-center">Sign Up</h1>
            <v-divider />
            <div>
                <v-text-field :disabled="submiting" v-model="form.name" label="Name" required/>
                <v-text-field :disabled="submiting" v-model="form.email" label="Email" required/>
                <v-text-field :disabled="submiting" v-model="form.password" type="password" label="Password" required/>
                <v-text-field :disabled="submiting" v-model="form.password_confirmation" type="password" label="Confirm Password" required/>
                <v-btn color="primary" @click="signUp" block :loading="submiting">
                    Sign Up
                </v-btn>
            </div>
        </v-sheet>
    </div>
</template>
