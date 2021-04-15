<template>
  <div class="menu-item-wrapper">
    <template v-for="menu in data">
      <q-expansion-item
        :key="menu.id"
        v-if="menu.children.length > 0"
        :icon="menu.icon_class"
        :label="menu.title"
        expand-separator
        class="text-item"
      >
        <w-menu-item
          :data="menu.children"
          :activeMenu="activeMenu"
          @nav="handleNav"
        ></w-menu-item>
      </q-expansion-item>

      <q-item
        v-else
        :key="menu.id"
        clickable
        v-ripple
        :active="isActive(menu)"
        class="text-item"
        active-class="bg-item text-white"
        @click.stop="handleNav(menu)"
      >
        <q-item-section avatar>
          <q-icon :name="menu.icon_class" />
        </q-item-section>

        <q-item-section>{{ menu.title }}</q-item-section>
      </q-item>
    </template>
  </div>
</template>

<script>
export default {
  props: {
    data: {
      type: Array,
      required: true,
    },
    activeMenu: {
      type: Object,
      default: {},
    },
  },

  methods: {
    handleNav(menu) {
      this.$emit("nav", menu);
    },
    isActive(menu) {
      return this.activeMenu.id == menu.id;
    },
  },
};
</script>

<style scoped lang="scss">
:deep(.q-item) {
  font-size: 16px;

  &:hover .q-item__section {
    color: #fff;
  }
  .q-item__section--avatar {
    min-width: 36px;
    padding-left: 0px;

    .q-icon {
      font-size: 18px;
    }
  }
}
:deep(.bg-item) {
  background-color: #384046;
}
:deep(.text-item) {
  color: #76838f;
}
:deep(.menu-item-wrapper) > .q-item {
  padding-left: 30px;
}
</style>
