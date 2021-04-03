<template>
  <q-select
    :id="id"
    :type="type"
    :label="label"
    :class="classes"
    :hint="hint"
    v-bind="extra"
    v-model="value"
  >
  </q-select>
</template>

<script>
import { defineComponent, reactive, toRefs } from "vue";

import { makeFieldProps, useFieldAttrs } from "../../composables/field";

export default defineComponent({
  props: {
    ...makeFieldProps({
      extra: {
        default: {
          mapOptions: true,
        },
      },
    }),

    options: {
      type: [Array, Object],
      default: [],
    },
  },
  setup(props, { emit }) {
    const fieldAttrs = useFieldAttrs(props);

    const { updateForm } = useFormInject(fieldAttrs, { emit });

    const options = reactive(
      Array.isArray(props.options)
        ? props.options
        : Object.keys(props.options).map(key => ({
            value: key,
            label: props.options[key],
          }))
    );
    return {
      ...toRefs(componentAttrs),
      options: toRefs(options),
    };
  },
});
</script>
