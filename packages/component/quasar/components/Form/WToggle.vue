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
    ...defaultComponentProps(),
    ...defaultComponentFieldProps(),
  },
  setup(props, { emit }) {
    const { value, updateForm } = useFormInject(props, { emit });

    return {
      ...toRefs(props),
      value,
    };
  },
});
</script>
