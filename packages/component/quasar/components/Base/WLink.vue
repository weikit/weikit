<template>
  <a
    :id="id"
    :class="classes"
    :styles="styles"
    :href="url"
    v-bind="extra"
    v-if="dialog"
    @click="showDialog"
  >
    {{ text }}

    <component
      v-model="dialogVisible"
      :is="dialog.componentName"
      v-bind="dialog"
    />
  </a>
  <a
    :id="id"
    :class="classes"
    :styles="styles"
    :href="url"
    v-bind="extra"
    v-else
  >
    {{ text }}
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
    text: {
      type: String,
      default: "",
    },
  },
  setup(props) {
    console.log(props);

    if (props.dialog) {
      const { dialog, dialogVisible, showDialog, hideDialog } = useDialog(
        props
      );

      return {
        ...toRefs(props),

        dialog,
        dialogVisible,
        showDialog,
        hideDialog,
      };
    }

    return {
      ...toRefs(props),
    };
  },
});
</script>
