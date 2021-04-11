import { createI18n } from "vue-i18n";
import { merge } from "lodash-es";
import app from "../app";
import config from "../../common/config";
import messages from "../../common/i18n";

const i18n = createI18n(
  merge(
    {
      locale: "en", // set locale
      fallbackLocale: "en", // set fallback locale
      messages, // set locale messages
    },
    config.i18nOptions
  )
);

app.use(i18n);
