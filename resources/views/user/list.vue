<template>
  <div>
    <component :is="componentName" v-bind="componentOptions" />
  </div>
</template>

<script>
const { defineComponent } = Vue;
const { useComponent } = Uses;

export default defineComponent({
  props: {
    schema: Object,
  },
  setup(props) {
    const { componentName, ...componentOptions } = useComponent(props.schema);
    return {
      componentName,
      componentOptions,
    };
  },
});
</script>
