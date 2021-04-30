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
import { defaultComponentProps } from "../../composables";

export default {
  props: {
    ...defaultComponentProps,
  },
  setup() {
    return {
      ...toRefs(props),
    };
  },
};
</script>
