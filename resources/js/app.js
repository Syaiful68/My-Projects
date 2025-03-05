import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import '@tabler/core/dist/css/tabler.css'
import '@tabler/core/dist/js/tabler.esm'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})