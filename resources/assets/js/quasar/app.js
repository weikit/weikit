import { useQuasar } from "quasar";
import { createApp } from "vue";
import config from "../common/config";

const app = createApp({
  setup() {
    // TODO move into boot/quasar.js
    const $q = useQuasar();

    $q.iconMapFn = (iconName) => {
      if (iconName.startsWith("voyager") === true) {
        return {
          cls: "icon " + iconName,
        };
      }
    };
  },
  ...config.quasar.appOptions,
});

export default app;
