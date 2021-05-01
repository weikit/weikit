<template>
  <div :id="id" :class="classes" :styles="styles" v-bind="extra">
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
import { defineComponent, ref, toRefs } from "vue";
import {
  defaultComponentChildrenProps,
  defaultComponentFieldProps,
  defaultComponentProps,
  useComponentChildren,
} from "../../composables";

export default defineComponent({
  props: {
    ...defaultComponentProps,
    ...defaultComponentChildrenProps,
    ...defaultComponentFieldProps,
  },
  setup(props) {
    const { children } = useComponentChildren(props);

    return {
      ...toRefs(props),
      children: ref(children),
    };
  },
});
</script>
