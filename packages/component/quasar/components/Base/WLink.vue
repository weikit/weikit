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
    <span>{{ text }}</span>

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
    <span>{{ text }}</span>
  </a>
</template>

<script>
import { merge } from "lodash-es";
import { defineComponent, toRefs } from "vue";
import {
  defaultComponentDialogProps,
  defaultComponentProps,
} from "../../composables";
import { useDialog } from "../../composables/dialog";

export default defineComponent({
  props: merge({}, defaultComponentProps(), defaultComponentDialogProps(), {
    url: {
      type: String,
      required: true,
    },
    text: {
      type: String,
      default: "",
    },
  }),
  setup(props) {
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
