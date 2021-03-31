<template>
  <q-input
    :id="id"
    :class="classes"
    :label="label"
    :cols="cols"
    :rows="rows"
    type="textarea"
  ></q-input>
</template>

<script>
import { defineComponent, toRef, toRefs } from "vue";
import {
  makeFieldProps,
  makeInputFieldProps,
  useFieldAttrs,
} from "../../composables/field";

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
  setup(props) {
    const fieldProps = useFieldAttrs(props);
    const cols = toRef(props, "cols");
    const rows = toRef(props, "rows");

    return {
      ...toRefs(fieldProps),
      cols,
      rows,
    };
  },
});
</script>
