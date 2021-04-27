<template>
  <a
    :id="id"
    :class="classes"
    :styles="styles"
    :href="url"
    v-bind="extra"
    @click.stop="handleClick"
  >
    {{ text }}

    <component
      v-model="show"
      :is="target.componentName"
      v-bind="target.componentOptions"
    />
  </a>
</template>

<script>
import { defineComponent, ref, toRef, toRefs } from "vue";
import {
  makeComponentProps,
  useComponent,
  useComponentAttrs,
} from "../../composables/component";

export default defineComponent({
  props: {
    ...makeComponentProps(),

    url: {
      type: String,
      required: true,
      default: "",
    },

    text: {
      type: String,
      required: true,
      default: "",
    },

    target: {
      type: Object,
      default: {},
    },
    events: {
      type: Object,
      default: {},
    },
  },
  setup(props) {
    const componentAttrs = useComponentAttrs(props);
    const text = toRef(props, "text");
    const url = toRef(props, "url");

    const show = ref(false);

    setTimeout(function () {
      show.value = true;
    }, 3000);

    const target = useComponent(props.target);
    console.log(target);
    const handleClick = () => {};

    return {
      ...toRefs(componentAttrs),
      show,
      target: ref(target),
      text,
      url,

      handleClick,
    };
  },
});
</script>
