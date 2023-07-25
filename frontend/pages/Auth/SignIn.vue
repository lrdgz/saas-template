<script setup lang="ts">
    import { reactive, ref } from "vue";
    import { useAuthStore } from "../../stores";
    import { useRouter } from "vue-router";

    const router = useRouter();

    const submiting = ref(false);

    const form = reactive({
        email: "",
        password: "",
    });

    const authStore = useAuthStore();

    const signIn = () => {
        submiting.value = true;
        authStore.signIn(form).then(() => router.push({name: 'home'})).finally(() => (submiting.value = false)).catch((error) => console.error(error));
    };
</script>

<template>
    <div class="flex-center h-full w-full">
        <v-sheet width="700" class="p-4 space-y-7" rounded="lg">
            <h1 class="text-center">Sign In</h1>
            <v-divider />
            <div>
                <v-text-field :loading="submiting" v-model="form.email" label="Email" required/>
                <v-text-field :loading="submiting" v-model="form.password" type="password" label="Password" required/>
                <v-btn color="primary" @click="signIn" block :loading="submiting">
                    Sign In
                </v-btn>
            </div>
        </v-sheet>
    </div>
</template>
