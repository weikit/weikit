<template>
  <q-input
    :id="id"
    :label="label"
    :class="classes"
    :styles="styles"
    :placeholder="placeholder"
    :hint="hint"
    v-bind="extra"
    v-model="value"
  >
  </q-input>
</template>

<script>
import { defineComponent, toRefs, watch } from "vue";

import {
  useFormInject,
  makeFieldProps,
  makeInputFieldProps,
  useFieldAttrs,
  useInputFieldAttrs,
} from "../../composables/form";

export default defineComponent({
  props: {
    ...makeFieldProps({
      extra: {
        default: {
          filled: true,
        },
      },
    }),
    ...makeInputFieldProps(),
    type: {
      type: String,
      default: "text",
    },
  },
  setup(props, { emit }) {
    const fieldAttrs = useFieldAttrs(props);
    const inputFieldAttrs = useInputFieldAttrs(props);

    const { updateForm } = useFormInject(fieldAttrs, { emit });

    return {
      ...toRefs(fieldAttrs),
      ...toRefs(inputFieldAttrs),
    };
  },
});
</script>
