import { createApp } from "vue";
import config from "../common/config";

const app = createApp({
  ...config.appOptions,
});

export default app;
