<template>
  <q-tab :id="id" :class="className">
    <component
      :key="index"
      v-for="({ componentName, ...componentOptions }, index) in children"
      :is="componentName"
      v-bind="componentOptions"
    ></component>
  </q-tab>
</template>

<script>
import { defineComponent, reactive } from "vue";
import { useComponent } from "../../uses";

export default defineComponent({
  props: {
    id: String,
    className: String,
    children: Array,
  },
  setup({ id, className, children }) {
    return {
      ...reactive({
        id,
        className,
        children: children.map(useComponent),
      }),
    };
  },
});
</script>
