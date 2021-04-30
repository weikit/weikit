<template>
  <q-input
    :id="id"
    :label="label"
    :class="classes"
    :placeholder="placeholder"
    :hint="hint"
    v-bind="extra"
    v-model="value"
    type="textarea"
  ></q-input>
</template>

<script>
import { merge } from "lodash-es";
import { defineComponent, toRef, toRefs } from "vue";
import {
  defaultComponentFieldProps,
  defaultComponentProps,
} from "../../composables";
import { useFieldAttrs, useFormInject } from "../../composables/form";

export default defineComponent({
  props: merge(defaultComponentProps, defaultComponentFieldProps, {
    cols: {
      type: Number,
      default: 5,
    },
    rows: {
      type: Number,
      default: 5,
    },
  }),
  setup(props, { emit }) {
    const { updateForm } = useFormInject(fieldAttrs, { emit });

    return {
      ...toRefs(props),
    };
  },
});
</script>
