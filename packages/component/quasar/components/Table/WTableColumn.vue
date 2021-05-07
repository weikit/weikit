<template>
  <q-td :id="id" :class="classes" :styles="styles" v-bind="extra">
    <component
      :key="index"
      v-for="({ component, ...componentOptions }, index) in children"
      :is="component"
      v-bind="componentOptions"
    />
  </q-td>
</template>

<script>
import { defineComponent, ref, toRefs } from "vue";
import {
  defaultComponentChildrenProps,
  defaultComponentProps,
  useComponentChildren,
} from "../../composables";

export default defineComponent({
  props: { ...defaultComponentProps(), ...defaultComponentChildrenProps() },
  setup(props) {
    const { children } = useComponentChildren(props);

    return {
      ...toRefs(props),
      children: ref(children),
    };
  },
});
</script>
