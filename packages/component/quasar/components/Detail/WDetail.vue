<template>
  <q-markup-table :id="id" :class="classes" :style="styles" v-bind="extra">
    <tbody>
      <component
        :key="index"
        v-for="({ component, ...componentOptions }, index) in fields"
        :is="component"
        v-bind="componentOptions"
      />
    </tbody>
  </q-markup-table>
</template>

<script>
import { defineComponent, ref, toRefs } from "vue";

import { defaultComponentProps, useDetailFields } from "../../composables";

export default defineComponent({
  props: {
    ...defaultComponentProps(),
    fields: {
      type: Array,
      default: [],
    },
  },
  setup(props) {
    const { fields } = useDetailFields(props);

    return {
      ...toRefs(props),
      fields: ref(fields),
    };
  },
});
</script>
