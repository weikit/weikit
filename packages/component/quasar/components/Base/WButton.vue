<template>
  <q-btn
    :id="id"
    :class="classes"
    :styles="styles"
    :label="label"
    v-bind="extra"
    @click.stop="handleClick"
    :disable="form.processing"
    :loading="form.processing"
  ></q-btn>
</template>

<script>
import { merge } from "lodash-es";
import { defineComponent, ref, toRef, toRefs } from "vue";
import { defaultComponentProps, useFormInject } from "../../composables";

export default defineComponent({
  props: merge(defaultComponentProps, {
    extra: {
      default: {
        color: "primary",
      },
    },
    classes: {
      default: "full-width",
    },
    type: {
      type: String,
      default: "button",
    },
    label: {
      type: String,
      default: "",
      required: true,
    },
  }),
  setup(props) {
    const { form, submitForm, resetForm } = useFormInject(props);

    const handleClick = () => {
      if (props.type == "submit") {
        if (submitForm) {
          submitForm();
        } else {
          console.warn("Cannot submit because the form was not detected");
        }
      } else if ((props.type = "reset")) {
        if (resetForm) {
          resetForm();
        } else {
          console.warn("Cannot submit because the form was not detected");
        }
      }
    };

    return {
      ...toRefs(props),
      form: ref(form),

      handleClick,
    };
  },
});
</script>
