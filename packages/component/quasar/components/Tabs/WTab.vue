<template>
  <q-tab-panel :id="id" :class="classes" :name="name">
    <component
      :key="index"
      v-for="({ componentName, ...componentOptions }, index) in children"
      :is="componentName"
      v-bind="componentOptions"
    ></component>
  </q-tab-panel>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import {
  defaultComponentChildrenProps,
  defaultComponentProps,
} from "../../composables";

import { useComponentChildren } from "../../composables/component";

export default defineComponent({
  props: {
    ...defaultComponentProps(),
    ...defaultComponentChildrenProps(),
  },
  setup(props) {
    const { children } = useComponentChildren(props);
    return {
      ...toRefs(props),
      children,
    };
  },
});
</script>
