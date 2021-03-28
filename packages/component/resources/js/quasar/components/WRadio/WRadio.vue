<template>
  <q-radio :id="id" :class="className" :label="label" value="option"></q-radio>
</template>

<script>
import { defineComponent, reactive } from "vue";

export default defineComponent({
  props: {
    id: String,
    className: String,
    label: String,
  },
  setup({ id, className, label }) {
    return {
      ...reactive({
        id,
        className,
        label,
      }),
    };
  },
});
</script>
