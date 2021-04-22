<template>
  <q-table
    :id="id"
    :class="classes"
    :styles="styles"
    v-bind="extra"
    :columns="columns"
    :rows="rows"
    v-model:pagination="pagination"
    :loading="loading"
    @request="loadData"
    title="Users"
    selection="multiple"
  >
    <template v-slot:loading>
      <q-inner-loading showing color="primary" />
    </template>

    <template v-slot:top-right>
      <div class="text-black q-gutter-md text-subtitle1">
        <q-btn color="primary" label="创建" />
        <q-btn color="primary" label="删除" />
        <q-icon name="refresh" />
        <q-icon name="format_line_spacing" />
        <q-icon name="settings" />
        <q-icon name="fullscreen" />
      </div>
    </template>
  </q-table>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import { makeTableProps, useTable } from "../../composables/table";

export default defineComponent({
  props: {
    ...makeTableProps(),
  },
  setup(props) {
    const { attrs, loadData } = useTable(props);
    console.log(attrs);

    loadData({ pagination: attrs.pagination });

    return {
      ...toRefs(attrs),
      loadData,
    };
  },
});
</script>
