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
import { defineComponent, reactive, ref, toRefs } from "vue";

import {
  makeComponentProps,
  makeChildrenProps,
  useChildrenAttrs,
  useComponent,
  useComponentAttrs,
} from "../../composables/component";

export default defineComponent({
  props: {
    ...makeComponentProps(),
    ...makeChildrenProps(),
  },
  setup(props) {
    props.children.forEach(tab => {
      if (tab.type != "tab") {
        throw new Error("Tabs only allow Tab to be child components");
      }
      return tab;
    });
    const componentAttrs = useComponentAttrs(props);
    const childrenAttrs = useChildrenAttrs(props);

    const currentTab = ref("tab1");

    const switchTab = tab => {
      currentTab.value = tab;
    };

    return {
      currentTab,
      switchTab,
      ...toRefs(componentAttrs),
      ...toRefs(childrenAttrs),
    };
  },
});
</script>
