import './bootstrap';
import '../css/app.css';


import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import permission from './directives/permission';

import Vue3Datatable from '@bhplugin/vue3-datatable';


import DataTable from 'datatables.net-vue3';
import DataTablesLib from 'datatables.net';

DataTable.use(DataTablesLib);

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('DataTable', DataTable) //Se agrega el componente DataTable para que se pueda usar en las vistas
            .directive('permission', permission) //Se agrega la directiva permission para que se pueda usar en las vistas
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
