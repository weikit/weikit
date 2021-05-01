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
  useFormInject,
} from "../../composables";

export default defineComponent({
  props: merge(
    {},
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
    const { value, errors, isValid } = useFormInject(props, { emit });

    return {
      ...toRefs(props),
      value,
      errors,
      isValid,
    };
  },
});
</script>
