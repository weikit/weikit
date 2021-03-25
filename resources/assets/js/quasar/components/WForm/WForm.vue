<template>
  <q-form :id="id" :class="className">
    <div
      :key="index"
      v-for="({ componentName, ...componentOptions }, index) in fields"
    >
      <component :is="componentName" v-bind="componentOptions" />
    </div>
  </q-form>
</template>

<script>
import { defineComponent, reactive } from "vue";
import { useComponent } from "../../uses";

export default defineComponent({
  props: {
    id: String,
    className: String,
    schema: Array,
  },
  setup({ id, className, schema }) {
    const fields = schema.map(useComponent);
    return {
      ...reactive({
        id,
        className,
        fields,
      }),
    };
  },
});
</script>
