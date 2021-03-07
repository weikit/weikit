import { Quasar } from "quasar";
import app from "../app";
import config from "../../common/config";

app.use(Quasar, config.quasar.options);
