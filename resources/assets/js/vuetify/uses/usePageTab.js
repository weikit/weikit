import { computed, reactive, readonly } from "@vue/composition-api";
import { cloneDeep } from "lodash-es";

export function usePageTab() {
  const state = reactive({ tabs: null, activeTabId: null });

  const tabs = computed(() => {
    return state.tabs || [];
  });

  const activeTab = computed(() => {
    const tab = tabs.value.find((_tab) => _tab.id == state.activeTabId);
    return tab || tabs.value[0] || {};
  });

  const toggleTab = (tab) => {
    if (!tabs.value.find((_tab) => _tab.id == tab.id)) {
      state.tabs = [...tabs.value, tab];
    }
    state.activeTabId = tab.id;
  };

  const removeTab = async (tab) => {
    const _tabs = cloneDeep(tabs.value);
    const index =
      tabs.length == 1 ? -1 : _tabs.findIndex((_tab) => _tab.id == tab.id);
    _tabs.splice(index, 1);

    state.tabs = _tabs;
  };

  return { state: readonly(state), tabs, activeTab, toggleTab, removeTab };
}
