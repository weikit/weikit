import { createApp, h } from "vue";
import { trimEnd } from "lodash-es";
import { App, plugin } from "@inertiajs/inertia-vue3";
import { resolveAsyncComponent } from "../common/weikit";
import config from "../common/config";

const el = document.querySelector(config.id);

const app = createApp({
  render: () =>
    h(App, {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name =>
        resolveAsyncComponent(trimEnd(name, ".vue") + ".vue"),
    }),
});
app.use(plugin);

export default app;
