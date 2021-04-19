import { merge, pick } from "lodash-es";
import { reactive } from "vue";
import { defaultComponentProps } from "./component";

const defaultTableProps = {
  ...defaultComponentProps,
  columns: {
    type: Array,
    required: true,
    default: [],
  },
  pagination: {
    type: Object,
  },
};

export function makeTableProps(replaceProps = {}) {
  return merge({}, defaultTableProps, replaceProps);
}

export function useTableAttrs(props) {
  return reactive({
    ...pick(props, Object.keys(defaultComponentProps)),
    ...useTableColumnsAttrs(props),
    ...useTableDataAttrs(props),
  });
}

export function useTableColumnsAttrs(props) {
  const atts = {
    columns: props?.columns.map(useTableColumnAttrs),
  };

  return reactive(atts);
}

export function useTableColumnAttrs(props) {
  return reactive({
    field: (row) => row[props.name],
    format: (val) => `${val}`,
    align: "left",
    ...props,
  });
}

export function useTableDataAttrs(props) {
  const atts = {
    rows: [],
    paginate: {
      page: 1,
      rowsPerPage: 20,
      rowsNumber: 0,
    },
  };

  if (props.pagination) {
    const { data, current_page, per_page, total } = props.pagination;
    atts.rows = data;
    atts.paginate.page = current_page;
    atts.paginate.rowsPerPage = per_page;
    atts.paginate.rowsPerPage = total;
  }

  return reactive(atts);
}
