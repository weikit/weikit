<template>
  <div :id="id" class="row" :class="className">
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
    className: String,
    title: String,
    children: Array,
  },
  setup({ id, className, title, children }) {
    return {
      ...reactive({
        id,
        className,
        title,
        children: children.map(useComponent),
      }),
    };
  },
});
</script>
