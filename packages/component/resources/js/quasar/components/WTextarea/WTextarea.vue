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
import { defineComponent, reactive } from "vue";

export default defineComponent({
  props: {
    id: String,
    classes: String,
    label: String,
    cols: Number,
    rows: Number,
  },
  setup({ id, classes, cols, rows, label }) {
    return {
      ...reactive({
        id,
        classes,
        label,
        cols,
        rows,
      }),
    };
  },
});
</script>
