import config from "../common/config";
import app from "./app";
import "./boot/quasar";
import "./boot/component";

app.mount(config.quasar.id);
