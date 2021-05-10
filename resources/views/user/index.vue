<template>
  <div class="q-pa-md">
    <component :is="component" v-bind="componentOptions" />
  </div>
</template>

<script>
import { defineComponent } from 'vue';
const { useComponent } = Uses;

export default defineComponent({
  props: {
    schema: Object,
  },
  setup(props) {
    const { component, ...componentOptions } = useComponent(props.schema);
    return {
      component,
      componentOptions,
    };
  },
});
</script>
