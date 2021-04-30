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
import { merge } from "lodash-es";
import { defineComponent, reactive, toRefs } from "vue";
import {
  defaultComponentFieldProps,
  defaultComponentProps,
  useFormInject,
} from "../../composables";

export default defineComponent({
  props: merge({}, defaultComponentProps, defaultComponentFieldProps, {
    extra: {
      default: {
        mapOptions: true,
      },
    },

    options: {
      type: [Array, Object],
      default: [],
    },
  }),
  setup(props, { emit }) {
    const { updateForm } = useFormInject(props, { emit });

    const options = reactive(
      Array.isArray(props.options)
        ? props.options
        : Object.keys(props.options).map((key) => ({
            value: key,
            label: props.options[key],
          }))
    );
    return {
      ...toRefs(props),
      options: toRefs(options),
    };
  },
});
</script>
