<template>
  <q-tab-panel :id="id" :class="className" :name="name">
    <component
      :key="index"
      v-for="({ componentName, ...componentOptions }, index) in children"
      :is="componentName"
      v-bind="componentOptions"
    ></component>
  </q-tab-panel>
</template>

<script>
import { defineComponent, reactive } from "vue";
import { useComponent } from "../../../useComponent";

export default defineComponent({
  props: {
    id: String,
    className: String,
    name: String,
    children: Array,
  },
  setup({ id, className, name, children }) {
    return {
      ...reactive({
        id,
        className,
        name,
        children: children.map(useComponent),
      }),
    };
  },
});
</script>
