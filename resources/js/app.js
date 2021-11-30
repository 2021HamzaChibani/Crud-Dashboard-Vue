import { createApp, h } from 'vue'
import { createInertiaApp,Link } from '@inertiajs/inertia-vue3'
import { ZiggyVue } from 'ziggy';
import { Ziggy } from './ziggy';


createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .use(ZiggyVue, Ziggy)
            .component('Link', Link)
            .mount(el)
    },
});
