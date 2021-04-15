<template>
  <q-input
    :id="id"
    :label="label"
    :class="classes"
    :placeholder="placeholder"
    :hint="hint"
    v-bind="extra"
    v-model="value"
    type="textarea"
  ></q-input>
</template>

<script>
import { defineComponent, toRef, toRefs } from "vue";
import {
  makeFieldProps,
  makeInputFieldProps,
  useFieldAttrs,
  useFormInject,
} from "../../composables/form";

export default defineComponent({
  props: {
    ...makeFieldProps(),
    ...makeInputFieldProps(),
    cols: {
      type: Number,
      default: 5,
    },
    rows: {
      type: Number,
      default: 5,
    },
  },
  setup(props, { emit }) {
    const fieldAttrs = useFieldAttrs(props);

    const cols = toRef(props, "cols");
    const rows = toRef(props, "rows");

    const { updateForm } = useFormInject(fieldAttrs, { emit });

    return {
      ...toRefs(fieldAttrs),
      cols,
      rows,
    };
  },
});
</script>
