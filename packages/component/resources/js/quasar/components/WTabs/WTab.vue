<template>
  <q-tab-panel :id="id" :class="classes" :name="name">
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
    classes: String,
    name: String,
    children: Array,
  },
  setup({ id, classes, name, children }) {
    return {
      ...reactive({
        id,
        classes,
        name,
        children: children.map(useComponent),
      }),
    };
  },
});
</script>
