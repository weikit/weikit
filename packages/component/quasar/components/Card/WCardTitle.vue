<template>
  <q-card-section>
    <div :class="classes">{{ title }}</div>
  </q-card-section>
</template>

<script>
import { merge } from "lodash-es";
import { defineComponent, toRefs } from "vue";
import { defaultComponentProps } from "../../composables";

export default defineComponent({
  props: merge({}, defaultComponentProps, {
    classes: {
      default: ["text-center", "text-h6"],
    },
    title: {
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
