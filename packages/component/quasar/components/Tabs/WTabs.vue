<template>
  <q-card>
    <q-tabs :id="id" :class="classes" v-model="currentTab">
      <q-tab
        :key="index"
        v-for="({ componentName, ...componentOptions }, index) in children"
        :k="componentName"
        v-bind="componentOptions"
      ></q-tab>
    </q-tabs>

    <q-separator />

    {{ currentTab }}

    <q-tab-panels :id="id" :class="classes" v-model="currentTab">
      <component
        :key="index"
        v-for="({ componentName, ...componentOptions }, index) in children"
        :is="componentName"
        v-bind="componentOptions"
      ></component>
    </q-tab-panels>
  </q-card>
</template>

<script>
import { defineComponent, ref, toRefs } from "vue";
import {
  defaultComponentChildrenProps,
  defaultComponentProps,
  useComponentChildren,
} from "../../composables";

export default defineComponent({
  props: {
    ...defaultComponentProps(),
    ...defaultComponentChildrenProps(),
  },
  setup(props) {
    const { children } = useComponentChildren(props);

    const currentTab = ref("tab1");

    const switchTab = (tab) => {
      currentTab.value = tab;
    };

    return {
      ...toRefs(props),
      currentTab,
      switchTab,
      children,
    };
  },
});
</script>
