import { defineStore } from 'pinia';
import { useLocalStorage } from "@vueuse/core";
import {$post} from "../composables";

const useUserStore = defineStore({
    id: 'auth-store',
    state: () => ({
        user: useLocalStorage('auth::user', { name: '', email: '' }),
        token: useLocalStorage('auth::token', ''),
    }),
    getters: {
        isAuthenticated: (state) => !!state.token,
    },
    actions: {
        signIn({email, password}) {
            return $post('auth/login', { email, password }).then((data) => {
                this.user = data.user;
                this.token = data.token;
            });
        },
        signUp(data) {
            return $post('auth/register', data).then((data) => {
                this.user = data.user;
                this.token = data.token;
            });
        },
        signOut() {
            return $post('auth/logout').finally(() => {
                this.user = { name: '', email: '' }
                this.token = '';
            });
        },
    },
});

export default useUserStore;
