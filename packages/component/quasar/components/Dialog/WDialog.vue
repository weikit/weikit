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
import { toRefs } from "vue";
import {
  makeComponentProps,
  useComponentAttrs,
} from "../../composables/component";

export default {
  props: {
    ...makeComponentProps(),
  },
  setup() {
    const attrs = useComponentAttrs();

    return {
      ...toRefs(attrs),
    };
  },
};
</script>
