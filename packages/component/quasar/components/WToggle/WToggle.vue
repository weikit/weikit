<template>
  <q-toggle :id="id" :class="classes" :label="label"></q-toggle>
</template>

<script>
import { defineComponent, reactive, toRefs } from "vue";
import { makeFieldProps, useFieldAttrs } from "../../composables/field";

export default defineComponent({
  props: {
    ...makeFieldProps(),
  },
  setup(props) {
    const fieldAttrs = useFieldAttrs(props);
    return {
      ...toRefs(fieldAttrs),
    };
  },
});
</script>
