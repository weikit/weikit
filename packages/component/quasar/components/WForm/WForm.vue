<template>
  <q-form :id="id" :class="classes">
    <component
      :key="index"
      v-for="({ componentName, ...componentOptions }, index) in children"
      :is="componentName"
      v-bind="componentOptions"
    />
  </q-form>
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
