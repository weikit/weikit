<template>
  <q-table
    :id="id"
    :class="classes"
    :styles="styles"
    v-bind="extra"
    :title="title"
    :columns="columns"
    :rows="pagination.rows"
    v-model:pagination="pagination"
    :loading="loading"
    @request="loadData"
  >
    <template v-slot:loading>
      <q-inner-loading showing color="primary" />
    </template>

    <template v-slot:top-right>
      <div class="text-black q-gutter-md text-subtitle1">
        <a class="q-btn" href="users/create">创建</a>

        <q-icon name="refresh" />
        <q-icon name="format_line_spacing" />
        <q-icon name="settings" />
        <q-icon name="fullscreen" />
      </div>
    </template>

    <template
      v-for="(column, n) in columns.filter(
        (column) => column?.children?.length > 0 /* must has children */
      )"
      :key="n"
      v-slot:[`body-cell-${column.name}`]="props"
    >
      <component :is="props.col.component" v-bind="props.col" :props="props" />
    </template>
  </q-table>
</template>

<script>
import { defineComponent, ref, toRefs } from "vue";
import {
  defaultComponentProps,
  defaultComponentTableProps,
  useTable,
  useTableColumns,
} from "../../composables";

export default defineComponent({
  props: {
    ...defaultComponentProps(),
    ...defaultComponentTableProps(),
    title: {
      type: String,
      default: "user",
    },
  },
  setup(props) {
    const { loading, pagination, loadData } = useTable(props);
    loadData({ pagination });

    const { columns } = useTableColumns(props);

    return {
      ...toRefs(props),
      columns: ref(columns),
      loading,
      pagination,

      loadData,
    };
  },
});
</script>
