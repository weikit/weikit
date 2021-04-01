<template>
  <q-input
    :id="id"
    :class="classes"
    :style="styles"
    v-bind="extra"
    :label="label"
  >
    <template v-slot:after>
      <img width="133" @click.stop="updateCaptchaUrl" :src="captchaUrl" />
    </template>
  </q-input>
</template>

<script>
import { defineComponent } from "vue";
import { toRefs } from "@vue/reactivity";
import { useComponentAttrs } from "../../composables/component";
import { makeFieldProps } from "../../composables/field";
import { useCaptcha } from "../../composables/captcha";

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
  setup(props) {
    const componentAtts = useComponentAttrs(props);

    const { captchaUrl, updateCaptchaUrl } = useCaptcha({
      url: props.url,
    });

    return {
      ...toRefs(componentAtts),
      captchaUrl,
      updateCaptchaUrl,
    };
  },
});
</script>
