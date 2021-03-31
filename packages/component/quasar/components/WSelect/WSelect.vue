<template>
  <q-select
    :id="id"
    :class="classes"
    :label="label"
    :options="options"
    map-options
  >
  </q-select>
</template>

<script>
import { defineComponent, reactive, toRefs } from "vue";
import { useComponentAttrs } from "../../composables/component";
import { makeFieldProps } from "../../composables/field";

export default defineComponent({
  props: {
    ...makeFieldProps(),

    options: {
      type: [Array, Object],
      default: [],
    },
  },
  setup(props) {
    const componentAttrs = useComponentAttrs(props);

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
