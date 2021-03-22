<template>
  <q-select
    :id="id"
    :class="className"
    :label="label"
    :options="options"
    map-options
  >
  </q-select>
</template>

<script>
import { defineComponent, toRefs } from "vue";

export default defineComponent({
  props: {
    id: String,
    className: String,
    label: String,
    options: [Array, Object],
  },
  setup({ id, className, label, options }) {
    const opts = Array.isArray(options)
      ? options
      : Object.keys(options).map((key) => ({
          value: key,
          label: options[key],
        }));
    return {
      ...toRefs({
        id,
        className,
        label,
        options: opts,
      }),
    };
  },
});
</script>
