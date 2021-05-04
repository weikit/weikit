<template>
  <q-table
    :id="id"
    :class="classes"
    :styles="styles"
    v-bind="extra"
    :columns="columns"
    :rows="pagination.rows"
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

    <template
      v-for="(column, n) in columns.filter(({ key }) => key == 'action')"
      :key="n"
      v-slot:[`body-cell-${column.name}`]="props"
    >
      <q-td :props="props">
        <component
          :key="index"
          v-for="({ componentName, ...componentOptions }, index) in props.col
            .children"
          :is="componentName"
          v-bind="componentOptions"
        />
      </q-td>
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
  },
  setup(props) {
    const { loading, pagination, loadData } = useTable(props);
    loadData({ pagination });

    const { columns } = useTableColumns(props);
    console.log(columns);

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
