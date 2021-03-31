<template>
  <div :id="id" class="row" :class="classes">
    <div
      class="col"
      :key="index"
      v-for="({ componentName, ...componentOptions }, index) in children"
    >
      <component :is="componentName" v-bind="componentOptions" />
    </div>
  </div>
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
