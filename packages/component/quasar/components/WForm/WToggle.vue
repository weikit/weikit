<template>
  <q-toggle
    :id="id"
    :label="label"
    :class="classes"
    :placeholder="placeholder"
    :hint="hint"
    v-bind="extra"
    v-model="value"
  ></q-toggle>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import { makeFieldProps, useFieldAttrs } from "../../composables/field";
import { useFormInject } from "../../composables/form";

export default defineComponent({
  props: {
    ...makeFieldProps(),
  },
  setup(props, { emit }) {
    const fieldAttrs = useFieldAttrs(props);

    const { updateForm } = useFormInject(fieldAttrs, { emit });

    return {
      ...toRefs(fieldAttrs),
    };
  },
});
</script>
