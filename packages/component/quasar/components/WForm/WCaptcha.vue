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
  >
    <template v-slot:after>
      <img width="133" @click.stop="updateCaptchaUrl" :src="captchaUrl" />
    </template>
  </q-input>
</template>

<script>
import { defineComponent } from "vue";
import { toRefs } from "@vue/reactivity";
import { useCaptcha } from "../../composables/captcha";
import {
  useFormInject,
  makeFieldProps,
  useFieldAttrs,
} from "../../composables/form";

export default defineComponent({
  props: {
    ...makeFieldProps({
      extra: {
        default: {
          filled: true,
        },
      },
    }),
    url: {
      type: String,
      required: true,
    },
  },
  setup(props, { emit }) {
    const fieldAtts = useFieldAttrs(props);

    const { updateForm } = useFormInject(fieldAtts, { emit });

    const { captchaUrl, updateCaptchaUrl } = useCaptcha({
      url: props.url,
    });

    return {
      ...toRefs(fieldAtts),
      captchaUrl,
      updateCaptchaUrl,
    };
  },
});
</script>
