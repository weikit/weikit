import { Quasar } from "quasar";
import app from "../app";
import config from "../../common/config";

app.use(Quasar, config.quasarOptions);

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
