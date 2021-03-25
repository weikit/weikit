import { isFunction } from "lodash-es";
import * as Vue from "vue";
import {
  ref,
  toRaw,
  watchEffect,
  defineComponent as defineVueComponent,
  defineAsyncComponent as defineAsyncVueComponent,
} from "vue";
import http from "./http";
import { loadModule } from "vue3-sfc-loader";

const appComponent = ref(null);

export function defineComponent(options, registerOptions = {}) {
  return registerAppComponent(defineVueComponent(options), registerOptions);
}

export function defineAsyncComponent(options, registerOptions = {}) {
  return registerAppComponent(
    defineAsyncVueComponent(options),
    registerOptions
  );
}

// Register first component as app component
export function registerAppComponent(
  component,
  { templateId = "#vue-template" }
) {
  if (!appComponent.value) {
    if (!isFunction(component) && !component.render && !component.template) {
      const elm = document.querySelector(templateId);
      if (elm) {
        component.template = elm;
      }
    }
    appComponent.value = component;
  }

  return component;
}

// hook first defined component as App component
export function hookAppComponent() {
  if (appComponent.value) {
    // hook sync page component
    const component = toRaw(appComponent.value);

    return component;
  } else {
    // hook async page component
    return defineAsyncVueComponent({
      loader: async () => {
        return new Promise((resolve, reject) => {
          const stop = watchEffect(() => {
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

/**
 *
 * resolve async component from url
 *
 * @param {*} url
 * @param {*} componentOptions
 * @param {*} resolveOptions
 * @returns
 */
export function resolveAsyncComponent(
  url,
  componentOptions = {},
  resolveOptions = {}
) {
  return defineAsyncVueComponent({
    loader: () =>
      loadModule(url, {
        moduleCache: { vue: Vue },
        async getFile(url) {
          console.log(url);
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
