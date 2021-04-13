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
  makeChildrenProps,
  useChildrenAttrs,
} from "../../composables/component";
import {
  makeFormProps,
  useFormAttrs,
  useFormProvide,
} from "../../composables/form";

export default defineComponent({
  props: {
    ...makeFormProps(),
  },
  setup(props) {
    const formAttrs = useFormAttrs(props);

    const { form } = useFormProvide(formAttrs);

    return {
      ...toRefs(formAttrs),
      form,
    };
  },
});
</script>
