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
import {
  defaultComponentFieldProps,
  defaultComponentProps,
  useFormInject,
} from "../../composables";

export default defineComponent({
  props: {
    ...defaultComponentProps,
    ...defaultComponentFieldProps,
  },
  setup(props, { emit }) {
    const { updateForm } = useFormInject(fieldAttrs, { emit });

    return {
      ...toRefs(props),
    };
  },
});
</script>
