import { createApp } from "vue";
import config from "../common/config";

const app = createApp({
  ...config.vuetify.appOptions,
});

export default app;
