import * as components from "./components";
export * from "./composables";

export default {
  install: (app, options) => {
    for (const key in components) {
      const component = components[key];

      app.component(key, component);
    }
  },
};
