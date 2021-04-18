<template>
  <q-table
    :id="id"
    :class="classes"
    :styles="styles"
    v-bind="extra"
    :columns="columns"
  ></q-table>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import { makeTableProps, useTableAttrs } from "../../composables/table";

export default defineComponent({
  props: {
    ...makeTableProps(),
  },
  setup(props) {
    const tableAttrs = useTableAttrs(props);
    console.log(tableAttrs);
    return {
      ...toRefs(tableAttrs),
    };
  },
});
</script>
