<template>
  <q-input
    :id="id"
    :type="type"
    :label="label"
    :class="classes"
    :placeholder="placeholder"
    :hint="hint"
  >
  </q-input>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import {
  makeFieldProps,
  makeInputFieldProps,
  useFieldAttrs,
  useInputFieldAttrs,
} from "../../composables/field";

export default defineComponent({
  props: {
    ...makeFieldProps(),
    ...makeInputFieldProps(),
    type: {
      type: String,
      default: "text",
    },
  },
  setup(props) {
    const fieldAttrs = useFieldAttrs(props);
    const inputFieldAttrs = useInputFieldAttrs(props);
    return {
      ...toRefs(fieldAttrs),
      ...toRefs(inputFieldAttrs),
    };
  },
});
</script>
