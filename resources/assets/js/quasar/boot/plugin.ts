import { merge } from "lodash-es";
import http from "../../common/http";
import {
  Quasar,
  AppFullscreen,
  AppVisibility,
  BottomSheet,
  Cookies,
  Dark,
  Dialog,
  Loading,
  LoadingBar,
  LocalStorage,
  SessionStorage,
  Meta,
  Notify,
} from "quasar";
import app from "../app";
import config from "../../common/config";
import QuasarComponent from "@weikit/component/quasar";
import { readonly } from "@vue/reactivity";

app.use(
  Quasar,
  merge(
    {
      plugins: {
        // AddressbarColor,
        AppFullscreen,
        AppVisibility,
        BottomSheet,
        Cookies,
        Dark,
        Dialog,
        Loading,
        LoadingBar,
        LocalStorage,
        SessionStorage,
        Meta,
        Notify,
      },
    },
    config.quasarOptions
  )
);

if (!app.config.globalProperties.$q.iconMapFn) {
  app.config.globalProperties.$q.iconMapFn = (iconName) => {
    if (iconName.startsWith("voyager") === true) {
      // TODO custom icon
      return {
        cls: "icon " + iconName,
      };
    }
  };
}

if (!app.config.globalProperties.$http) {
  app.config.globalProperties.$http = http;
}

if (!app.config.globalProperties.$config) {
  app.config.globalProperties.$config = readonly(config);
}

app.use(QuasarComponent);
