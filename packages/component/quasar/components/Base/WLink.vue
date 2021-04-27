<template>
  <a>123 </a>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import { useComponentProps } from "../../composables";

const { componentProps, makeComponentAttrs } = useComponentProps();

export default defineComponent({
  props: componentProps,
  setup(props, {}) {
    const attrs = makeComponentAttrs(props);

    return {
      ...toRefs(attrs),
    };
  },
});
</script>
