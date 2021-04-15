import { computed, reactive, readonly } from "vue";

import config from "../../../common/config";
import http from "../../../common/http";

function toTree(items, parentId = 0) {
  return items
    .filter((item) => item.parent_id == parentId)
    .map((item) => {
      return {
        ...item,
        children: toTree(items, item.id),
      };
    });
}

export function useAdminMenu() {
  const state = reactive({ menu: null });

  const tree = computed(() => {
    let menuTree = [];

    if (state.menu && Array.isArray(state.menu.items)) {
      menuTree = toTree(state.menu.items);
    }

    return menuTree;
  });

  const loadMenu = async () => {
    const { data } = await http.get(config.api.menu.admin);
    state.menu = data;
  };

  return { state: readonly(state), tree, loadMenu };
}
