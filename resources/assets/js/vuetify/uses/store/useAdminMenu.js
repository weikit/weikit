import { computed, reactive, readonly } from "@vue/composition-api";

import config from "../../../common/config";
import http from "../../../common/http";

function toTree(items) {
  return items;
}

export function useAdminMenu() {
  const state = reactive({ menu: null });

  const tree = computed(() => {
    let menuTree = [];

    if (Array.isArray(state.menu)) {
      menuTree = toTree(state.menu);
    }

    return menuTree;
  });

  const loadMenu = async () => {
    const { data } = await http.get(config.api.admin.menu);
    state.menu = data;
  };

  return { state: readonly(state), tree, loadMenu };
}
