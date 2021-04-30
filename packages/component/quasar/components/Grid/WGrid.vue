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
  defaultComponentChildrenProps,
  defaultComponentFieldProps,
  defaultComponentProps,
} from "../../composables";

export default defineComponent({
  props: {
    ...defaultComponentProps,
    ...defaultComponentChildrenProps,
    ...defaultComponentFieldProps,
  },
  setup(props) {
    return {
      ...toRefs(props),
    };
  },
});
</script>
