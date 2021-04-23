<template>
  <a
    :id="id"
    :class="classes"
    :styles="styles"
    v-bind="extra"
    @click.stop="handleClick"
  >
    {{ text }}
  </a>
</template>

<script>
import { defineComponent, ref, toRef, toRefs } from "vue";
import {
  makeComponentProps,
  useComponentAttrs,
} from "../../composables/component";

export default defineComponent({
  props: {
    ...makeComponentProps(),

    url: {
      type: String,
      required: true,
      default: "button",
    },

    text: {
      type: String,
      default: "",
      required: true,
    },
  },
  setup(props) {
    const componentAttrs = useComponentAttrs(props);
    const text = toRef(props, "text");
    const url = toRef(props, "url");

    const handleClick = () => {};

    return {
      ...toRefs(componentAttrs),
      text,
      url,

      handleClick,
    };
  },
});
</script>
