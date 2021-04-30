<template>
  <q-card :id="id" :class="classes" :style="styles">
    <component v-if="title" :is="title.componentName" v-bind="title" />

    <q-card-section v-if="children.length > 0">
      <component
        :key="index"
        v-for="({ componentName, ...componentOptions }, index) in children"
        :is="componentName"
        v-bind="componentOptions"
      />
    </q-card-section>
  </q-card>
</template>

<script>
import { defineComponent, toRefs } from "vue";

import { defaultComponentProps, useComponent } from "../../composables";

export default defineComponent({
  props: {
    ...defaultComponentProps,
    title: {
      type: Object,
      default: "",
    },
  },
  setup(props) {
    const title = props.title && useComponent(props.title);

    return {
      ...toRefs(props),

      title,
    };
  },
});
</script>
