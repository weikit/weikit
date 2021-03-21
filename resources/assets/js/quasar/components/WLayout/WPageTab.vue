<template>
  <div class="page-tab">
    <q-tabs align="left" :value="activeTab.id" dense no-caps inline-label>
      <q-tab
        v-for="tab in tabs"
        :key="tab.id"
        :name="tab.id"
        :label="tab.title"
        @click.stop="switchTab(tab)"
        :class="{ active: activeTab.id == tab.id }"
      >
        <q-btn
          class="close"
          icon="close"
          flat
          round
          dense
          size="xs"
          @click.stop="removeTab(tab)"
        />
      </q-tab>
    </q-tabs>
  </div>
</template>

<script>
export default {
  props: {
    tabs: {
      type: Array,
      default: [],
    },
    activeTab: {
      type: Object,
      default: {},
    },
  },
  methods: {
    switchTab(tab) {
      this.$emit("switch", tab);
    },
    removeTab(tab) {
      this.$emit("remove", tab);
    },
  },
};
</script>

<style scoped lang="scss">
.page-tab {
  border-top: 1px solid #f6f6f6;
}
:deep(.q-tabs) {
  .q-tabs__arrow--left,
  .q-tabs__arrow--right {
    background: #fff;
  }

  .q-tabs__arrow--left {
    border-right: 1px solid #f6f6f6;
  }
  .q-tabs__arrow--right {
    border-left: 1px solid #f6f6f6;
  }
}

:deep(.q-tab) {
  padding: 0 25px;
  border-right: 1px solid #f6f6f6;
  .close {
    margin-right: -20px;
    margin-left: 5px;
    visibility: hidden;
  }

  &.active {
    background-color: #f1f1f1;
    & .close {
      visibility: inherit;
    }
  }

  &.q-tab--active .close,
  &:hover .close {
    visibility: inherit;
  }

  @media (min-width: 1440px) {
    .q-tab__content {
      min-width: 64px;
    }
  }
}
</style>
