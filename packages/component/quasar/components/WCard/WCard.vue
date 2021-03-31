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

import {
  makeChildrenProps,
  makeComponentProps,
  useComponentAttrs,
  useChildrenAttrs,
  useComponent,
} from "../../composables/component";

export default defineComponent({
  props: {
    ...makeComponentProps(),
    ...makeChildrenProps(),
    title: {
      type: Object,
      default: null,
    },
  },
  setup(props) {
    const componentAttrs = useComponentAttrs(props);
    const childrenAttrs = useChildrenAttrs(props);

    const title = props.title && useComponent(props.title);

    return {
      ...toRefs(componentAttrs),
      ...toRefs(childrenAttrs),
      title,
    };
  },
});
</script>
