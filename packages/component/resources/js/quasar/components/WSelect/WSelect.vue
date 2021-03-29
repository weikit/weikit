<template>
  <q-select
    :id="id"
    :class="classes"
    :label="label"
    :options="options"
    map-options
  >
  </q-select>
</template>

<script>
import { defineComponent, reactive } from "vue";

export default defineComponent({
  props: {
    id: String,
    classes: String,
    label: String,
    options: [Array, Object],
  },
  setup({ id, classes, label, options }) {
    const opts = Array.isArray(options)
      ? options
      : Object.keys(options).map(key => ({
          value: key,
          label: options[key],
        }));
    return {
      ...reactive({
        id,
        classes,
        label,
        options: opts,
      }),
    };
  },
});
</script>
