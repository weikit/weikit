<template>
  <q-layout class="dashboard-layout" view="lHh lpR lFf">
    <q-header class="bg-white text-grey-9" bordered height-hint="98">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="toggleMenu" />
        <q-btn
          v-if="tabs.length"
          @click.stop="refreshPage"
          dense
          flat
          round
          icon="refresh"
        />
        <slot name="toolbar-left"></slot>

        <q-space></q-space>

        <q-btn-dropdown v-if="user" stretch flat :label="user.username">
          <q-list>
            <q-item clickable v-ripple>
              <q-item-section lay-event="edit_password"
                >修改密码</q-item-section
              >
            </q-item>
            <q-item clickable v-ripple>
              <q-item-section lay-event="logout">退出</q-item-section>
            </q-item>
          </q-list>
        </q-btn-dropdown>
      </q-toolbar>

      <w-page-tab
        :tabs="tabs"
        :activeTab="activeTab"
        @switch="toggleTab"
        @remove="removeTab"
      ></w-page-tab>
    </q-header>

    <q-drawer
      class="text-white side-menu"
      show-if-above
      v-model="left"
      side="left"
      behavior="desktop"
      :width="250"
      bordered
    >
      <q-toolbar class="title-bar text-center">
        <q-toolbar-title>{{ config.name }}</q-toolbar-title>
      </q-toolbar>
      <q-scroll-area style="height: calc(100% - 50px)" dark>
        <q-list class="left-menu-list" dark>
          <w-menu-item
            :data="tree"
            :activeMenu="activeTab"
            @nav="toggleTab"
          ></w-menu-item>
        </q-list>
      </q-scroll-area>
    </q-drawer>

    <q-page-container :style="style">
      <div
        v-for="(tab, index) in tabs"
        :key="index"
        class="content"
        :class="{ show: activeTab && activeTab.id == tab.id }"
      >
        <iframe
          :ref="(el) => (pages[`page_${tab.id}`] = el)"
          frameborder="0"
          :src="tab.href"
          class="iframe"
        />
      </div>
    </q-page-container>
  </q-layout>
</template>

<script>
const { computed, defineComponent, reactive, ref, toRefs } = Vue;
const { useQuasar } = Quasar;
const { useConfig, usePageTab, useUser, useAdminMenu } = Uses;

export default defineComponent({
  setup() {
    const $q = useQuasar();

    const { config } = useConfig();

    const state = reactive({ left: false, height: $q.screen.height });

    const toggleMenu = () => {
      state.left = !state.left;
    };

    const style = computed(() => ({ height: $q.screen.height + "px" }));

    const pages = ref([]);

    const refreshPage = () => {
      const key = `page_${activeTab.id}`;
      if (pages[key]) {
        const $el = pages[key][0];
        $el.contentWindow.location.reload(!0);
      }
    };

    const { user, loadUser } = useUser();
    loadUser();

    const { tabs, activeTab, toggleTab, removeTab } = usePageTab();

    const { tree, loadMenu } = useAdminMenu();
    loadMenu();

    return {
      ...toRefs(state),
      config,
      style,
      pages,
      refreshPage,
      tabs,
      activeTab,
      toggleTab,
      removeTab,
      user,
      tree,
      loadMenu,
      toggleMenu,
    };
  },
});
</script>

<style scoped>
:deep(.title-bar) {
  background: #22a7f0;
  border-color: #22a7f0;
}
:deep(.side-menu) {
  background: #353d47;
  background: linear-gradient(45deg, #353d47, #21292e);
}

.dashboard-layout .content {
  position: relative;
  height: 100%;
  width: 100%;
  display: none;
}
.dashboard-layout .content.show {
  display: block;
}

.dashboard-layout .content .iframe {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
}
</style>
