<template>
  <q-checkbox
    :id="id"
    :label="label"
    :class="classes"
    :hint="hint"
    v-bind="extra"
    v-model="value"
  >
  </q-checkbox>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import { useFormInject, makeFieldProps } from "../../composables/form";

export default defineComponent({
  props: {
    ...makeFieldProps(),
  },
  setup(props, { emit }) {
    const filedAttrs = makeFieldProps(props);

    const { updateForm } = useFormInject(fieldAtts, { emit });

    return {
      ...toRefs(filedAttrs),
    };
  },
});
</script>
