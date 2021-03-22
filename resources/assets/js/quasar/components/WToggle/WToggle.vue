<template>
  <q-toggle :id="id" :class="className" :label="label"> </q-toggle>
</template>

<script>
import { defineComponent, toRefs } from "vue";

export default defineComponent({
  props: {
    id: String,
    className: String,
    label: String,
  },
  setup({ id, className, label }) {
    return {
      ...toRefs({
        id,
        className,
        label,
      }),
    };
  },
});
</script>
