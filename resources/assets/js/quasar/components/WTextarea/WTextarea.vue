<template>
  <q-input
    :id="id"
    :class="className"
    :label="label"
    :cols="cols"
    :rows="rows"
    type="textarea"
  ></q-input>
</template>

<script>
import { defineComponent, reactive } from "vue";

export default defineComponent({
  props: {
    id: String,
    className: String,
    label: String,
    cols: Number,
    rows: Number,
  },
  setup({ id, className, cols, rows, label }) {
    return {
      ...reactive({
        id,
        className,
        label,
        cols,
        rows,
      }),
    };
  },
});
</script>
