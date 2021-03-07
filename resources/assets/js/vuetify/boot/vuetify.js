import { createVuetify } from "vuetify";
import app from "../app";
import config from "../../common/config";
import * as components from "vuetify/lib/components";
import * as directives from "vuetify/lib/directives";

const vuetifyInstance = createVuetify({
  components,
  directives,
  ...config.vuetify.createOptions,
});

app.use(vuetifyInstance, config.vuetify.options);
