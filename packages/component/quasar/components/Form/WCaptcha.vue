<template>
  <q-input
    :id="id"
    :type="type"
    :label="label"
    :class="classes"
    :placeholder="placeholder"
    :hint="hint"
    v-bind="extra"
    v-model="value"
    :error-message="errors[0]"
    :error="!isValid"
  >
    <template v-slot:after>
      <img width="133" @click.stop="updateCaptchaUrl" :src="captchaUrl" />
    </template>
  </q-input>
</template>

<script>
import { merge } from "lodash-es";
import { defineComponent } from "vue";
import { toRefs } from "@vue/reactivity";
import { useCaptcha } from "../../composables/captcha";
import { useFormInject } from "../../composables/form";
import {
  defaultComponentFieldProps,
  defaultComponentProps,
} from "../../composables";

export default defineComponent({
  props: merge({}, defaultComponentProps, defaultComponentFieldProps, {
    extra: {
      default: {
        filled: true,
      },
    },
    url: {
      type: String,
      required: true,
    },
  }),
  setup(props, { emit }) {
    const { value, errors, isValid } = useFormInject(props, { emit });

    const { captchaUrl, updateCaptchaUrl } = useCaptcha({
      url: props.url,
    });

    return {
      ...toRefs(props),
      value,
      captchaUrl,
      updateCaptchaUrl,
      errors,
      isValid,
    };
  },
});
</script>
