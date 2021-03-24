import { isFunction } from "lodash-es";
import * as Vue from "vue";
import {
  defineAsyncComponent,
  defineComponent as defineVueComponent,
  ref,
  watch,
  toRaw,
} from "vue";
import http from "./http";

import { loadModule } from "vue3-sfc-loader";

const appComponent = ref(null);

export function hookAppComponent() {
  if (appComponent.value) {
    // hook sync page component
    const component = toRaw(appComponent.value);

    return component;
  } else {
    // hook async page component
    return defineAsyncComponent({
      loader: async () => {
        return new Promise((resolve, reject) => {
          const stop = watch(() => {
            try {
              if (appComponent.value) {
                const component = toRaw(appComponent.value);
                stop(); // stop watch
                resolve(component);
              }
            } catch (e) {
              reject(new Error(`Load page component failed: ${e.message}`));
            }
          });
        });
      },
    });
  }
}

export function defineComponent(options) {
  const component = defineVueComponent(options);

  if (!appComponent.value) {
    if (!isFunction(component) && !component.render && !component.template) {
      component.template = document.querySelector("#vue-template");
    }
    appComponent.value = component;
  }

  return component;
}

export function resolveAsyncComponent(
  url,
  componentOptions = {},
  resolveOptions = {}
) {
  return defineAsyncComponent({
    loader: () =>
      loadModule(url, {
        moduleCache: {
          vue: Vue,
        },
        async getFile(url) {
          const response = await http.get(url, {
            headers: {
              "X-Requested-With": "XMLHttpRequest",
            },
          });
          return response.data;
        },
        addStyle(textContent) {
          const style = Object.assign(document.createElement("style"), {
            textContent,
          });
          const ref = document.head.getElementsByTagName("style")[0] || null;
          document.head.insertBefore(style, ref);
        },

        ...resolveOptions,
      }),
    ...componentOptions,
  });
}
