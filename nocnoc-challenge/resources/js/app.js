import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import 'primevue/resources/themes/saga-blue/theme.css'; // Tema de PrimeVue
import 'primevue/resources/primevue.min.css'; // Estilos de PrimeVue
import 'primeicons/primeicons.css'; // Iconos de PrimeIcons

// import Vue from 'vue';
// import App from './App.vue';

// // Importa los componentes de PrimeVue que necesites utilizar
// import Button from 'primevue/button';
// // Importa otros componentes de PrimeVue según lo necesites

// // Registra los componentes de PrimeVue para que estén disponibles en tu aplicación
// Vue.component('Button', Button);

// // Registra otros componentes de PrimeVue según lo necesites

// new Vue({
//     router,
//     render: h => h(App)
//   }).$mount('#app');

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

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
        color: '#4B5563',
    },
});
