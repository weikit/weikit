<template>
  <q-btn
    :id="id"
    :class="classes"
    :styles="styles"
    :label="label"
    v-bind="extra"
  ></q-btn>
</template>

<script>
import { defineComponent, toRef, toRefs } from "vue";
import {
  makeComponentProps,
  useComponentAttrs,
} from "../../composables/component";

export default defineComponent({
  props: {
    ...makeComponentProps({
      extra: {
        default: {
          color: "primary",
        },
      },
      classes: {
        default: "full-width",
      },
    }),

    label: {
      type: String,
      default: "",
      required: true,
    },
  },
  setup(props) {
    const componentAttrs = useComponentAttrs(props);
    const label = toRef(props, "label");

    return {
      ...toRefs(componentAttrs),
      label,
    };
  },
});
</script>
