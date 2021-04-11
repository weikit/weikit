import * as components from "./components";
import { setFormHttp, setComponentEvent } from "./composables";
import mitt from "mitt";
import axios from "axios";
export * from "./composables";

export default {
  install: (
    app,
    {
      http = app.config.globalProperties.$http || axios.create(),
      event = app.config.globalProperties.$event || mitt(),
    } = {}
  ) => {
    for (const key in components) {
      const component = components[key];

      app.component(key, component);
    }

    if (http) {
      setFormHttp(http);
    }
    if (event) {
      setComponentEvent(event);
    }
  },
};
