import "../css/app.css";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import AdminLayout from './layouts/AdminLayout.vue';
import UserLayout from './layouts/UserLayout.vue';
const appName = import.meta.env.VITE_APP_NAME || "SPW Gridas";

createInertiaApp({
    title: (title) => `${title} | ${appName}`,

    resolve: async name => {
        const pages = import.meta.glob('./pages/**/*.vue', { eager: false })
        const page = await resolvePageComponent(`./pages/${name}.vue`, pages)

        // 💡 Set layout based on folder name
        if (name.startsWith('admin/') || name.startsWith('kasir/')) {
            page.default.layout ??= AdminLayout
        } else {
            page.default.layout ??= UserLayout
        }

        return page
    },

    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    }
}).then(() => {
    document.getElementById('app').removeAttribute('data-page');
    document.getElementById('app').removeAttribute('data-v-app');
});;
