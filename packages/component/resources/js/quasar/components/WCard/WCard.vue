<template>
  <q-card :id="id" :style="['a', 'b']">
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
import { defineComponent, reactive, toRefs } from "vue";
import { useComponent } from "../../../useComponent";

export default defineComponent({
  props: {
    id: String,
    classes: String | Array,
    styles: String | Array | Object,
    title: Object,
    children: Array,
  },
  setup(props) {
    const { id, classes, title, children } = toRefs(props);
    return {
      ...reactive({
        id,
        classes,
        title: title && useComponent(title),
        children: children.map(useComponent),
      }),
    };
  },
});
</script>
