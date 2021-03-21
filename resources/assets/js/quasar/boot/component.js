import app from "../app";
import * as components from "../components";

for (const key in components) {
  console.log(`register components ${key}`);
  const component = components[key];

  app.component(key, component);
}
