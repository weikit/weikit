<template>
  <q-input
    :id="id"
    :label="label"
    :class="classes"
    :styles="styles"
    :placeholder="placeholder"
    :hint="hint"
    :type="type"
    v-bind="extra"
    v-model="value"
    :error-message="errors[0]"
    :error="!isValid"
  >
  </q-input>
</template>

<script>
import { merge } from "lodash-es";
import { defineComponent, toRefs } from "vue";
import {
  defaultComponentFieldProps,
  defaultComponentInputFieldProps,
  defaultComponentProps,
} from "../../composables";

import {
  useFormInject,
  makeFieldProps,
  makeInputFieldProps,
  useFieldAttrs,
  useInputFieldAttrs,
} from "../../composables/form";

export default defineComponent({
  props: merge(
    defaultComponentProps,
    defaultComponentFieldProps,
    defaultComponentInputFieldProps,
    {
      extra: {
        default: {
          filled: true,
        },
      },
    }
  ),
  setup(props, { emit }) {
    const fieldAttrs = useFieldAttrs(props);
    const inputFieldAttrs = useInputFieldAttrs(props);

    const { errors, isValid } = useFormInject(fieldAttrs, { emit });

    return {
      ...toRefs(props),
      ...toRefs(inputFieldAttrs),
      errors,
      isValid,
    };
  },
});
</script>
