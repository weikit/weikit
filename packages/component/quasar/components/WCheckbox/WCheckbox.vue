<template>
  <q-checkbox :id="id" :class="classes" :label="label"> </q-checkbox>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import { makeFieldProps } from "../../composables/field";

export default defineComponent({
  props: {
    ...makeFieldProps(),
  },
  setup(props) {
    const filedAttrs = makeFieldProps(props);

    return {
      ...toRefs(filedAttrs),
    };
  },
});
</script>
