<template>
  <tr :id="id" :class="classes" :style="styles" v-bind="extra">
    <td class="text-right">{{ label }}</td>
    <td class="text-left">
      <component :is="field.component" v-bind="field" />
    </td>
  </tr>
</template>

<script>
import { defineComponent, ref, toRefs } from "vue";

import { defaultComponentProps, useComponent } from "../../composables";

export default defineComponent({
  props: {
    ...defaultComponentProps(),
    label: {
      type: String,
      required: true,
    },
    field: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const field = useComponent(props.field);

    return {
      ...toRefs(props),
      field: ref(field),
    };
  },
});
</script>
