import { createApp, h } from 'vue'
import { createInertiaApp,Link } from '@inertiajs/inertia-vue3'
import { ZiggyVue } from 'ziggy';
import { Ziggy } from './ziggy';
import FlashMessage from '@smartweb/vue-flash-message';


createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(FlashMessage)
            .mixin({ methods: { route } })
            .use(ZiggyVue, Ziggy)
            .component('Link', Link)
            .mount(el)
    },
});
