<template>
  <a>123 </a>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import { makeComponentProps } from "../../composables";

const { componentProps, makeComponent } = makeComponentProps({
  hasChildren: true,
});

export default defineComponent({
  props: componentProps,
  setup(props, {}) {
    const { attrs = makeComponent(props);

    return {
      ...toRefs(attrs),
    };
  },
});
</script>
