<template>
  <q-radio :id="id" :class="classes" :label="label" value="option"></q-radio>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import { useComponentAttrs } from "../../composables/component";
import { makeFieldProps } from "../../composables/field";

export default defineComponent({
  props: {
    ...makeFieldProps(),
  },
  setup(props) {
    const fieldAttrs = useComponentAttrs(props);

    return {
      ...toRefs(fieldAttrs),
    };
  },
});
</script>
