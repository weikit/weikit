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
  makeComponentProps,
  makeChildrenProps,
  useComponentAttrs,
  useChildrenAttrs,
} from "../../composables/component";

export default defineComponent({
  props: {
    ...makeComponentProps(),
    ...makeChildrenProps(),
  },
  setup(props) {
    const componentAttrs = useComponentAttrs(props);
    const childrenAttrs = useChildrenAttrs(props);
    return {
      ...toRefs(componentAttrs),
      ...toRefs(childrenAttrs),
    };
  },
});
</script>
