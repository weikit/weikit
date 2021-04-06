<template>
  <q-btn
    :id="id"
    :class="classes"
    :styles="styles"
    :label="label"
    v-bind="extra"
    @click.stop="handleClick"
  ></q-btn>
</template>

<script>
import { defineComponent, toRef, toRefs } from "vue";
import {
  makeComponentProps,
  useComponentAttrs,
} from "../../composables/component";
import { useFormInject } from "../../composables/form";

export default defineComponent({
  props: {
    ...makeComponentProps({
      extra: {
        default: {
          color: "primary",
        },
      },
      classes: {
        default: "full-width",
      },
    }),

    type: {
      type: String,
      default: "button",
    },

    label: {
      type: String,
      default: "",
      required: true,
    },
  },
  setup(props) {
    const componentAttrs = useComponentAttrs(props);
    const label = toRef(props, "label");
    const type = toRef(props, "type");

    const { submitForm, resetForm } = useFormInject(props);

    const handleClick = () => {
      if (type.value == "submit") {
        if (submitForm) {
          submitForm();
        } else {
          console.warn("Cannot submit because the form was not detected");
        }
      } else if ((type.value = "reset")) {
        if (resetForm) {
          resetForm();
        } else {
          console.warn("Cannot submit because the form was not detected");
        }
      }
    };

    return {
      ...toRefs(componentAttrs),
      label,
      handleClick,
    };
  },
});
</script>
