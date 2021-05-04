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
import {
  defaultComponentFieldProps,
  defaultComponentProps,
} from "../../composables";

import { useFormInject } from "../../composables";

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
