<template>
  <a :id="id" :class="classes" :styles="styles" :href="url" v-bind="extra">
    {{ text }}

    <component
      v-if="dialog"
      v-model="dialogShow"
      :is="dialog.componentName"
      v-bind="dialog.componentOptions"
    />
  </a>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import {
  defaultComponentDialogProps,
  defaultComponentProps,
} from "../../composables";
import { useDialog } from "../../composables/dialog";

export default defineComponent({
  props: {
    ...defaultComponentProps,
    ...defaultComponentDialogProps,
  },
  setup(props) {
    const { dialog, dialogVisible, showDialog, hideDialog } = useDialog(
      props.dialog
    );

    return {
      ...toRefs(props),
    };
  },
});
</script>
