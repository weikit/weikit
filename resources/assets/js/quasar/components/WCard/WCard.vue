<template>
  <q-card :id="id" :class="className">
    <q-card-section v-if="title" class="bg-primary text-white">
      <div class="text-h6">{{ title }}</div>
    </q-card-section>

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
import { defineComponent, reactive } from "vue";
import { useComponent } from "../../uses";

export default defineComponent({
  props: {
    id: String,
    className: String,
    title: String,
    children: Array,
  },
  setup({ id, className, title, children }) {
    return {
      ...reactive({
        id,
        className,
        title,
        children: children.map(useComponent),
      }),
    };
  },
});
</script>
