import { createInertiaApp } from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import { renderToString } from '@vue/server-renderer'
import { createSSRApp, h } from 'vue'

createServer(page =>
    createInertiaApp({
        page,
        render: renderToString,
        resolve: async name => {
            const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
            const page = await resolvePageComponent(`./pages/${name}.vue`, pages)

            // 💡 Set layout based on folder name
            if (name.startsWith('admin/')) {
                page.default.layout ??= AdminLayout
            } else {
                page.default.layout ??= UserLayout
            }

            return page
        },
        setup({ App, props, plugin }) {
            return createSSRApp({
                render: () => h(App, props),
            }).use(plugin)
        },
    }),
    { cluster: true },
)