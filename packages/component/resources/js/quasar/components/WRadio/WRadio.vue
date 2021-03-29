<template>
  <q-radio :id="id" :class="classes" :label="label" value="option"></q-radio>
</template>

<script>
import { defineComponent, reactive } from "vue";

export default defineComponent({
  props: {
    id: String,
    classes: String,
    label: String,
  },
  setup({ id, classes, label }) {
    return {
      ...reactive({
        id,
        classes,
        label,
      }),
    };
  },
});
</script>
