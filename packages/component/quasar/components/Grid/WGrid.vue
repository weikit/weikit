<template>
  <div :id="id" :class="classes" :styles="styles" v-bind="extra">
    <div
      class="col"
      :key="index"
      v-for="({ component, ...componentOptions }, index) in children"
    >
      <component :is="component" v-bind="componentOptions" />
    </div>
  </div>
</template>

<script>
import { merge } from "lodash-es";
import { defineComponent, ref, toRefs } from "vue";
import {
  defaultComponentChildrenProps,
  defaultComponentProps,
  useComponentChildren,
} from "../../composables";

export default defineComponent({
  props: merge(defaultComponentProps(), defaultComponentChildrenProps(), {
    classes: {
      default: "row",
    },
  }),
  setup(props) {
    const { children } = useComponentChildren(props);

    return {
      ...toRefs(props),
      children: ref(children),
    };
  },
});
</script>
