<template>
  <q-form
    :id="id"
    :label="label"
    :class="classes"
    :styles="styles"
    v-bind="extra"
  >
    {{ form }}
    <component
      :key="index"
      v-for="({ componentName, ...componentOptions }, index) in children"
      :is="componentName"
      v-bind="componentOptions"
    />
  </q-form>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import {
  makeComponentProps,
  makeChildrenProps,
  useComponentAttrs,
  useChildrenAttrs,
} from "../../composables/component";
import { useFormProvide } from "../../composables/form";

export default defineComponent({
  props: {
    ...makeComponentProps(),
    ...makeChildrenProps(),
  },
  setup(props) {
    const componentAttrs = useComponentAttrs(props);
    const childrenAttrs = useChildrenAttrs(props);

    const { form } = useFormProvide();

    return {
      ...toRefs(componentAttrs),
      ...toRefs(childrenAttrs),
      form,
    };
  },
});
</script>
