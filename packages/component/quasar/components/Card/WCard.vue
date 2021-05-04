<template>
  <q-card :id="id" :class="classes" :style="styles">
    <component v-if="title" :is="title.componentName" v-bind="title" />

    <q-card-section v-if="children.length > 0">
      <div :key="index" v-for="(child, index) in children">
        {{ child.componentOptions }}
      </div>
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
import { defineComponent, ref, toRefs } from "vue";

import {
  defaultComponentChildrenProps,
  defaultComponentProps,
  useComponent,
  useComponentChildren,
} from "../../composables";

export default defineComponent({
  props: {
    ...defaultComponentProps(),
    ...defaultComponentChildrenProps(),
    title: {
      type: Object,
      default: "",
    },
  },
  setup(props) {
    const title = props.title && useComponent(props.title);

    const { children } = useComponentChildren(props);

    return {
      ...toRefs(props),
      children: ref(children),
      title,
    };
  },
});
</script>
