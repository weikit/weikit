import config from "../common/config";
import app from "./app";
import "./boot/browser";
import "./boot/vuetify";
import "./boot/component";

app.mount(config.vuetify.id);
