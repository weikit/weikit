import { merge } from "lodash-es";
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

import { QuasarComponent } from "@weikit/component";

app.use(QuasarComponent);
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
  app.config.globalProperties.$q.iconMapFn = iconName => {
    if (iconName.startsWith("voyager") === true) {
      // TODO custom icon
      return {
        cls: "icon " + iconName,
      };
    }
  };
}
