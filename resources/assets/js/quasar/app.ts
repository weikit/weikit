import { createApp, h } from "vue";
import { App, plugin } from "@inertiajs/inertia-vue3";
import { resolveAsyncComponent } from "../common/weikit";
import config from "../common/config";

const el = document.querySelector(config.id);
console.log(1);
const app = createApp({
  render: () =>
    h(App, {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: (name) =>
        resolveAsyncComponent(name.replace(".vue", "") + ".vue"),
    }),
});
app.use(plugin);

export default app;
