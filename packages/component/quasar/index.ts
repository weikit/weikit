import * as components from "./components";
import { setFormHttp, setComponentEmitter } from "./composables";
import mitt from "mitt";
import axios from "axios";
export * from "./composables";

export default {
  install: (
    app,
    {
      http = app.config.globalProperties.$http || axios.create(),
      emitter = app.config.globalProperties.$event || mitt(),
    } = {}
  ) => {
    for (const key in components) {
      const component = components[key];

      app.component(key, component);
    }

    if (http) {
      setFormHttp(http);
    }
    if (emitter) {
      setComponentEmitter(emitter);
    }
  },
};
