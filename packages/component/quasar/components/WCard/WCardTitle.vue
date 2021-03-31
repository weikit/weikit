<template>
  <q-card-section>
    <div :class="classes">{{ title }}</div>
  </q-card-section>
</template>

<script>
import { defineComponent, toRefs, toRef } from "vue";
import {
  makeComponentProps,
  useComponentAttrs,
} from "../../composables/component";

export default defineComponent({
  props: {
    ...makeComponentProps({
      classes: {
        default: ["text-center", "text-h6"],
      },
    }),
    title: {
      type: String,
      default: "",
    },
  },
  setup(props) {
    const componentAttrs = useComponentAttrs(props);
    const title = toRef(props, "title");

    return {
      ...toRefs(componentAttrs),
      title,
    };
  },
});
</script>
