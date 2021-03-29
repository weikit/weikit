<template>
  <div :id="id" class="row" :class="classes">
    <div
      class="col"
      :key="index"
      v-for="({ componentName, ...componentOptions }, index) in children"
    >
      <component :is="componentName" v-bind="componentOptions" />
    </div>
  </div>
</template>

<script>
import { defineComponent, reactive } from "vue";
import { useComponent } from "../../../useComponent";

export default defineComponent({
  props: {
    id: String,
    classes: String,
    title: String,
    children: Array,
  },
  setup({ id, classes, title, children }) {
    return {
      ...reactive({
        id,
        classes,
        title,
        children: children.map(useComponent),
      }),
    };
  },
});
</script>
