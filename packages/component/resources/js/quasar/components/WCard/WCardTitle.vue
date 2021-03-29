<template>
  <q-card-section>
    <div class="text-h6">{{ title }}</div>
  </q-card-section>
</template>

<script>
import { defineComponent, reactive } from "vue";

export default defineComponent({
  props: {
    id: String,
    classes: String,
    title: String,
    children: Array,
  },
  setup({ id, classes, title }) {
    return {
      ...reactive({
        id,
        classes,
        title,
      }),
    };
  },
});
</script>
