<template>
  <q-radio
    :id="id"
    :type="type"
    :label="label"
    :class="classes"
    :hint="hint"
    v-bind="extra"
    v-model="value"
  ></q-radio>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import { useComponentAttrs } from "../../composables/component";
import { useFormInject, makeFieldProps } from "../../composables/form";

export default defineComponent({
  props: {
    ...makeFieldProps(),
  },
  setup(props, { emit }) {
    const fieldAttrs = useComponentAttrs(props);

    const { updateForm } = useFormInject(fieldAttrs, { emit });

    return {
      ...toRefs(fieldAttrs),
    };
  },
});
</script>
