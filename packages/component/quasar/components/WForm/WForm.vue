<template>
  <q-form :id="id" :class="classes" :style="styles">
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
import { useFormInject, useFormProvide } from "../../composables/form";

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
