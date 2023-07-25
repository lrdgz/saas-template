import { createApp } from 'vue';
import App from './App.vue';

import { Router, Pinia, Vuetify } from './plugins';
import { GuestLayout, AuthLayout } from "./layouts";

import "../resources/css/app.css";

const app = createApp(App);

app.component('guest-layout', GuestLayout);
app.component('auth-layout', AuthLayout);

app.use(Router);
app.use(Pinia);
app.use(Vuetify);

app.mount('body');
