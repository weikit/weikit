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
import {
  defaultComponentFieldProps,
  defaultComponentProps,
} from "../../composables";
import { useFormInject } from "../../composables/form";

export default defineComponent({
  props: {
    ...defaultComponentProps,
    ...defaultComponentFieldProps,
  },
  setup(props, { emit }) {
    const { value, updateForm } = useFormInject(fieldAtts, { emit });

    return {
      ...toRefs(props),
      value,
    };
  },
});
</script>
