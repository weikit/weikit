<template>
  <q-form :id="id" :class="className">
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
    className: String,
    children: Array,
  },
  setup({ id, className, children }) {
    const fields = children.map(useComponent);
    return {
      ...reactive({
        id,
        className,
        fields,
      }),
    };
  },
});
</script>
