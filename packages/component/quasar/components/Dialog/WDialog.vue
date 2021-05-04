<template>
  <q-dialog :id="id" :class="classes" :styles="styles" v-bind="extra">
    <component
      :key="index"
      v-for="({ componentName, ...componentOptions }, index) in children"
      :is="componentName"
      v-bind="componentOptions"
    />
  </q-dialog>
</template>

<script>
import { ref, toRefs } from "vue";
import {
  defaultComponentChildrenProps,
  defaultComponentProps,
  useComponentChildren,
} from "../../composables";

export default {
  props: {
    ...defaultComponentProps(),
    ...defaultComponentChildrenProps(),
  },
  setup(props) {
    const { children } = useComponentChildren(props);

    return {
      ...toRefs(props),
      children: ref(children),
    };
  },
};
</script>
