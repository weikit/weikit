import config from "../common/config";
import "./boot/browser";
import app from "./app";
import "./boot/handler";
import "./boot/quasar";
import "./boot/i18n";
import "./boot/component";

app.mount(config.mountId);
