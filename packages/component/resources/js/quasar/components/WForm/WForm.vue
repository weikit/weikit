<template>
  <q-form :id="id" :class="classes">
    <component
      :key="index"
      v-for="({ componentName, ...componentOptions }, index) in fields"
      :is="componentName"
      v-bind="componentOptions"
    />
  </q-form>
</template>

<script>
import { defineComponent, reactive } from "vue";
import { useComponent } from "../../../useComponent";

export default defineComponent({
  props: {
    id: String,
    classes: String,
    children: Array,
  },
  setup({ id, classes, children }) {
    const fields = children.map(useComponent);
    return {
      ...reactive({
        id,
        classes,
        fields,
      }),
    };
  },
});
</script>
