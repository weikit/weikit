<template>
  <span :id="id" :class="classes" :styles="styles" :href="url" v-bind="extra">
    {{ text }}
  </span>
</template>

<script>
import { merge } from "lodash-es";
import { defineComponent, toRefs } from "vue";
import { defaultComponentProps } from "../../composables";

export default defineComponent({
  props: merge({}, defaultComponentProps(), {
    text: {
      type: String,
      default: "",
    },
  }),
  setup(props) {
    return {
      ...toRefs(props),
    };
  },
});
</script>
