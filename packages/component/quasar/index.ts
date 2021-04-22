import * as components from "./components";
import { setComponentHttp, setComponentEmitter } from "./composables";
import { Model } from "vue-api-query";
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
      setComponentHttp(http);
      if (!Model.$http) Model.$http = http;
    }

    if (emitter) {
      setComponentEmitter(emitter);
    }
  },
};
