<template>
  <q-input
    :id="id"
    :type="type"
    :label="label"
    :class="classes"
    :placeholder="placeholder"
    :hint="hint"
    v-bind="extra"
    v-model="value"
  >
  </q-input>
</template>

<script>
import { defineComponent, toRefs, watch } from "vue";
import {
  makeFieldProps,
  makeInputFieldProps,
  useFieldAttrs,
  useInputFieldAttrs,
} from "../../composables/field";

export default defineComponent({
  props: {
    ...makeFieldProps({
      extra: {
        default: {
          filled: true,
        },
      },
    }),
    ...makeInputFieldProps(),
    type: {
      type: String,
      default: "text",
    },
  },
  setup(props) {
    const fieldAttrs = useFieldAttrs(props);
    const inputFieldAttrs = useInputFieldAttrs(props);

    watch(
      () => fieldAttrs.value,
      val => {
        console.log(val);
      }
    );

    return {
      ...toRefs(fieldAttrs),
      ...toRefs(inputFieldAttrs),
    };
  },
});
</script>
