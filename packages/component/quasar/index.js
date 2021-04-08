import * as components from "./components";
import { setFormHttp } from "./composables";
export * from "./composables";

export default {
  install: (app, { http } = {}) => {
    for (const key in components) {
      const component = components[key];

      app.component(key, component);
    }

    if (http) {
      setFormHttp(http);
    }
  },
};
