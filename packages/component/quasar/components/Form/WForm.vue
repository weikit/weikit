<template>
  <q-form
    :id="id"
    :label="label"
    :class="classes"
    :styles="styles"
    v-bind="extra"
  >
    <component
      :key="index"
      v-for="({ componentName, ...componentOptions }, index) in children"
      :is="componentName"
      v-bind="componentOptions"
    />
  </q-form>
</template>

<script>
import { merge } from "lodash-es";
import { defineComponent, toRefs } from "vue";
import {
  defaultComponentChildrenProps,
  defaultComponentFormProps,
  defaultComponentProps,
} from "../../composables";
import {
  makeFormProps,
  useFormAttrs,
  useFormProvide,
} from "../../composables/form";

export default defineComponent({
  props: merge(
    defaultComponentProps,
    defaultComponentChildrenProps,
    defaultComponentFormProps,
    {
      classes: {
        default: "q-gutter-sm",
      },
    }
  ),
  setup(props) {
    const { form } = useFormProvide(props);

    return {
      ...toRefs(props),
      form,
    };
  },
});
</script>
