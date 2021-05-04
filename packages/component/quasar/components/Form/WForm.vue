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
import { defineComponent, toRefs, ref } from "vue";
import {
  defaultComponentChildrenProps,
  defaultComponentFormProps,
  defaultComponentProps,
  useComponentChildren,
  useFormProvide,
} from "../../composables";

export default defineComponent({
  props: merge(
    {},
    defaultComponentProps(),
    defaultComponentChildrenProps(),
    defaultComponentFormProps(),
    {
      classes: {
        default: "q-gutter-sm",
      },
    }
  ),
  setup(props) {
    const { form } = useFormProvide(props);

    const { children } = useComponentChildren(props);

    return {
      ...toRefs(props),
      children: ref(children),
      form: ref(form),
    };
  },
});
</script>
