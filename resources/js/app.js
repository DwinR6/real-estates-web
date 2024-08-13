import './bootstrap';
import '../css/app.css';
import '../css/tailwind.css';
import '@fontsource/dancing-script'; // Importa la fuente Dancing Script

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
// resources/js/app.js

import 'quill/dist/quill.core.css';   // Estilos básicos
import 'quill/dist/quill.snow.css';   // Tema "snow"
import 'quill/dist/quill.bubble.css'; // Tema "bubble" (si lo usas)

import.meta.glob([
    '../image/**',
]);
const appName = import.meta.env.VITE_APP_NAME || 'JC & DGD Urbano';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },

    progress: {
        color: '#021859',
    },
});
