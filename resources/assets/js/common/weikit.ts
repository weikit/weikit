import * as Vue from "vue";
import { dirname, extname, normalize, join } from "path-browserify";
import { defineAsyncComponent as defineAsyncVueComponent } from "vue";
import http from "./http";
import { loadModule } from "vue3-sfc-loader";

export function loadComponent(url, options = {}) {
  return loadModule(url, {
    moduleCache: { vue: Vue },
    async getFile(url) {
      console.debug(url);
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
    pathHandlers: {
      extname(filepath) {
        return extname(filepath) || ".vue";
      },
      resolve({ refPath, relPath }) {
        // note :
        //  normalize('./test') -> 'test'
        //  normalize('/test') -> '/test'
        return relPath[0] !== "." && relPath[0] !== "/"
          ? relPath
          : normalize(join(dirname(refPath), relPath));
      },
    },
    ...options,
  });
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
  loadOptions = {}
) {
  return defineAsyncVueComponent({
    loader: () => loadComponent(url, loadOptions),
    ...componentOptions,
  });
}