import "./bootstrap";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

import vuetify from "@/Plugins/vuetify";
// Create a global attribute ":to" that will be used as inertia link
import link from "@/Plugins/link";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(link)
            .mount(el);
    },
    progress: {
        delay: 250,
        color: '#EEEEEE',
        includeCSS: true,
        showSpinner: false,
      },
});
